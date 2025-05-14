<script setup lang="ts">
  import TaskItemList from "@/src/components/organisms/TaskItemList.vue";
  let items = ref([
    {
      title: 'Item 1'
    },
    {
      title: 'Item 2'
    },
    {
      title: 'Item 3'
    }
  ]);
</script>

<template>
  <div 
    class="flex flex-row h-[calc(100vh-75px)] bg-black text-white justify-start p-[20px]">
      
    <div class="flex flex-col mr-[20px] items-center">
      <div class="flex w-full text-white text-left">Pending</div>
      <TaskItemList :tasks="items" />
    </div>

    <div class="flex flex-col mr-[20px]">
      <div class="flex w-full text-white text-left">In Progress</div>
      <TaskItemList :tasks="items" />
    </div>

    <div class="flex flex-col">
      <div class="flex w-full text-white text-left">Completed</div>
      <TaskItemList :tasks="items" />
    </div>
  </div>
</template>

<style scoped>

</style>