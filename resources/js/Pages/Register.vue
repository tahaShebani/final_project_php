<template>
  <div class="min-h-screen bg-gradient-to-br from-black via-gray-900 to-purple-900 flex items-center justify-center">
    <div class="bg-gray-900 p-8 rounded-lg shadow-lg w-full max-w-md">
      <h1 class="text-3xl font-bold text-purple-400 mb-6 text-center">إنشاء حساب جديد</h1>
      <form @submit.prevent="register" class="space-y-4">
        <div>
          <label class="block text-gray-300 mb-1">الاسم الكامل</label>
          <input v-model="form.name" type="text" class="w-full px-4 py-2 rounded bg-black text-white border border-purple-600" />
        </div>
        <div>
          <label class="block text-gray-300 mb-1">البريد الإلكتروني</label>
          <input v-model="form.email" type="email" class="w-full px-4 py-2 rounded bg-black text-white border border-purple-600" />
        </div>
        <div>
          <label class="block text-gray-300 mb-1">كلمة المرور</label>
          <input v-model="form.password" type="password" class="w-full px-4 py-2 rounded bg-black text-white border border-purple-600" />
        </div>
        <div>
          <label class="block text-gray-300 mb-1">تأكيد كلمة المرور</label>
          <input v-model="form.password_confirmation" type="password" class="w-full px-4 py-2 rounded bg-black text-white border border-purple-600" />
        </div>
        <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 rounded-lg">
          تسجيل
        </button>
      </form>
      <div class="mt-6 text-center text-sm text-gray-400">
        <a href="/login" class="hover:text-purple-300">لديك حساب بالفعل؟ تسجيل الدخول</a>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

const form = reactive({
  name: '',
  email: '',
  password: '',
  password_confirmation: ''
})

function register() {
  router.post('/register', form)
}
</script>
