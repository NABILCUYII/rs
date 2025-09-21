
<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'


</script>
<template>
    <AuthenticatedLayout>
  <div class="max-w-md mx-auto bg-white shadow-lg rounded-xl p-6 mt-10">
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Add User</h2>

    <form @submit.prevent="submitForm" class="space-y-4">
      <!-- Name -->
      <div>
        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
        <input
          v-model="form.name"
          id="name"
          type="text"
          required
          class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
        />
      </div>

      <!-- Email -->
      <div>
        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
        <input
          v-model="form.email"
          id="email"
          type="email"
          required
          class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
        />
      </div>

      <!-- Password -->
      <div>
        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
        <input
          v-model="form.password"
          id="password"
          type="password"
          required
          class="mt-1 w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
        />
      </div>

      <!-- Button -->
      <button
        type="submit"
        class="w-full bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 transition duration-200 font-semibold"
      >
        Add User
      </button>
    </form>

    <!-- Success Message -->
    <div
      v-if="success"
      class="mt-4 p-3 rounded-lg bg-green-100 text-green-700 text-sm text-center"
    >
      <button
             
            >
               success
            </button>
    </div>
  </div>
  </AuthenticatedLayout>
</template>

<script lang="ts">
import axios from "axios"

export default {
  data() {
    return {
      form: {
        name: '',
        email: '',
        password: ''
      },
      success: false
    }
  },
  methods: {
    async submitForm() {
      try {
        await axios.post('/users', this.form) // panggil Laravel API
        this.success = true
        this.form = { name: '', email: '', password: '' }
        setTimeout(() => (this.success = false), 3000)
      } catch (error) {
        console.error(error.response?.data || error.message)
        alert("Gagal menambahkan user!")
      }
      if (this.success) {
        window.location.href = '/users'; // Redirect to users list page
      }
    }
  },

  

  
}
</script>

