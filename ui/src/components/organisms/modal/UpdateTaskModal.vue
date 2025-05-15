<script setup lang="ts">
  import { VueFinalModal } from 'vue-final-modal';
  import moment from "moment";
  import { Input } from '@/src/components/atoms/ui/input';
  import { Textarea } from '@/src/components/atoms/ui/textarea';
  import { Button } from "@/src/components/atoms/ui/button";
  import {
    DateFormatter,
    type DateValue
  } from '@internationalized/date';
  import { useTaskStore } from "@/src/store/useTaskStore";

  const { 
    updateById, 
    isLoading, 
  } = useTaskStore();

  const df = new DateFormatter('en-US', {
    dateStyle: 'long',
  });

  const props = defineProps({
    task: {
      type: String,
      required: true,
    },
  });
  const { task } = props;
  const title = ref(task?.title);
  const description = ref(task?.description);
  const date = ref<DateValue>()

  const emit = defineEmits<{(e: 'confirm'): void}>();

  const onSubmit = async() => {
    const selectedDate: any = {...date?.value};
    const jsonDate = new Date(selectedDate?.year, selectedDate?.month, selectedDate?.day);
    const momentDate = moment(jsonDate).unix();

    await updateById(task?.id, {
      title: title.value,
      description: description.value,
      due_data: date.value
    });
    emit('confirm')
  };
</script>

<template>
   <VueFinalModal 
      class="flex justify-center items-center z-0"
      content-class="flex flex-col max-w-xl mx-4 p-4 bg-gray-600 border dark:border-gray-700 rounded-lg space-y-2 w-[500px] z-0"
      overlay-class="z-0"
      overlay-style="z-0"
      z-index="false"
      hide-overlay="true"
      z-index-base="0"
      z-index-auto="false"
    >
      <h1 class="text-xl text-white mb-[10px]">
        Update Task
      </h1>
      <Input 
        class="flex mb-[10px] text-white" 
        placeholder="Title" 
        v-model="title" 
      />
      <Textarea 
        class="flex mb-[10px] text-white" 
        placeholder="Description" 
        v-model="description" 
      />

      <Calendar 
        v-model="date" 
        initial-focus 
        class="flex flex-col justify-center z-50 text-white items-center" 
      />
      
      <Button class="flex w-full text-white border border-white z-0" @click="onSubmit">
        Update
      </Button>
  </VueFinalModal>
</template>

<style scoped>

</style>
