<template>
  <div class="min-h-screen bg-black">
    <!-- المنيو بار -->
    <nav class="bg-gradient-to-r from-purple-700 to-purple-500 shadow mb-6">
      <div class="max-w-7xl mx-auto px-4 py-3 flex justify-between items-center text-white">
        <h1 class="text-xl font-bold">إدارة الحجوزات</h1>
        <div class="space-x-4">
          <button @click="goToDashboard" class="hover:text-gray-200 font-medium">الرئيسية</button>
          <button @click="goToReservations" class="hover:text-gray-200 font-medium">الحجوزات</button>
        </div>
      </div>
    </nav>

    <!-- المحتوى -->
    <div class="p-6 max-w-7xl mx-auto">
      <h1 class="text-2xl font-bold mb-6 text-purple-400">قائمة الحجوزات</h1>

      <!-- رسائل عامة -->
      <div v-if="serverErrors?.reservation" class="mb-4 bg-red-100 text-red-700 p-3 rounded">
        {{ serverErrors.reservation }}
      </div>
      <div v-if="successMessage" class="mb-4 bg-green-100 text-green-700 p-3 rounded">
         تم تنفيذ العملية بنجاح
      </div>

      <!-- جدول الحجوزات -->
      <div class="overflow-x-auto bg-gray-900 border border-purple-700 rounded-lg shadow">
        <table class="min-w-full text-white">
          <thead>
            <tr class="bg-gray-800 text-purple-300 text-sm uppercase">
              <th class="py-3 px-4 text-left">#</th>
              <th class="py-3 px-4 text-left">العميل</th>
              <th class="py-3 px-4 text-left">السيارة</th>
              <th class="py-3 px-4 text-left">تاريخ الاستلام</th>
              <th class="py-3 px-4 text-left">تاريخ الإرجاع</th>
              <th class="py-3 px-4 text-left">الحالة</th>
              <th class="py-3 px-4 text-left">السعر</th>
              <th class="py-3 px-4 text-left">الدفع</th>
              <th class="py-3 px-4 text-left">الإجراءات</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="reservation in safeReservations" :key="reservation.id"
                class="border-t border-gray-800 hover:bg-gray-800/60">
              <td class="py-2 px-4">{{ reservation.id }}</td>
              <td class="py-2 px-4">{{ reservation.customer?.name ?? 'غير معروف' }}</td>
              <td class="py-2 px-4">
                {{ reservation.car_model?.model_name ?? reservation.carModel?.model_name ?? 'غير محدد' }}
              </td>
              <td class="py-2 px-4">{{ reservation.pickup_date ?? '—' }}</td>
              <td class="py-2 px-4">{{ reservation.return_date ?? '—' }}</td>
              <td class="py-2 px-4">
                <span
                  :class="{
                    'text-yellow-300 font-semibold': reservation.status === 'pending',
                    'text-green-300 font-semibold': reservation.status === 'confirmed',
                    'text-red-300 font-semibold': reservation.status === 'cancelled'
                  }"
                >
                  {{ reservation.status ?? '—' }}
                </span>
              </td>
              <td class="py-2 px-4">{{ reservation.total_price ?? 0 }} د.ل</td>
              <td class="py-2 px-4">
                <span v-if="reservation.payment">
                  {{ reservation.payment.amount }} ({{ reservation.payment.payment_method }})
                </span>
                <span v-else class="text-gray-400">لم يتم الدفع</span>
              </td>
              <td class="py-2 px-4 space-x-2">
                <button
                  v-if="reservation.status === 'pending'"
                  @click="openPaymentForm(reservation)"
                  class="bg-purple-600 text-white px-3 py-1 rounded hover:bg-purple-700 disabled:opacity-50"
                  :disabled="loading"
                >
                  تأكيد
                </button>
                <button
                  v-if="reservation.status !== 'cancelled'"
                  @click="cancelReservation(reservation.id)"
                  class="bg-gray-700 text-white px-3 py-1 rounded hover:bg-gray-600 disabled:opacity-50"
                  :disabled="loading"
                >
                  إلغاء
                </button>
              </td>
            </tr>

            <!-- لا توجد بيانات -->
            <tr v-if="safeReservations.length === 0">
              <td colspan="9" class="py-4 px-4 text-center text-gray-400">
                لا توجد حجوزات حالياً.
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- مودال الدفع/التأكيد -->
    <div v-if="showPaymentForm" class="fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-50">
      <form @submit.prevent="confirmReservation(selectedReservation?.id)"
            class="bg-gray-900 p-6 rounded-lg shadow-lg w-96 space-y-4 text-white relative">
        <!-- زر إغلاق -->
        <button type="button" @click="closePaymentForm"
                class="absolute top-3 left-3 text-gray-300 hover:text-white">✕</button>

        <h2 class="text-xl font-bold mb-2 text-purple-400">تأكيد الحجز</h2>
        <p class="text-gray-300 mb-4">
          {{ selectedReservation?.customer?.name ?? 'عميل' }} — 
          {{ selectedReservation?.car_model?.model_name ?? selectedReservation?.carModel?.model_name ?? 'سيارة' }}
        </p>

        <!-- حقول حسب طريقة الدفع -->
        <div v-if="selectedReservation?.payment?.payment_method === 'card'">
          <label class="block mb-1">رقم البطاقة الائتمانية</label>
          <input type="text" placeholder="أدخل رقم البطاقة" class="border rounded p-2 w-full bg-black text-white" />
        </div>

        <div v-else-if="selectedReservation?.payment?.payment_method === 'cash'">
          <label class="block mb-1">الكود السري</label>
          <input type="text" placeholder="أدخل الكود السري" class="border rounded p-2 w-full bg-black text-white" />
          <p class="text-sm text-gray-400 mt-1">يتم إعطاء هذا الكود من قبل الأدمن.</p>
        </div>

        <button type="submit"
                class="bg-purple-600 text-white px-4 py-2 rounded w-full hover:bg-purple-700 disabled:opacity-50"
                :disabled="loading">
          تأكيد الحجز
        </button>
        <button type="button" @click="closePaymentForm"
                class="bg-gray-700 text-white px-4 py-2 rounded w-full hover:bg-gray-600">
          إلغاء
        </button>
      </form>
    </div>
  </div>
</template>

<script setup>
import { router, usePage } from '@inertiajs/vue3'
import { ref, computed } from 'vue'

const props = defineProps({
  reservations: { type: Array, default: () => [] }
})

// حالات عامة
const loading = ref(false)
const successMessage = ref(false)
const serverErrors = computed(() => usePage().props?.errors || {})

// دفع/تأكيد
const showPaymentForm = ref(false)
const selectedReservation = ref(null)

// قائمة آمنة
const safeReservations = computed(() => Array.isArray(props.reservations) ? props.reservations : [])

// فتح مودال الدفع
function openPaymentForm(reservation) {
  selectedReservation.value = reservation
  showPaymentForm.value = true
}

// إغلاق مودال الدفع
function closePaymentForm() {
  showPaymentForm.value = false
  selectedReservation.value = null
}

// تأكيد الحجز
async function confirmReservation(id) {
  if (!id) return
  loading.value = true
  router.put(`/reservations/${id}/confirm`, {}, {
    onSuccess: () => {
      successMessage.value = true
      showPaymentForm.value = false
      setTimeout(() => successMessage.value = false, 1500)
    },
    onFinish: () => { loading.value = false }
  })
}

// إلغاء الحجز
function cancelReservation(id) {
  if (!id) return
  loading.value = true
  router.put(`/reservations/${id}/cancel`, {}, {
    onSuccess: () => {
      successMessage.value = true
      setTimeout(() => successMessage.value = false, 1500)
    },
    onFinish: () => { loading.value = false }
  })
}

// التنقل
function goToDashboard() { router.get('/dashboard') }
function goToReservations() { router.get('/reservations') }
</script>
