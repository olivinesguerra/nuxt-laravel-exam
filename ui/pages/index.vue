<script setup lang="ts">
  import Login from '~/src/components/templates/Login.vue';
  definePageMeta({
    middleware: 'auth'
  });
</script>

<template>
  <Login />
</template>

<style scoped>

</style>
