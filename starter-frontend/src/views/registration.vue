<template>
  <div class="flex justify-center items-center h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white p-8 rounded shadow">
      <h2 class="text-2xl font-bold text-center mb-4">Sacco Member Registration</h2>
      
      <form @submit.prevent="registerMember">
        <input v-model="name" type="text" placeholder="Full Name" class="w-full mb-2 p-2 border rounded" required/>
        <input v-model="email" type="email" placeholder="Email" class="w-full mb-2 p-2 border rounded" required/>
        <input v-model="phone" type="text" placeholder="Phone" class="w-full mb-2 p-2 border rounded" required/>
        <input v-model="id_number" type="text" placeholder="ID Number" class="w-full mb-2 p-2 border rounded" required/>
        
        <!-- Fixed payment field -->
        <div class="mb-4">
          <label class="block mb-1 font-semibold">Monthly Contribution (KES)</label>
          <input type="number" value="1000" disabled class="w-full p-2 border rounded bg-gray-200 cursor-not-allowed"/>
        </div>

        <button type="submit" class="w-full py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
          Register & Pay KES 1,000
        </button>
      </form>

      <p v-if="success" class="text-green-600 mt-2 text-center">{{ success }}</p>
      <p v-if="error" class="text-red-600 mt-2 text-center">{{ error }}</p>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Registration",
  data() {
    return {
      name: "",
      email: "",
      phone: "",
      id_number: "",
      success: "",
      error: "",
    };
  },
  methods: {
    async registerMember() {
      this.error = "";
      this.success = "";

      try {
        const response = await axios.post("http://127.0.0.1:8000/api/register", {
          name: this.name,
          email: this.email,
          phone: this.phone,
          id_number: this.id_number,
          monthly_contribution: 1000
        });

        if (response.data.success) {
          this.success = "Registration successful! KES 1,000 payment recorded.";
          // Optional: redirect to login
          setTimeout(() => this.$router.push("/login"), 1500);
        } else {
          this.error = response.data.message || "Registration failed";
        }
      } catch (err) {
        this.error = err.response?.data?.message || "An error occurred";
      }
    },
  },
};
</script>

<style scoped>
</style>
