<template>
  <div class="flex justify-center items-center flex-wrap h-full g-6 text-gray-800">
    <div class="xl:w-10/12">
      <div class="block bg-white shadow-lg rounded-lg">
        <div class="lg:flex lg:flex-wrap g-0">

          <!-- Left Section -->
          <div class="lg:w-6/12 px-4 md:px-0">
            <div class="md:p-12 md:mx-6">
              <h4 class="text-2xl font-semibold mb-4 text-center">Sacco Member Login</h4>

              <form @submit.prevent="onLogin">
                <div class="mb-4">
                  <input
                    type="email"
                    v-model="email"
                    placeholder="Email"
                    class="block w-full px-3 py-2 border border-gray-300 rounded-md focus:border-blue-600 focus:ring-1 focus:ring-blue-600"
                    required
                  />
                </div>

                <div class="mb-4">
                  <input
                    type="password"
                    v-model="password"
                    placeholder="Password"
                    class="block w-full px-3 py-2 border border-gray-300 rounded-md focus:border-blue-600 focus:ring-1 focus:ring-blue-600"
                    required
                  />
                </div>

                <div v-if="error" class="text-red-600 text-sm mb-3">{{ error }}</div>
                <div v-if="success" class="text-green-600 text-sm mb-3">{{ success }}</div>

                <button
                  type="submit"
                  class="w-full py-2.5 text-white font-medium text-xs uppercase rounded-md shadow-md transition-all duration-150 ease-in-out"
                  style="background: linear-gradient(to right,#ee7724,#d8363a,#dd3675,#b44593);"
                >
                  Login
                </button>

                <div class="flex justify-between items-center mt-4">
                  <p class="text-sm text-gray-600">Don’t have an account?</p>
                  <router-link
                    to="/registration"
                    class="text-blue-600 hover:underline text-sm"
                  >
                    Register
                  </router-link>
                </div>
              </form>
            </div>
          </div>

          <!-- Right Section -->
          <div
            class="lg:w-6/12 flex items-center justify-center text-white p-12 rounded-r-lg"
            style="background: linear-gradient(to right, #ee7724, #d8363a, #dd3675, #b44593);"
          >
            <div class="max-w-md">
              <h4 class="text-xl font-semibold mb-4">Welcome to Our Sacco</h4>
              <p class="text-sm">
                Manage your contributions and savings with ease. Stay informed, stay empowered.
              </p>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "LoginForm",
  data() {
    return {
      email: "",
      password: "",
      error: "",
      success: "",
    };
  },
  methods: {
    onLogin() {
      this.error = "";
      this.success = "";

      // Simple validation (optional)
      if (!this.email || !this.password) {
        this.error = "Please enter both email and password.";
        return;
      }

      // Hardcoded check (you can skip or accept any credentials)
      // Example: accept any email/password
      this.success = "Login successful! Redirecting...";
      localStorage.setItem("token", "mock-token"); // fake token

      setTimeout(() => {
        this.$router.push("/dashboard"); // navigate to dashboard
      }, 1000);
    },
  },
};
</script>
