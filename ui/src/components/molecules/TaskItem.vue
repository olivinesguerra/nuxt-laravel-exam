<script setup lang="ts">
  import moment from "moment";
  import { ModalsContainer, useModal } from 'vue-final-modal';
  import UpdateTaskModal from "@/src/components/organisms/modal/UpdateTaskModal.vue";
  import { useTaskStore } from "@/src/store/useTaskStore";

  const taskStore = useTaskStore();

  const props = defineProps({
    task: {
      type: Object,
      required: true,
    },
  });
  const { task } = props;

  const deleteTask = async () => {
    await taskStore.delete(task?.id);
    await getAllData();
  };

  const getAllData = async () => {
    await taskStore.getList(0, 10000, "pending");
    await taskStore.getList(0, 10000, "in_progress");
    await taskStore.getList(0, 10000, "completed");
  };

  const showModal = () => {
    console.log("meow");
    const { open, close } = useModal({
      component: UpdateTaskModal,
      attrs: {
        async onConfirm() {
          close()
          await getAllData();
        },
        task: task
      }
    });
    open();
  }
</script>

<template>
  <div class="flex flex-col bg-black justify-center relative">
    <div class="flex flex-col absolute  right-[10px] top-[10px]">
      <Button 
        class="text-white mb-[5px]"
        @click="deleteTask"
      >
        Delete
      </Button>
      <Button 
        class="text-white"
        @click="showModal"
      >
        Update
      </Button>
    </div>

    <div class="flex flex-col flex-1 text-white border-white border rounded  bg-black p-[20px] my-[5px]">
      <div class="flex text-[20px]">{{ task?.title }}</div>
      <div class="flex text-[15px]">{{ task?.description }}</div>
      <div class="flex text-[15px]">{{ moment.unix(task?.due_date)?.format("MMM DD, YYYY HH:mm A") }}</div>
    </div>
  </div>
</template>

<style scoped>

</style>
