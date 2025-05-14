<script setup lang="ts">
  import Header from './src/components/molecules/Header.vue';
  import Footer from './src/components/molecules/Footer.vue';
</script>

<template>
   <div>
      <NuxtLayout>
         <Header />
         <NuxtPage />
         <Footer />
      </NuxtLayout>
   </div>
</template>