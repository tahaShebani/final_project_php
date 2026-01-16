<script setup>
import { Head, router } from '@inertiajs/vue3'

const props = defineProps({
  user: Object,
  payments: Array
})

// عملية الدفع
function payNow(paymentId) {
  router.post(`/payments/${paymentId}/pay`, {}, {
    onSuccess: () => {
      alert('✅ تم الدفع بنجاح')
    }
  })
}
</script>

<template>
  <Head title="مدفوعات إضافية" />

  <div class="min-h-screen bg-gray-950 p-6">
    <div class="bg-gray-900 p-8 rounded-lg shadow-lg text-white">
      <h1 class="text-2xl font-bold mb-6 text-center text-purple-400">
        المدفوعات الإضافية (جزاءات)
      </h1>

      <!-- جدول المدفوعات -->
      <div v-if="payments.length">
        <table class="w-full text-left border-collapse">
          <thead>
            <tr class="text-purple-400 border-b border-gray-700">
              <th class="p-3">رقم الحجز</th>
              <th class="p-3">السيارة</th>
              <th class="p-3">المبلغ</th>
              <th class="p-3">السبب</th>
              <th class="p-3">الحالة</th>
              <th class="p-3">إجراء</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="p in payments" :key="p.id" class="border-b border-gray-700">
              <td class="p-3">#{{ p.reservation_id }}</td>
              <td class="p-3">
                {{ p.reservation?.car_model?.brand ?? 'غير محدد' }}
                - {{ p.reservation?.car_model?.model_name ?? '' }}
              </td>
              <td class="p-3">{{ p.amount }} دينار</td>
              <td class="p-3">{{ p.note }}</td>
              <td class="p-3">
                <span v-if="p.paid_at" class="text-green-400 font-semibold">مدفوع</span>
                <span v-else class="text-red-400 font-semibold">غير مدفوع</span>
              </td>
              <td class="p-3">
                <button v-if="!p.paid_at"
                        @click="payNow(p.id)"
                        class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded">
                  ادفع الآن
                </button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>

      <!-- لا توجد مدفوعات -->
      <div v-else class="text-center text-gray-400">
        لا توجد مدفوعات إضافية مسجلة عليك.
      </div>
    </div>
  </div>
</template>
