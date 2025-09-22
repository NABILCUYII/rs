<script setup lang="ts">
import { ref } from 'vue'

import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, usePage, router } from '@inertiajs/vue3'
import Swal from 'sweetalert2'
// Definisikan tipe data
interface Record {
  id: number
    id_pasien: number
  dokter: string
  tindakan: string
  jumlah: number
}

// Dummy data (nanti bisa diganti dari Laravel)
const records = ref<Array<Record>>([
 
    
])
const page = usePage()
records.value = Array.isArray(page.props.tindakan) ? page.props.tindakan : []

function goToCreateTindakan() {
    router.visit('/tindakan/create')
}

function deleteTindakan(id: number) {
 Swal.fire({
    title: "Apakah kamu yakin?",
    text: "User akan dihapus permanen!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#d33",
    cancelButtonColor: "#3085d6",
    confirmButtonText: "Ya, hapus!"
  }).then((result) => {
    if (result.isConfirmed) {
      router.delete(`/tindakan/${id}`, {
        onSuccess: () => {
          Swal.fire("Dihapus!", "User berhasil dihapus.", "success").then(() => {
            router.reload({ only: ['tindakan'] }) // refresh data tindakan
          })
        },
        onError: (err) => {
          console.error("Gagal menghapus user:", err)
          Swal.fire("Gagal!", "Terjadi kesalahan saat menghapus user.", "error")
        }
      })
    }
  })
}

function editTindakan(id: number) {
    router.visit(`/tindakan/${id}/edit`)
}
</script>

<template>
     <AuthenticatedLayout> 
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4 text-blue-700">Data Tindakan Dokter</h1>


<button
                class="mb-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition"
                @click="goToCreateTindakan"
            >
                Add Tindakan Pasient
            </button>

    <div class="overflow-x-auto bg-white shadow rounded-lg">
      <table class="w-full border-collapse">
        <thead class="bg-green-600 text-white">
          <tr>
            <th class="px-4 py-2 border">ID</th>
            <th class="px-4 py-2 border">ID PASIEN</th>
            <th class="px-4 py-2 border">Dokter</th>
            <th class="px-4 py-2 border">Tindakan</th>
            <th class="px-4 py-2 border">Jumlah</th>
            <th class="px-4 py-2 border text-center">Aksi</th>

          </tr>
        </thead>
        <tbody>
          <tr
            v-for="record in records"
            :key="record.id"
            class="odd:bg-white even:bg-green-50 hover:bg-green-100 transition"
          >
            <td class="px-4 py-2 border">{{ record.id }}</td>
            <td class="px-4 py-2 border">{{ record.id_pasien }}</td>
            <td class="px-4 py-2 border">{{ record.dokter }}</td>
            <td class="px-4 py-2 border">{{ record.tindakan }}</td>
            <td class="px-4 py-2 border text-center">{{ record.jumlah }}</td>
            <td class="px-4 py-2 border text-center">
              <!-- Tombol Aksi (Edit, Delete, dll) bisa ditambahkan di sini -->
                <button
                class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition"
                @click="editTindakan(record.id)"
              >
                edit
              </button>
             
           
                 <button
                class="ml-2 px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition"
                @click="deleteTindakan(record.id)"
              >
                Delete
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  </AuthenticatedLayout>
</template>
