import { defineStore } from 'pinia';

export const useTaskStore = defineStore('tasks', {
    state: () => ({
        count: 0,
    }),
    actions: {

    },
    persist: true
});

