<script setup lang="ts">
  const props = defineProps({
    tasks: {
      type: Array,
      required: true,
    },
  });
  const { tasks } = props;
</script>

<template>
  <div class="flex flex-col bg-white justify-center items-center w-[250px]">
    <VueDraggableNext item-key="id" class="flex flex-col w-full bg-black" :list="[...tasks]" @start="drag=true" @end="drag=false">
      <template class="flex grow" #item="{element}">
        <div class="flex p-[20px] my-[5px] flex-1 text-white border-white border bg-black">
          <div class="flex">{{ element?.title }}</div>
        </div>
      </template>
    </VueDraggableNext>
  </div>
</template>

<style scoped>

</style>
