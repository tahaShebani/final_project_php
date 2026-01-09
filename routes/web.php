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

    if ($user->role === 'admin') {
        // لوحة Filament للأدمن
        return redirect()->route('filament.admin.pages.dashboard');
    }

    // لوحة المستخدم العادي
    return redirect()->route('dashboard');
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

        // فلترة السيارات
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
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $start = $request->input('start_date');
            $end   = $request->input('end_date');
            $query->whereDoesntHave('reservations', function ($q) use ($start, $end) {
                $q->where('status', 'confirmed')
                  ->where(function ($q2) use ($start, $end) {
                      $q2->whereBetween('pickup_date', [$start, $end])
                         ->orWhereBetween('return_date', [$start, $end])
                         ->orWhere(function ($q3) use ($start, $end) {
                             $q3->where('pickup_date', '<=', $start)
                                ->where('return_date', '>=', $end);
                         });
                  });
            });
        }

        return Inertia::render('Dashboard', [
            'carModels' => $query->get(),
            'filters'   => $request->only([
                'max_price','fuel_type','doors','year','start_date','end_date'
            ]),
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

        // التحقق من التداخل في الحجوزات
        $overlap = Reservation::where('car_model_id', $request->car_model_id)
            ->where('status', 'confirmed')
            ->where(function ($q) use ($request) {
                $q->whereBetween('pickup_date', [$request->pickup_date, $request->return_date])
                  ->orWhereBetween('return_date', [$request->pickup_date, $request->return_date])
                  ->orWhere(function ($q2) use ($request) {
                      $q2->where('pickup_date', '<=', $request->pickup_date)
                         ->where('return_date', '>=', $request->return_date);
                  });
            })
            ->exists();

        if ($overlap) {
            return redirect()->back()->withErrors([
                'reservation' => '❌ هذه السيارة محجوزة بالفعل في الفترة المحددة'
            ]);
        }

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

        return redirect()->route('reservations.index')->with('success', '✅ تم إنشاء الحجز والدفع بنجاح');
    })->name('reservations.store');

    /**
     * تأكيد وإلغاء الحجز
     */
    Route::put('/reservations/{id}/confirm', [ReservationController::class, 'confirm'])->name('reservations.confirm');
    Route::put('/reservations/{id}/cancel', [ReservationController::class, 'cancel'])->name('reservations.cancel');

    /**
     * صفحة تعديل المستخدم
     */
    Route::get('/profile', function () {
        return Inertia::render('Profile', [
            'user' => Auth::user()
        ]);
    })->name('profile');

    /**
     * تحديث بيانات المستخدم
     */
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

        return redirect()->route('profile')->with('success', '✅ تم تحديث الملف الشخصي بنجاح');
    })->name('profile.update');
});
