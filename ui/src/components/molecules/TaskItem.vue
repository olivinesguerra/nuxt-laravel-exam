<script setup lang="ts">
  const props = defineProps({
    task: {
      type: Object,
      required: true,
    },
  });
  const { task } = props;
</script>

<template>
  <div class="flex flex-col bg-black justify-center">
    <div class="flex flex-1 text-white border-white border bg-black p-[20px] my-[5px]">
      <div class="flex">{{ task?.title }}</div>
    </div>
  </div>
</template>

<style scoped>

</style>
