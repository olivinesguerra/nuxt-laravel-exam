<script setup lang="ts">
  import Dashboard from '~/src/components/templates/Dashboard.vue';
  definePageMeta({
    middleware: 'auth'
  });
</script>

<template>
  <Dashboard />
</template>

<style scoped>

</style>
