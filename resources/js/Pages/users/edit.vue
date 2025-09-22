<script setup lang="ts">
import { ref } from 'vue'
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, router, usePage } from '@inertiajs/vue3'

const page = usePage()
const user: any = page.props.user

// Form data
const form = ref({
  name: user.name || '',
  email: user.email || '',
  password: '' // kosong, diisi kalau mau update password
})

// State modal konfirmasi
const showConfirm = ref(false)

function openConfirmModal() {
  showConfirm.value = true
}

function closeConfirmModal() {
  showConfirm.value = false
}

function confirmUpdate() {
  router.put(`/users/${user.id}`, form.value, {
    onSuccess: () => {
      alert("User berhasil diperbarui!")
      router.visit('/users')
    },
    onError: (errors) => {
      console.error(errors)
      alert("Gagal memperbarui user!")
    }
  })
  closeConfirmModal()
}
</script>

<style scoped>
@keyframes scale-in {
  0% {
    transform: scale(0.9);
    opacity: 0;
  }
  100% {
    transform: scale(1);
    opacity: 1;
  }
}

.animate-scale-in {
  animation: scale-in 0.2s ease-out;
}
</style>

<template>
  <AuthenticatedLayout>
    <Head title="Edit User" />

    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-100 py-12">
      <div class="max-w-2xl mx-auto px-4">
        <!-- Header Section -->
        <div class="text-center mb-8">
          <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full mb-4 shadow-lg">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
          </div>
          <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-2">
            Edit User
          </h1>
          <p class="text-gray-600">Perbarui informasi pengguna</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 p-8">
          <form @submit.prevent="openConfirmModal" class="space-y-6">
            <!-- Name Field -->
            <div class="space-y-2">
              <label class="block text-sm font-semibold text-gray-700">
                <span class="flex items-center">
                  <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                  </svg>
                  Nama Lengkap
                </span>
              </label>
              <input 
                v-model="form.name" 
                type="text"
                placeholder="Masukkan nama lengkap"
                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 placeholder-gray-400"
              />
            </div>

            <!-- Email Field -->
            <div class="space-y-2">
              <label class="block text-sm font-semibold text-gray-700">
                <span class="flex items-center">
                  <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                  </svg>
                  Email Address
                </span>
              </label>
              <input 
                v-model="form.email" 
                type="email"
                placeholder="contoh@email.com"
                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 placeholder-gray-400"
              />
            </div>

            <!-- Password Field -->
            <div class="space-y-2">
              <label class="block text-sm font-semibold text-gray-700">
                <span class="flex items-center">
                  <svg class="w-4 h-4 mr-2 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                  </svg>
                  Password Baru
                  <span class="ml-2 text-xs text-gray-500 font-normal">(kosongkan jika tidak diganti)</span>
                </span>
              </label>
              <input 
                v-model="form.password" 
                type="password"
                placeholder="Masukkan password baru"
                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 placeholder-gray-400"
              />
            </div>

            <!-- Action Buttons -->
            <div class="flex justify-end space-x-4 pt-4">
              <button 
                type="button"
                @click="window.history.back()"
                class="px-6 py-3 bg-gray-100 text-gray-700 rounded-xl font-semibold hover:bg-gray-200 transition-all duration-200 flex items-center"
              >
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Batal
              </button>
              <button 
                type="submit"
                class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl font-semibold hover:from-blue-700 hover:to-indigo-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center"
              >
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Update User
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Modal Konfirmasi -->
    <div v-if="showConfirm" class="fixed inset-0 flex items-center justify-center bg-black/50 backdrop-blur-sm z-50 p-4">
      <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-2xl p-8 w-full max-w-md border border-white/20 animate-scale-in">
        <div class="text-center">
          <!-- Icon -->
          <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-full mb-4 shadow-lg">
            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
          
          <h2 class="text-2xl font-bold text-gray-800 mb-2">Konfirmasi Update</h2>
          <p class="text-gray-600 mb-8">Apakah Anda yakin ingin memperbarui data user ini?</p>
          
          <div class="flex justify-center space-x-4">
            <button 
              @click="closeConfirmModal"
              class="px-6 py-3 bg-gray-100 text-gray-700 rounded-xl font-semibold hover:bg-gray-200 transition-all duration-200 flex items-center"
            >
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
              Batal
            </button>
            <button 
              @click="confirmUpdate"
              class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl font-semibold hover:from-blue-700 hover:to-indigo-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl flex items-center"
            >
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
              </svg>
              Ya, Update
            </button>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
