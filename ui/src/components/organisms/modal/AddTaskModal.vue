<script setup lang="ts">
  import { VueFinalModal } from 'vue-final-modal';

  import { cn } from '~/lib/utils';
  import { Input } from '@/src/components/atoms/ui/input';
  import { Textarea } from '@/src/components/atoms/ui/textarea';
  import { Button } from "@/src/components/atoms/ui/button";
  import { Popover, PopoverContent, PopoverTrigger } from '@/src/components/atoms/ui/popover';
  import { CalendarIcon } from 'lucide-vue-next';
  import {
    DateFormatter,
    type DateValue,
    getLocalTimeZone,
  } from '@internationalized/date'

  const df = new DateFormatter('en-US', {
    dateStyle: 'long',
  });

  const props = defineProps({});
  const title = ref('');
  const description = ref('');
  const value = ref<DateValue>()

  const emit = defineEmits<{(e: 'confirm'): void}>();

  const onSubmit = async() => {
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
          Add Task
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
        v-model="value" 
        initial-focus 
        class="flex flex-col justify-center z-50 text-white items-center" 
      />
      
      <Button class="flex w-full text-white border border-white z-0" @click="onSubmit">
        Confirm
      </Button>
  </VueFinalModal>
</template>

<style scoped>

</style>
