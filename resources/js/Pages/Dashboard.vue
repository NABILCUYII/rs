<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3'
import { ref } from 'vue'

const menuKasir = ref([
  { title: "Penjualan", desc: "Transaksi & kasir", icon: "💳", color: "from-blue-500 to-blue-700", shadow: "shadow-blue-300" },
  { title: "Barang", desc: "Kelola stok & produk", icon: "📦", color: "from-green-500 to-green-700", shadow: "shadow-green-300" },
  { title: "Laporan", desc: "Statistik & laporan", icon: "📊", color: "from-pink-500 to-pink-700", shadow: "shadow-pink-300" },
  { title: "Pengaturan", desc: "Akun & preferensi", icon: "⚙️", color: "from-yellow-400 to-yellow-600", shadow: "shadow-yellow-200" },
]);
</script>

<template>
  <Head title="Dashboard" />
  <AuthenticatedLayout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-pink-50 flex flex-col relative overflow-hidden">
      <!-- Decorative Background -->
      <div class="absolute -top-24 -left-24 w-80 h-80 bg-blue-100 opacity-40 rounded-full blur-2xl z-0"></div>
      <div class="absolute -bottom-32 -right-32 w-[22rem] h-[22rem] bg-pink-100 opacity-40 rounded-full blur-2xl z-0"></div>
      <svg class="absolute top-8 right-8 w-24 h-24 opacity-10 z-0" viewBox="0 0 100 100">
        <circle cx="50" cy="50" r="40" fill="#fbbf24" />
      </svg>
      <svg class="absolute bottom-20 left-10 w-16 h-16 opacity-10 z-0" viewBox="0 0 100 100">
        <rect x="10" y="10" width="80" height="80" rx="20" fill="#60a5fa" />
      </svg>
      <!-- Header -->
      <header class="p-8 text-center z-10 relative">
        <div class="flex justify-center mb-4">
          <img src="https://img.icons8.com/color/96/000000/cash-register.png" alt="Kasir Icon" class="w-16 h-16 drop-shadow-lg animate-bounce-slow" />
        </div>
        <h1 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-700 via-pink-500 to-yellow-400 drop-shadow-lg mb-2 tracking-tight">
          Selamat Datang di Mesin Kasir
        </h1>
        <p class="text-base md:text-lg text-gray-600 font-medium">Solusi kasir modern, mudah & cepat</p>
      </header>

      <!-- Content -->
      <main class="flex-1 flex flex-col items-center justify-center z-10">
        <!-- Section: Kasir Menu -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 w-full max-w-6xl px-4 py-6">
          <div
            v-for="item in menuKasir"
            :key="item.title"
            class="group bg-white/95 shadow-xl rounded-2xl p-6 flex flex-col items-center text-center border border-gray-100 hover:border-blue-400 transition-all duration-300 cursor-pointer hover:-translate-y-1 relative overflow-hidden"
            :class="item.shadow"
          >
            <!-- Gradient Accent Bar -->
            <div :class="`absolute top-0 left-0 w-full h-1.5 rounded-t-2xl bg-gradient-to-r ${item.color}`"></div>
            <!-- Animated Icon Circle -->
            <div class="mb-3">
              <div :class="`w-14 h-14 flex items-center justify-center rounded-full bg-gradient-to-br ${item.color} text-white text-3xl shadow-md group-hover:scale-105 transition-transform duration-200 animate-pop`">
                {{ item.icon }}
              </div>
            </div>
            <h2 class="text-lg font-bold text-gray-800 mb-1 group-hover:text-blue-600 transition-colors duration-200">
              {{ item.title }}
            </h2>
            <p class="text-sm text-gray-500 font-medium">{{ item.desc }}</p>
            <!-- Decorative floating dots -->
            <span class="absolute bottom-3 right-3 w-2 h-2 bg-blue-200 rounded-full opacity-50 animate-pulse"></span>
            <span class="absolute top-3 left-3 w-1.5 h-1.5 bg-pink-200 rounded-full opacity-50 animate-pulse"></span>
          </div>
        </div>
        <!-- Extra: Motivational Quote Card -->
        <div class="mt-6 max-w-lg w-full mx-auto bg-white/90 rounded-xl shadow p-4 flex items-center gap-3 border border-blue-100">
          <svg class="w-8 h-8 text-yellow-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 20h.01M12 4v16m8-8H4"></path>
          </svg>
          <div>
            <p class="text-base font-semibold text-gray-700">"Kesuksesan adalah hasil dari persiapan, kerja keras, dan belajar dari kegagalan."</p>
            <span class="text-xs text-gray-400">- Colin Powell</span>
          </div>
        </div>
      </main>

      <!-- Footer -->
      <footer class="p-3 text-center bg-white/90 text-gray-700 text-xs z-10 shadow-inner relative">
        <div class="flex items-center justify-center gap-2 mb-1">
          <svg class="w-4 h-4 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
            <path d="M2.003 9.25C2.003 5.798 5.134 3 9 3s6.997 2.798 6.997 6.25c0 2.386-1.386 4.463-3.5 5.74V17a1 1 0 01-1.447.894l-2-1A1 1 0 019 16v-1.01c-2.114-1.277-3.5-3.354-3.5-5.74z"/>
          </svg>
          <span>© 2025 Mesin Kasir App - Laravel 12 + Vue 3</span>
        </div>
        <div class="text-[10px] text-gray-400">Dibuat dengan <span class="text-pink-500">❤</span> oleh Tim Anda</div>
      </footer>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
/* Custom scrollbar for menu grid */
::-webkit-scrollbar {
  width: 8px;
  background: transparent;
}
::-webkit-scrollbar-thumb {
  background: #e0e7ff;
  border-radius: 8px;
}

/* Animations */
@keyframes pop {
  0% { transform: scale(0.95);}
  60% { transform: scale(1.08);}
  100% { transform: scale(1);}
}
.animate-pop {
  animation: pop 0.5s cubic-bezier(.68,-0.55,.27,1.55) both;
}
@keyframes bounce-slow {
  0%, 100% { transform: translateY(0);}
  50% { transform: translateY(-12px);}
}
.animate-bounce-slow {
  animation: bounce-slow 2.5s infinite;
}
</style>
