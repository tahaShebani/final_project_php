<script setup>
import { Head, router, usePage } from '@inertiajs/vue3'
import { ref, computed } from 'vue'

// تعريف آمن للـ props مع قيم افتراضية
const props = defineProps({
  carModels: { type: Array, default: () => [] },
  filters:   { type: Object, default: () => ({}) }
})

const showForm = ref(false)
const selectedCar = ref(null)
const successMessage = ref(false)
const errors = ref({})

const serverErrors = computed(() => usePage().props?.errors || {})

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
  // تأكيد وجود id قبل الإرسال لتجنب خطأ undefined
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

// تنقل
function goToDashboard()   { router.get('/dashboard') }
function goToReservations(){ router.get('/reservations') }
function goToProfile()     { router.get('/profile') }
</script>

<template>
  <Head title="لوحة التحكم" />

  <!-- الهيدر -->
  <nav class="bg-gradient-to-r from-purple-700 to-purple-500 shadow mb-6">
    <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center text-white">
      <h1 class="text-xl font-bold">لوحة التحكم</h1>
      <div class="space-x-4">
        <button @click="goToDashboard"    class="hover:text-gray-200 font-medium">الرئيسية</button>
        <button @click="goToReservations" class="hover:text-gray-200 font-medium">الحجوزات</button>
        <button @click="goToProfile"      class="hover:text-gray-200 font-medium">المستخدم</button>
      </div>
    </div>
  </nav>

  <!-- المحتوى -->
  <div class="min-h-screen bg-black p-6">
    <h1 class="text-2xl font-bold mb-6 text-center text-purple-400">موديلات السيارات</h1>

    <!-- الفلاتر -->
    <div class="bg-gray-900 p-6 rounded shadow mb-6 text-white">
      <h2 class="text-lg font-bold mb-4 text-purple-400">🔍 فلترة السيارات</h2>
      <form method="GET" action="/dashboard" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
          <label class="block mb-1">أقصى سعر</label>
          <input type="number" name="max_price"
                 class="border rounded p-2 w-full bg-black text-white"
                 :value="props.filters.max_price ?? ''" />
        </div>
        <div>
          <label class="block mb-1">نوع الوقود</label>
          <select name="fuel_type"
                  class="border rounded p-2 w-full bg-black text-white"
                  :value="props.filters.fuel_type ?? ''">
            <option value="">الكل</option>
            <option value="بنزين">بنزين</option>
            <option value="ديزل">ديزل</option>
            <option value="كهرباء">كهرباء</option>
          </select>
        </div>
        <div>
          <label class="block mb-1">عدد الأبواب</label>
          <input type="number" name="doors"
                 class="border rounded p-2 w-full bg-black text-white"
                 :value="props.filters.doors ?? ''" />
        </div>
        <div>
          <label class="block mb-1">السنة</label>
          <input type="number" name="year"
                 class="border rounded p-2 w-full bg-black text-white"
                 :value="props.filters.year ?? ''" />
        </div>
        <div class="md:col-span-4 flex gap-2 mt-4">
          <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded">
            تطبيق الفلتر
          </button>
          <a href="/dashboard" class="bg-gray-700 hover:bg-gray-600 text-white px-4 py-2 rounded">
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
             class="w-40 h-40 object-cover rounded-lg border border-purple-500" />

        <div class="flex-1 text-center md:text-left">
          <!-- استخدم مسميات آمنة مع fallback -->
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
                    class="bg-purple-600 hover:bg-purple-700 text-white py-3 px-6 rounded-lg text-lg transition">
              احجز الآن
            </button>
          </div>
        </div>
      </div>
    </div>

    <div v-else class="bg-gray-900 text-white rounded p-6 text-center">
      لا توجد سيارات مطابقة للفلاتر الحالية.
    </div>

    <!-- مودال الحجز -->
    <div v-if="showForm" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50">
      <form @submit.prevent="submitReservation"
            class="bg-gray-900 p-6 rounded-lg shadow-lg w-96 space-y-4 text-white relative">
        <button type="button" @click="closeReservationForm"
                class="absolute top-3 left-3 text-gray-300 hover:text-white">✕</button>

        <h2 class="text-xl font-bold mb-4 text-purple-400">إدخال بيانات الحجز</h2>

        <div v-if="serverErrors.reservation" class="mb-4 bg-red-100 text-red-700 p-3 rounded">
          {{ serverErrors.reservation }}
        </div>
        <div v-if="successMessage" class="mb-4 bg-green-100 text-green-700 p-3 rounded">
          ✅ تم الحجز بنجاح
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
