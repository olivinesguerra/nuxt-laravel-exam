<script setup lang="ts">
  import moment from "moment";

  const props = defineProps({
    task: {
      type: Object,
      required: true,
    },
  });
  const { task } = props;
  console.log(task);
</script>

<template>
  <div class="flex flex-col bg-black justify-center">
    <div class="flex flex-col flex-1 text-white border-white border rounded  bg-black p-[20px] my-[5px]">
      <div class="flex text-[20px]">{{ task?.title }}</div>
      <div class="flex text-[15px]">{{ task?.description }}</div>
      <div class="flex text-[15px]">{{ moment.unix(task?.due_date)?.format("MMM DD, YYYY HH:mm A") }}</div>
    </div>
  </div>
</template>

<style scoped>

</style>
