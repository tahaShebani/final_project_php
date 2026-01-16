<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CarModel;
use App\Models\Reservation;
use App\Models\Payment;
use App\Http\Controllers\ReservationController;

/**
 * الصفحة الرئيسية
 */
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin'    => Route::has('login'),
        'canRegister' => Route::has('register'),
    ]);
})->name('home');

/**
 * توجيه المستخدم بعد تسجيل الدخول حسب الدور
 */
Route::get('/redirect-after-login', function () {
    $user = Auth::user();

    switch (strtolower($user->role)) {
        case 'admin':
            return redirect()->route('filament.admin.pages.dashboard');
        case 'booking_agent':
            return redirect()->route('filament.booking_agent.pages.dashboard');
        case 'operation_employee':
            return redirect()->route('filament.operation_employee.pages.dashboard');
        default:
            return redirect()->route('dashboard');
    }
})->middleware(['auth', 'verified'])->name('redirect.after.login');

/**
 * مسارات محمية للمستخدمين
 */
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    /**
     * لوحة المستخدم (Dashboard)
     */
    Route::get('/dashboard', function (Request $request) {
        $query = CarModel::query();

        if ($request->filled('max_price')) {
            $query->where('price', '<=', $request->input('max_price'));
        }
        if ($request->filled('fuel_type')) {
            $query->where('fuel_type', $request->input('fuel_type'));
        }
        if ($request->filled('doors')) {
            $query->where('doors', $request->input('doors'));
        }
        if ($request->filled('year')) {
            $query->where('year', '>=', $request->input('year'));
        }

        return Inertia::render('Dashboard', [
            'carModels' => $query->get(),
            'filters'   => $request->only(['max_price','fuel_type','doors','year']),
        ]);
    })->name('dashboard');

    /**
     * عرض الحجوزات الخاصة بالمستخدم الحالي
     */
    Route::get('/reservations', function () {
        return Inertia::render('Reservations', [
            'reservations' => Reservation::with('carModel','customer','payment')
                ->where('customer_id', Auth::id())
                ->get()
        ]);
    })->name('reservations.index');

    /**
     * إنشاء حجز جديد
     */
    Route::post('/reservations', function (Request $request) {
        $request->validate([
            'car_model_id'        => 'required|exists:car_models,id',
            'pickup_date'         => 'required|date',
            'return_date'         => 'required|date|after:pickup_date',
            'pickup_location_id'  => 'required|exists:locations,id',
            'dropoff_location_id' => 'required|exists:locations,id',
            'payment_method'      => 'required|string',
        ]);

        $car  = CarModel::findOrFail($request->car_model_id);
        $days = (new \DateTime($request->pickup_date))->diff(new \DateTime($request->return_date))->days;
        $totalPrice = $days * $car->price;

        $reservation = Reservation::create([
            'customer_id'        => Auth::id(),
            'car_model_id'       => $request->car_model_id,
            'pickup_location_id' => $request->pickup_location_id,
            'dropoff_location_id'=> $request->dropoff_location_id,
            'reserved_at'        => now(),
            'pickup_date'        => $request->pickup_date,
            'return_date'        => $request->return_date,
            'status'             => 'pending',
            'total_price'        => $totalPrice,
        ]);

        Payment::create([
            'reservation_id' => $reservation->id,
            'payment_method' => $request->payment_method,
            'amount'         => $totalPrice,
            'processed_by'   => Auth::id(),
            'paid_at'        => now(),
        ]);

        return redirect()->route('reservations.index')->with('success', 'تم إنشاء الحجز والدفع بنجاح');
    })->name('reservations.store');

    /**
     * تأكيد وإلغاء الحجز
     */
    Route::put('/reservations/{id}/confirm', [ReservationController::class, 'confirm'])->name('reservations.confirm');
    Route::put('/reservations/{id}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');

    /**
     * الملف الشخصي
     */
    Route::get('/profile', function () {
        return Inertia::render('Profile', [
            'user' => Auth::user()
        ]);
    })->name('profile');

    Route::put('/profile', function (Request $request) {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . Auth::id(),
            'password' => 'nullable|string|min:8'
        ]);

        $user = Auth::user();
        $user->name  = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }
        $user->save();

        return redirect()->route('profile')->with('success', 'تم تحديث الملف الشخصي بنجاح');
    })->name('profile.update');

    /**
     * صفحة الدفع الإضافي (جزاءات)
     * - الأدمن يسجل المدفوعات عبر Filament Resource (PaymentResource)
     * - المستخدم يرى المدفوعات المسجلة عليه فقط ويدفعها
     */
    Route::get('/payment', function () {
        return Inertia::render('Payment', [
            'user' => Auth::user(),
            'payments' => Payment::with('reservation.carModel')
                ->whereHas('reservation', function ($q) {
                    $q->where('customer_id', Auth::id());
                })
                ->get()
        ]);
    })->name('payment.index');

    Route::post('/payments/{id}/pay', function ($id) {
        $payment = Payment::findOrFail($id);

        // تأكد أن هذا الدفع يخص المستخدم الحالي
        if ($payment->reservation->customer_id !== Auth::id()) {
            abort(403, 'غير مسموح');
        }

        $payment->update([
            'paid_at' => now(),
        ]);

        return redirect()->route('payment.index')->with('success', 'تم الدفع بنجاح');
    })->name('payments.pay');
});
