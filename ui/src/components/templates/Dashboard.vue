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

  const selectedButton = useState('selectedButton', () => "pending")
  const showModal = useState('showModal', () => false)

  const onAddPending = () => {
    selectedButton.value = "pending";
  };

  const onInProgress = () => {
    selectedButton.value = "in_progress";
  };

  const onCompleted = () => {
    selectedButton.value = "completed";
  };
</script>

<template>
  <div 
    class="flex flex-row h-[calc(100vh-75px)] bg-black text-white justify-start p-[20px]">
      
    <div class="flex flex-col mr-[20px]">
      <div class="flex w-full text-white text-left">Pending</div>
      <TaskItemList :tasks="items" status="pending" />
      <Button 
        class="flex bg-black border border-white text-white"
        @click="onAddPending"
      >
        Add
      </Button>
    </div>

    <div class="flex flex-col mr-[20px]">
      <div class="flex w-full text-white text-left">In Progress</div>
      <TaskItemList :tasks="items" status="in_progress" />
      <Button 
        class="flex bg-black border border-white text-white"
        @click="onInProgress"
      >
        Add
      </Button>
    </div>

    <div class="flex flex-col">
      <div class="flex w-full text-white text-left">Completed</div>
      <TaskItemList :tasks="items" status="completed" />
      <Button 
        class="flex bg-black border border-white text-white" 
        @click="onCompleted">
        Add
      </Button>
    </div>
  </div>
</template>

<style scoped>

</style>