<template>
  <div class="flex justify-center items-center h-screen bg-gray-100">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
      <h2 class="text-2xl font-bold text-center mb-6 text-gray-800">
        Sacco Member Registration
      </h2>

      <form @submit.prevent="registerMember">
        <!-- Full Name -->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm mb-2">Full Name</label>
          <input
            v-model="name"
            type="text"
            placeholder="Enter your full name"
            class="w-full p-2 border rounded-md focus:border-blue-500 focus:ring"
            required
          />
        </div>

        <!-- Email -->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm mb-2">Email</label>
          <input
            v-model="email"
            type="email"
            placeholder="Enter your email"
            class="w-full p-2 border rounded-md focus:border-blue-500 focus:ring"
            required
          />
        </div>

        <!-- Phone -->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm mb-2">Phone</label>
          <input
            v-model="phone"
            type="text"
            placeholder="Enter your phone number"
            class="w-full p-2 border rounded-md focus:border-blue-500 focus:ring"
            required
          />
        </div>

        <!-- ID Number -->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm mb-2">ID Number</label>
          <input
            v-model="id_number"
            type="text"
            placeholder="Enter your ID number"
            class="w-full p-2 border rounded-md focus:border-blue-500 focus:ring"
            required
          />
        </div>

        <!-- Password -->
        <div class="mb-6">
          <label class="block text-gray-700 text-sm mb-2">Password</label>
          <input
            v-model="password"
            type="password"
            placeholder="Enter your password"
            class="w-full p-2 border rounded-md focus:border-blue-500 focus:ring"
            required
          />
        </div>

        <!-- Register Button -->
        <button
          type="submit"
          class="w-full py-2 bg-gradient-to-r from-orange-500 to-pink-600 text-white font-semibold rounded-md hover:opacity-90 transition"
        >
          Register
        </button>

        <!-- Redirect to Login -->
        <p class="text-center mt-4 text-sm">
          Already have an account?
          <router-link to="/login" class="text-blue-600 hover:underline">
            Login
          </router-link>
        </p>

        <!-- Alerts -->
        <p v-if="success" class="text-green-600 mt-4 text-center text-sm">
          {{ success }}
        </p>
        <p v-if="error" class="text-red-600 mt-4 text-center text-sm">
          {{ error }}
        </p>
      </form>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: "Register",
  data() {
    return {
      name: "",
      email: "",
      phone: "",
      id_number: "",
      password: "",
      success: "",
      error: "",
    };
  },
  methods: {
    async registerMember() {
      this.success = "";
      this.error = "";

      try {
        const response = await axios.post("http://127.0.0.1:8000/api/register", {
          name: this.name,
          email: this.email,
          phone: this.phone,
          id_number: this.id_number,
          password: this.password,
        });

        // Debug log to check API response
        console.log("Registration response:", response.data);

        if (response.data.success === true) {
          this.success = "✅ Registration successful! Redirecting to login...";
          // clear form
          this.name = "";
          this.email = "";
          this.phone = "";
          this.id_number = "";
          this.password = "";

          setTimeout(() => {
            this.$router.push("/login");
          }, 2000);
        } else {
          this.error =
            response.data.message || "⚠️ Registration failed. Please try again.";
        }
      } catch (err) {
        console.error("Registration error:", err.response?.data || err.message);
        this.error =
          err.response?.data?.message ||
          "🚫 Unable to connect to server. Please make sure the backend is running.";
      }
    },
  },
};
</script>

<style scoped>
body {
  font-family: "Inter", sans-serif;
}
</style>
