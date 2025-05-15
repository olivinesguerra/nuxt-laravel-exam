<script setup lang="ts">
  import { ModalsContainer, useModal } from 'vue-final-modal'

  import TaskItemList from "@/src/components/organisms/TaskItemList.vue";
  import AddTaskModal from "@/src/components/organisms/modal/AddTaskModal.vue";

  import { useTaskStore } from "@/src/store/useTaskStore";

  const { 
    getList, 
    isLoading, 
    pending_tasks,
    in_progress_tasks,
    completed_tasks
  } = useTaskStore();

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

  const selectedButton = useState('selectedButton', () => "pending");
  const isModalOpen = ref(true);
  const { open, close } = useModal({
    component: AddTaskModal,
    attrs: {
      async onConfirm() {
        close()
        await getAllData();
      }
    }
  })

  const onAddPending = () => {
    selectedButton.value = "pending";
    open();
  };

  const onInProgress = () => {
    selectedButton.value = "in_progress";
    open();
  };

  const onCompleted = () => {
    selectedButton.value = "completed";
    open();
  };

  const getAllData = async () => {
    await getList(0, 10000, "pending");
    await getList(0, 10000, "in_progress");
    await getList(0, 10000, "completed");
  }

  onMounted(async () => {
    await getAllData();
  });
</script>

<template>
  <div 
    class="flex flex-row h-[calc(100vh-75px)] bg-black text-white justify-start p-[20px]">
    
    <div class="flex flex-col mr-[20px]">
      <div class="flex w-full text-white text-left">Pending</div>
      <TaskItemList :tasks="pending_tasks" status="pending" />
      <Button 
        class="flex bg-black border border-white text-white"
        @click="onAddPending"
      >
        Add
      </Button>
    </div>

    <div class="flex flex-col mr-[20px]">
      <div class="flex w-full text-white text-left">In Progress</div>
      <TaskItemList :tasks="in_progress_tasks" status="in_progress" />
      <Button 
        class="flex bg-black border border-white text-white"
        @click="onInProgress"
      >
        Add
      </Button>
    </div>

    <div class="flex flex-col">
      <div class="flex w-full text-white text-left">Completed</div>
      <TaskItemList :tasks="completed_tasks" status="completed" />
      <Button 
        class="flex bg-black border border-white text-white" 
        @click="onCompleted">
        Add
      </Button>
    </div>
    <ModalsContainer />
  </div>
</template>

<style scoped>

</style>