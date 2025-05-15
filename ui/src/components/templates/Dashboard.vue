<script setup lang="ts">
  import { ModalsContainer, useModal } from 'vue-final-modal';
  import { storeToRefs } from 'pinia';

  import TaskItemList from "@/src/components/organisms/TaskItemList.vue";
  import AddTaskModal from "@/src/components/organisms/modal/AddTaskModal.vue";

  import { useTaskStore } from "@/src/store/useTaskStore";

  const taskStore = useTaskStore();

  const { 
    data,
    pending_tasks, 
    in_progress_tasks, 
    completed_tasks,
    getPendingTask,
    getInProgressTask,
    getCompletedTask
  } = storeToRefs(taskStore)
  
  const selectedButton = useState('selectedButton', () => "pending");

  const showModal = () => {
    const getIndex = () => {
      if (selectedButton.value === "pending") {
        return [...getPendingTask?.value];
      } else if (selectedButton.value === "in_progress") {
        return [...getInProgressTask?.value];
      }
      return [...getCompletedTask?.value];
    }

    const getSelectedButton = () => {
      return selectedButton.value;
    };

    const { open, close } = useModal({
      component: AddTaskModal,
      attrs: {
        async onConfirm() {
          close()
          await getAllData();
        },
        status: getSelectedButton(),
        index: getIndex().length
      }
    });
    open();
  }

  const onAddPending = () => {
    selectedButton.value = "pending";
    showModal();
  };

  const onInProgress = () => {
    selectedButton.value = "in_progress";
    showModal();
  };

  const onCompleted = () => {
    selectedButton.value = "completed";
    showModal();
  };

  const getAllData = async () => {
    await taskStore.getList(0, 10000, "pending");
    await taskStore.getList(0, 10000, "in_progress");
    await taskStore.getList(0, 10000, "completed");
  };

  await getAllData();
</script>

<template>
  <div 
    class="flex flex-row h-screen overflow-x-auto bg-black text-white justify-start p-[20px]">
    
    <div class="flex flex-col mr-[20px]">
      <div class="flex w-full text-white text-left">Pending</div>
      <TaskItemList :tasks="getPendingTask" status="pending" />
      <Button 
        class="flex bg-black border border-white text-white mt-[10px]"
        @click="onAddPending"
      >
        Add
      </Button>
    </div>

    <div class="flex flex-col mr-[20px]">
      <div class="flex w-full text-white text-left">In Progress</div>
      <TaskItemList :tasks="getInProgressTask" status="in_progress" />
      <Button 
        class="flex bg-black border border-white text-white mt-[10px]"
        @click="onInProgress"
      >
        Add
      </Button>
    </div>

    <div class="flex flex-col">
      <div class="flex w-full text-white text-left">Completed</div>
      <TaskItemList :tasks="getCompletedTask" status="completed" />
      <Button 
        class="flex bg-black border border-white text-white mt-[10px]" 
        @click="onCompleted">
        Add
      </Button>
    </div>
    <ModalsContainer />
  </div>
</template>

<style scoped>

</style>