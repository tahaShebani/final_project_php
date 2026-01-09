<template>
  <div class="p-6 max-w-lg mx-auto bg-black rounded shadow text-white">
    <h1 class="text-2xl font-bold mb-6 text-purple-400">تعديل ملف المستخدم</h1>

    <!-- عرض البيانات الحالية -->
    <div class="mb-4 p-3 bg-gray-900 rounded" v-if="user">
      <p class="font-semibold">بياناتك الحالية:</p>
      <p> الاسم: {{ user?.name ?? 'غير مسجل' }}</p>
      <p> البريد: {{ user?.email ?? 'غير مسجل' }}</p>
      <p> الهاتف: {{ user?.phone_number ?? 'غير مسجل' }}</p>
      <p> العنوان: {{ user?.address ?? 'غير مسجل' }}</p>
      <p> تاريخ الميلاد: {{ user?.birth_date ?? 'غير مسجل' }}</p>
    </div>

    <!-- فورم التعديل -->
    <form @submit.prevent="updateProfile" class="space-y-4" v-if="user">
      <div>
        <label class="block mb-1">الاسم</label>
        <input v-model="form.name" type="text" class="border rounded p-2 w-full bg-black text-white" />
      </div>

      <div>
        <label class="block mb-1">البريد الإلكتروني</label>
        <input v-model="form.email" type="email" class="border rounded p-2 w-full bg-black text-white" />
      </div>

      <div>
        <label class="block mb-1">رقم الهاتف</label>
        <input v-model="form.phone_number" type="text" class="border rounded p-2 w-full bg-black text-white" />
      </div>

      <div>
        <label class="block mb-1">العنوان</label>
        <input v-model="form.address" type="text" class="border rounded p-2 w-full bg-black text-white" />
      </div>

      <div>
        <label class="block mb-1">تاريخ الميلاد</label>
        <input v-model="form.birth_date" type="date" class="border rounded p-2 w-full bg-black text-white" />
      </div>

      <div>
        <label class="block mb-1">كلمة المرور الجديدة</label>
        <input v-model="form.password" type="password" class="border rounded p-2 w-full bg-black text-white" />
      </div>

      <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
        حفظ التعديلات
      </button>
    </form>
  </div>
</template>

<script setup>
import { router, usePage } from '@inertiajs/vue3'
import { reactive } from 'vue'

// نضمن أن user موجود حتى لو السيرفر ما أرسل بيانات
const user = usePage().props?.user || {}

const form = reactive({
  name: user?.name ?? '',
  email: user?.email ?? '',
  phone_number: user?.phone_number ?? '',
  address: user?.address ?? '',
  birth_date: user?.birth_date ?? '',
  password: ''
})

function updateProfile() {
  router.put('/profile', form)
}
</script>
