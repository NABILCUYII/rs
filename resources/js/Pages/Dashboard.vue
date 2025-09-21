<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3'
</script>

<template>
  <Head title="Dashboard" />
<AuthenticatedLayout>
  <div class="min-h-screen bg-gradient-to-b from-red-200 via-white to-blue-200 flex flex-col">
    <!-- Header -->
    <header class="p-6 text-center">
      <h1 class="text-5xl font-bold text-gray-800 italic">Welcome</h1>
      <p class="text-lg text-gray-600">Test Design</p>
    </header>

    <!-- Content -->
    <main class="flex-1 flex flex-col items-center justify-center space-y-10">
      <!-- Section: Kasir Menu -->
      <div class="grid grid-cols-2 md:grid-cols-4 gap-6 w-10/12">
        <div
          v-for="item in menuKasir"
          :key="item.title"
          class="bg-white/80 shadow-xl rounded-2xl p-6 text-center hover:scale-105 transition"
        >
          <div class="text-4xl mb-3">{{ item.icon }}</div>
          <h2 class="text-xl font-semibold">{{ item.title }}</h2>
          <p class="text-sm text-gray-600">{{ item.desc }}</p>
        </div>
      </div>
    </main>

    <!-- Footer -->
    <footer class="p-4 text-center bg-white/70 text-gray-700 text-sm">
      © 2025 Mesin Kasir App - Laravel 12 + Vue 3
    </footer>
  </div>
  </AuthenticatedLayout>
</template>

<script lang="ts">
export default {
  data() {
    return {
      menuKasir: [
        { title: "Penjualan", desc: "Transaksi & kasir", icon: "💳" },
        { title: "Barang", desc: "Kelola stok & produk", icon: "📦" },
        { title: "Laporan", desc: "Statistik & laporan", icon: "📊" },
        { title: "Pengaturan", desc: "Akun & preferensi", icon: "⚙️" },
      ],
    }
  },
}
</script>

<style scoped>
/* Bisa tambah efek sesuai kebutuhan */
</style>
