<script setup>
import { Head, router, usePage } from '@inertiajs/vue3'
import { ref, computed } from 'vue'

const props = defineProps({
  carModels: { type: Array, default: () => [] },
  filters:   { type: Object, default: () => ({}) }
})

const showForm = ref(false)
const selectedCar = ref(null)
const successMessage = ref(false)
const errors = ref({})

const serverErrors = computed(() => usePage().props?.errors || {})

const page = usePage()
const user = computed(() => page.props.auth.user)

function openReservationForm(car) {
  selectedCar.value = car
  showForm.value = true
  errors.value = {}
}

function closeReservationForm() {
  showForm.value = false
  selectedCar.value = null
  successMessage.value = false
  errors.value = {}
}

function submitReservation(e) {
  const form = new FormData(e.target)
  if (selectedCar.value?.id) {
    form.append('car_model_id', selectedCar.value.id)
  }

  router.post('/reservations', Object.fromEntries(form), {
    onSuccess: () => {
      successMessage.value = true
      errors.value = {}
      setTimeout(closeReservationForm, 1500)
    },
    onError: (err) => { errors.value = err || {} }
  })
}

function goToDashboard()   { router.get('/dashboard') }
function goToReservations(){ router.get('/reservations') }
function goToProfile()     { router.get('/profile') }
function logout()          { router.post('/logout') }
</script>

<template>
  <Head title="لوحة التحكم" />

  <!-- الهيدر -->
  <nav class="bg-gradient-to-r from-purple-800 to-purple-600 shadow-lg mb-8">
  <div class="max-w-7xl mx-auto px-8 py-5 flex justify-between items-center text-white">
    <h1 class="text-2xl font-bold tracking-wide">لوحة التحكم</h1>
    <div class="flex gap-8"> <!-- زدت الـ gap من 4 إلى 8 -->
      <button @click="goToDashboard"    class="hover:text-gray-200 font-medium">الرئيسية</button>
      <button @click="goToReservations" class="hover:text-gray-200 font-medium">الحجوزات</button>
      <button @click="goToProfile"      class="hover:text-gray-200 font-medium">المستخدم</button>
      <button @click="logout"           class="hover:text-gray-200 font-medium">تسجيل الخروج</button>
      <button v-if="user?.role === 'admin'"
              @click="router.get(route('filament.admin.pages.dashboard'))"
              class="hover:text-gray-200 font-medium">
        لوحة الأدمن
      </button>
      <button @click="router.get('/payment')" class="hover:text-gray-200 font-medium">
  المدفوعات الإضافية
</button>

    </div>
  </div>
</nav>

  <!-- المحتوى -->
  <div class="min-h-screen bg-gray-950 p-6">
    <h1 class="text-3xl font-bold mb-8 text-center text-purple-400">موديلات السيارات</h1>

    <!-- الفلاتر -->
    <div class="bg-gray-900 p-6 rounded-lg shadow mb-8 text-white">
      <h2 class="text-xl font-semibold mb-6 text-purple-400">فلترة السيارات</h2>
      <form method="GET" action="/dashboard" class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div>
          <label class="block mb-2">أقصى سعر</label>
          <input type="number" name="max_price"
                 class="border rounded-lg p-2 w-full bg-black text-white focus:ring-2 focus:ring-purple-500"
                 :value="props.filters.max_price ?? ''" />
        </div>
        <div>
          <label class="block mb-2">نوع الوقود</label>
          <select name="fuel_type"
                  class="border rounded-lg p-2 w-full bg-black text-white focus:ring-2 focus:ring-purple-500"
                  :value="props.filters.fuel_type ?? ''">
            <option value="">الكل</option>
            <option value="بنزين">بنزين</option>
            <option value="ديزل">ديزل</option>
            <option value="كهرباء">كهرباء</option>
          </select>
        </div>
        <div>
          <label class="block mb-2">عدد الأبواب</label>
          <input type="number" name="doors"
                 class="border rounded-lg p-2 w-full bg-black text-white focus:ring-2 focus:ring-purple-500"
                 :value="props.filters.doors ?? ''" />
        </div>
        <div>
          <label class="block mb-2">السنة</label>
          <input type="number" name="year"
                 class="border rounded-lg p-2 w-full bg-black text-white focus:ring-2 focus:ring-purple-500"
                 :value="props.filters.year ?? ''" />
        </div>
        <div class="md:col-span-4 flex gap-4 mt-6">
          <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-2 rounded-lg shadow">
            تطبيق الفلتر
          </button>
          <a href="/dashboard" class="bg-gray-700 hover:bg-gray-600 text-white px-6 py-2 rounded-lg shadow">
            إعادة تعيين
          </a>
        </div>
      </form>
    </div>

    <!-- قائمة السيارات -->
    <div v-if="props.carModels.length" class="space-y-8">
      <div v-for="model in props.carModels" :key="model.id"
           class="bg-gray-900 border border-purple-700 rounded-xl shadow-lg p-6 flex flex-col md:flex-row items-center gap-6 text-white">
        <img v-if="model.image_path" :src="model.image_path" alt="صورة السيارة"
             class="w-48 h-48 object-cover rounded-lg border border-purple-500 shadow" />

        <div class="flex-1 text-center md:text-left">
          <h2 class="text-2xl font-semibold mb-4 text-purple-400">
            {{ (model.brand || model.make || 'سيارة') }} -
            {{ (model.model_name || model.model || 'موديل') }}
            ({{ model.year ?? 'غير محدد' }})
          </h2>

          <p class="text-gray-300 mb-2">
            نوع الوقود: {{ model.fuel_type ?? 'غير محدد' }} |
            ناقل الحركة: {{ model.transmission ?? 'غير محدد' }}
          </p>
          <p class="text-gray-300 mb-2">
            الحقائب: {{ model.luggage_capacity ?? 0 }} |
            الأفراد: {{ model.seating_capacity ?? 0 }} |
            الأبواب: {{ model.doors ?? 0 }}
          </p>
          <p class="text-purple-400 font-bold mb-4">
            السعر: {{ model.price ?? 0 }} دينار / يوم
          </p>

          <div class="flex justify-center md:justify-end">
            <button @click="openReservationForm(model)"
                    class="bg-purple-600 hover:bg-purple-700 text-white py-3 px-6 rounded-lg text-lg shadow transition">
              احجز الآن
            </button>
          </div>
        </div>
      </div>
    </div>

    <div v-else class="bg-gray-900 text-white rounded-lg p-6 text-center shadow">
      لا توجد سيارات مطابقة للفلاتر الحالية.
    </div>

    <!-- مودال الحجز -->
    <div v-if="showForm" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50">
      <form @submit.prevent="submitReservation"
            class="bg-gray-900 p-6 rounded-lg shadow-lg w-96 space-y-4 text-white relative">
        <button type="button" @click="closeReservationForm"
                class="absolute top-3 left-3 text-gray-400 hover:text-white">✕</button>

        <h2 class="text-xl font-bold mb-4 text-purple-400">إدخال بيانات الحجز</h2>

        <div v-if="serverErrors.reservation" class="mb-4 bg-red-200 text-red-800 p-3 rounded">
          {{ serverErrors.reservation }}
        </div>
        <div v-if="successMessage" class="mb-4 bg-green-200 text-green-800 p-3 rounded">
          تم الحجز بنجاح
        </div>

        <div class="mb-4 p-3 bg-gray-800 rounded">
          <p class="font-semibold">السيارة المختارة:</p>
          <p v-if="selectedCar">
            {{ (selectedCar.brand || selectedCar.make || 'سيارة') }} -
            {{ (selectedCar.model_name || selectedCar.model || 'موديل') }}
            ({{ selectedCar.year ?? 'غير محدد' }})
            </p>
            </div>
        <div>
          <label class="block mb-1">تاريخ الاستلام</label>
          <input type="date" name="pickup_date" class="border rounded p-2 w-full bg-black text-white" required />
          <span v-if="errors.pickup_date" class="text-red-400 text-sm">{{ errors.pickup_date }}</span>
        </div>

        <div>
          <label class="block mb-1">تاريخ الإرجاع</label>
          <input type="date" name="return_date" class="border rounded p-2 w-full bg-black text-white" required />
          <span v-if="errors.return_date" class="text-red-400 text-sm">{{ errors.return_date }}</span>
        </div>

        <div>
          <label class="block mb-1">موقع الاستلام</label>
          <select name="pickup_location_id" class="border rounded p-2 w-full bg-black text-white" required>
            <option value="">اختر موقع الاستلام</option>
            <option value="1">طرابلس</option>
            <option value="2">بنغازي</option>
          </select>
          <span v-if="errors.pickup_location_id" class="text-red-400 text-sm">{{ errors.pickup_location_id }}</span>
        </div>

        <div>
          <label class="block mb-1">موقع التسليم</label>
          <select name="dropoff_location_id" class="border rounded p-2 w-full bg-black text-white" required>
            <option value="">اختر موقع التسليم</option>
            <option value="1">طرابلس</option>
            <option value="2">بنغازي</option>
          </select>
          <span v-if="errors.dropoff_location_id" class="text-red-400 text-sm">{{ errors.dropoff_location_id }}</span>
        </div>

        <div>
          <label class="block mb-1">طريقة الدفع</label>
          <select name="payment_method" class="border rounded p-2 w-full bg-black text-white" required>
            <option value="">طريقة الدفع</option>
            <option value="cash">نقدًا</option>
            <option value="card">بطاقة</option>
          </select>
          <span v-if="errors.payment_method" class="text-red-400 text-sm">{{ errors.payment_method }}</span>
        </div>

        <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white py-2 px-4 rounded w-full">
          تأكيد الحجز
        </button>
      </form>
    </div>
  </div>
</template>
