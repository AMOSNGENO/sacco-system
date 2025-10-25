<template>
  <div class="p-6">
    <p class="text-2xl font-bold text-blue-800 mb-4">
      Welcome, {{ member.name || 'Guest' }}!
    </p>
    <p class="text-lg text-gray-700 mb-4">
      Your monthly contribution: KES {{ member.monthly_contribution || 0 }}
    </p>
    <button 
      @click="sendReminder" 
      class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition"
    >
      Send Contribution Reminder
    </button>
    <p v-if="success" class="text-green-600 mt-2">{{ success }}</p>
  </div>
</template>

<script>
export default {
  name: "Home",
  data() {
    return {
      member: JSON.parse(localStorage.getItem('member') || '{}'),
      success: '',
    };
  },
  methods: {
    sendReminder() {
      // Simulate sending monthly email
      this.success = `Reminder sent to ${this.member.email || 'your email'} (simulated)`;
    }
  }
};
</script>

<style scoped>
/* Optional styling */
</style>
