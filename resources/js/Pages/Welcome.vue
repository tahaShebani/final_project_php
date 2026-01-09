<template>
  <div class="min-h-screen bg-gradient-to-br from-black via-gray-900 to-purple-900 flex items-center justify-center">
    <div class="text-center space-y-10 max-w-lg px-6">
      
      <!-- شعار -->
      <div class="flex justify-center">
        <div class="w-24 h-24 bg-purple-600 rounded-full flex items-center justify-center shadow-lg">
          <span class="text-white text-4xl font-bold">🚗</span>
        </div>
      </div>

      <!-- العنوان -->
      <h1 class="text-4xl md:text-5xl font-extrabold text-purple-400">
        نظام تأجير السيارات
      </h1>

      <!-- الوصف -->
      <p class="text-gray-300 leading-relaxed text-lg">
        مرحبًا بك في منصتنا لإدارة وتأجير السيارات.  
        سجل دخولك أو أنشئ حسابًا جديدًا لتبدأ رحلتك معنا بسهولة واحترافية.
      </p>

      <!-- الأزرار -->
      <div class="flex justify-center gap-6">
        <a href="/login"
           class="flex items-center gap-2 bg-purple-600 hover:bg-purple-700 px-6 py-3 rounded-lg text-white font-semibold shadow transition">
          <span>🔑</span> تسجيل الدخول
        </a>

        <a v-if="canRegister" href="/register"
           class="flex items-center gap-2 bg-gray-800 hover:bg-gray-700 px-6 py-3 rounded-lg text-white font-semibold shadow transition">
          <span>📝</span> تسجيل جديد
        </a>
      </div>

      <!-- روابط إضافية -->
      <div class="mt-8 text-sm text-gray-400 flex justify-center gap-6">
        <a href="https://laravel.com" target="_blank" class="hover:text-purple-300">Laravel</a>
        <a href="https://inertiajs.com" target="_blank" class="hover:text-purple-300">Inertia</a>
        <a href="https://tailwindcss.com" target="_blank" class="hover:text-purple-300">TailwindCSS</a>
      </div>
    </div>
  </div>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3'
const canRegister = usePage().props.canRegister
</script>
