<script setup lang="ts">
  import TaskItem from "@/src/components/molecules/TaskItem.vue";
  const props = defineProps({
    tasks: {
      type: Array,
      required: true,
    },
    status: {
      type: String,
      required: true,
    },
  });
  const { tasks, status } = props;

  const onDragEnd = (item: any) => {
    console.log(item);
  };
</script>

<template>
  <div class="flex flex-col bg-white justify-center  w-[250px]">
    <VueDraggableNext 
      item-key="id" 
      class="flex flex-col w-full bg-black" 
      :list="[...tasks]" 
      @start="drag=true" 
      @end="onDragEnd"
    >
      <template #item="{element}" >
        <TaskItem :task="element"/>
      </template>
    </VueDraggableNext>
  </div>
</template>

<style scoped>

</style>
