
<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { ref } from 'vue'
import axios from 'axios'

// Define types
interface FormData {
  name: string
  email: string
  password: string
}

interface ValidationErrors {
  [key: string]: string[]
}

// Form data
const form = ref<FormData>({
  name: '',
  email: '',
  password: ''
})

const success = ref<boolean>(false)
const loading = ref<boolean>(false)
const errors = ref<ValidationErrors>({})

// Submit form function
const submitForm = async () => {
  loading.value = true
  errors.value = {}
  
  try {
    await axios.post('/users', form.value)
    success.value = true
    form.value = { name: '', email: '', password: '' }
    
    // Redirect after 2 seconds
    setTimeout(() => {
      if (typeof window !== 'undefined') {
        window.location.href = '/users'
      }
    }, 2000)
  } catch (error: any) {
    console.error('Error creating user:', error.response?.data || error.message)
    
    if (error.response?.status === 422) {
      errors.value = error.response.data.errors || {}
    } else {
      alert("Gagal menambahkan user! Silakan coba lagi.")
    }
  } finally {
    loading.value = false
  }
}

// Go back function
const goBack = () => {
  if (typeof window !== 'undefined') {
    window.history.back()
  }
}
</script>
<template>
  <AuthenticatedLayout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-100 py-12">
      <div class="max-w-lg mx-auto px-4">
        <!-- Header Section -->
        <div class="text-center mb-8">
          <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full mb-4 shadow-lg">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
            </svg>
          </div>
          <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-2">
            Tambah User Baru
          </h1>
          <p class="text-gray-600">Buat akun user baru untuk sistem kasir</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 p-8">
          <form @submit.prevent="submitForm" class="space-y-6">
            <!-- Name Field -->
            <div class="space-y-2">
              <label for="name" class="block text-sm font-semibold text-gray-700">
                <span class="flex items-center">
                  <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                  </svg>
                  Nama Lengkap
                </span>
              </label>
              <input
                v-model="form.name"
                id="name"
                type="text"
                required
                placeholder="Masukkan nama lengkap"
                :class="[
                  'w-full px-4 py-3 bg-gray-50 border rounded-xl focus:outline-none focus:ring-2 focus:border-transparent transition-all duration-200 placeholder-gray-400',
                  errors.name ? 'border-red-300 focus:ring-red-500' : 'border-gray-200 focus:ring-blue-500'
                ]"
              />
              <p v-if="errors.name" class="text-red-500 text-sm mt-1">{{ errors.name[0] }}</p>
            </div>

            <!-- Email Field -->
            <div class="space-y-2">
              <label for="email" class="block text-sm font-semibold text-gray-700">
                <span class="flex items-center">
                  <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                  </svg>
                  Email Address
                </span>
              </label>
              <input
                v-model="form.email"
                id="email"
                type="email"
                required
                placeholder="contoh@email.com"
                :class="[
                  'w-full px-4 py-3 bg-gray-50 border rounded-xl focus:outline-none focus:ring-2 focus:border-transparent transition-all duration-200 placeholder-gray-400',
                  errors.email ? 'border-red-300 focus:ring-red-500' : 'border-gray-200 focus:ring-blue-500'
                ]"
              />
              <p v-if="errors.email" class="text-red-500 text-sm mt-1">{{ errors.email[0] }}</p>
            </div>

            <!-- Password Field -->
            <div class="space-y-2">
              <label for="password" class="block text-sm font-semibold text-gray-700">
                <span class="flex items-center">
                  <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                  </svg>
                  Password
                </span>
              </label>
              <input
                v-model="form.password"
                id="password"
                type="password"
                required
                placeholder="Masukkan password"
                :class="[
                  'w-full px-4 py-3 bg-gray-50 border rounded-xl focus:outline-none focus:ring-2 focus:border-transparent transition-all duration-200 placeholder-gray-400',
                  errors.password ? 'border-red-300 focus:ring-red-500' : 'border-gray-200 focus:ring-blue-500'
                ]"
              />
              <p v-if="errors.password" class="text-red-500 text-sm mt-1">{{ errors.password[0] }}</p>
            </div>

            <!-- Submit Button -->
            <button
              type="submit"
              :disabled="loading"
              :class="[
                'w-full py-3 px-6 rounded-xl font-semibold transition-all duration-200 shadow-lg flex items-center justify-center',
                loading 
                  ? 'bg-gray-400 cursor-not-allowed' 
                  : 'bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 hover:scale-[1.02] hover:shadow-xl'
              ]"
            >
              <svg v-if="loading" class="w-5 h-5 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
              </svg>
              <svg v-else class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
              </svg>
              {{ loading ? 'Memproses...' : 'Tambah User' }}
            </button>
          </form>

          <!-- Success Message -->
          <div
            v-if="success"
            class="mt-6 p-4 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-xl"
          >
            <div class="flex items-center">
              <div class="flex-shrink-0">
                <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
              </div>
              <div class="ml-3">
                <p class="text-sm font-medium text-green-800">
                  User berhasil ditambahkan!
                </p>
              </div>
            </div>
          </div>

          <!-- Back Button -->
          <div class="mt-6 text-center">
            <button
              @click="goBack"
              class="text-gray-500 hover:text-gray-700 transition-colors duration-200 flex items-center mx-auto"
            >
              <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
              </svg>
              Kembali
            </button>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>


