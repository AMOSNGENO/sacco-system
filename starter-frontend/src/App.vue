<template>
  <div class="min-h-screen bg-gray-200">
    <siteHeader />
    <div class="flex justify-center items-center min-h-screen">
      <router-view />
    </div>
  </div>
</template>

<script>
import siteHeader from "@/components/header/header.vue";
import "@/assets/tailwind.css";

export default {
  name: "App",
  components: {
    siteHeader,
  },
  created() {
    // Optional auth check
    this.$store?.dispatch?.("auth/check_auth");
  },
};
</script>

<style>
/* optional global styling */
</style>
