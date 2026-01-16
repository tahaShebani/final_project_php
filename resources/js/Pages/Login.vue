<template>
  <div class="min-h-screen bg-gradient-to-br from-black via-gray-900 to-purple-900 flex items-center justify-center">
    <div class="bg-gray-900 p-8 rounded-lg shadow-lg w-full max-w-md">
      <h1 class="text-3xl font-bold text-purple-400 mb-6 text-center">تسجيل الدخول</h1>
      <form @submit.prevent="login" class="space-y-4">
        <div>
          <label class="block text-gray-300 mb-1">البريد الإلكتروني</label>
          <input v-model="form.email" type="email" class="w-full px-4 py-2 rounded bg-black text-white border border-purple-600" />
        </div>
        <div>
          <label class="block text-gray-300 mb-1">كلمة المرور</label>
          <input v-model="form.password" type="password" class="w-full px-4 py-2 rounded bg-black text-white border border-purple-600" />
        </div>
        <button type="submit" class="w-full bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 rounded-lg">
          دخول
        </button>
      </form>
      <div class="mt-6 text-center text-sm text-gray-400">
        <a href="/register" class="hover:text-purple-300">إنشاء حساب جديد</a>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive } from 'vue'
import { router } from '@inertiajs/vue3'

const form = reactive({ email: '', password: '' })
function login() {
  router.post('/login', form)
}
</script>
