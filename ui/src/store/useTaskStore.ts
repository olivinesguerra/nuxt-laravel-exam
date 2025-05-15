import {  defineStore, acceptHMRUpdate } from 'pinia';
import _ from "lodash";

import { useAuthStore } from './useAuthStore'; 

const config = useRuntimeConfig();

export const useTaskStore = defineStore('tasks', {
    state: () => ({
        apiResponse: {} as any,
        isLoading: false as boolean,
        error: {} as any,
        pending_tasks: [] as any[],
        in_progress_tasks: [] as any[],
        completed_tasks: [] as any[],
    }),
    actions: {
        async createTask(
            title: string, 
            description: string, 
            due_date: number, 
            status: string,
            order: number
        ) {
            this.isLoading = true;

            const authStore = useAuthStore();

            const { data: responseData, error } = await useFetch(`${config.public.apiBase}/api/task`, {
                method: 'post',
                body: { 
                    title,
                    description,
                    due_date,
                    status,
                    order
                },
                headers: {
                    Authorization: `Bearer ${authStore?.token}`
                }
            });

            if (responseData.value) {
                this.apiResponse = responseData.value;
            } else if (error?.value) {
                this.error = error?.value
            }

            this.isLoading = false;
        },
        async getList(
            offset: number = 0, 
            limit: number = 1000, 
            status: 'pending' | 'in_progress' | 'completed'
        ) {
            this.isLoading = true;

            try {
                const authStore = useAuthStore();

                const { data: responseData } = await useFetch(`${config.public.apiBase}/api/task?offset=${offset}&limit=${limit}&status=${status}`, {
                    method: 'get',
                    headers: {
                        Authorization: `Bearer ${authStore?.token}`
                    }
                });

                if (responseData?.value) {
                    const val: any = responseData?.value;
                    if (status === "pending") {
                        this.pending_tasks = val?.data;
                    } else if (status === "in_progress") {
                        this.in_progress_tasks = val?.data;
                    } else if (status === "completed") {
                        this.completed_tasks = val?.data;
                    }
                }

            } catch(err: any) {
                this.error = err?.data
            }

            this.isLoading = false;
        },
        async getById(id: string) {
            this.isLoading = true;

            const authStore = useAuthStore();

            const { data: responseData, error } = await useFetch(`${config.public.apiBase}/api/task/${id}`, {
                method: 'get',
                headers: {
                    Authorization: `Bearer ${authStore?.token}`
                }
            });

            if (responseData.value) {
                this.apiResponse = responseData.value;
            } else if (error?.value) {
                this.error = error?.value
            }
            
            this.isLoading = false;
        },
        async updateById(id: string, params: any) {
            this.isLoading = true;

            const authStore = useAuthStore();

            const { data: responseData, error } = await useFetch(`${config.public.apiBase}/api/task/${id}`, {
                method: 'put',
                body: params,
                headers: {
                    Authorization: `Bearer ${authStore?.token}`
                }
            });

            if (responseData.value) {
                this.apiResponse = responseData.value;
            } else if (error?.value) {
                this.error = error?.value
            }
            
            this.isLoading = false;
        },
        async delete(id: string) {
            this.isLoading = true;

            const authStore = useAuthStore();

            const { data: responseData, error } = await useFetch(`${config.public.apiBase}/api/task/${id}`, {
                method: 'delete',
                headers: {
                    Authorization: `Bearer ${authStore?.token}`
                }
            });

            if (responseData.value) {
                this.apiResponse = responseData.value;
            } else if (error?.value) {
                this.error = error?.value
            }
            
            this.isLoading = false;
        }
    },
    getters: {
        getApiResponse: (state) => {
            return _.isEmpty(state.apiResponse) ? null : state?.apiResponse;
        },
        getIsLoading:(state) => {
            return state?.isLoading;
        },
        getError:(state) => {
            return state?.error;
        },
        getPendingTask: (state) => {
            return state?.pending_tasks;
        },
        getInProgressTask: (state) => {
            return state?.in_progress_tasks;
        },
        getCompletedTask: (state) => {
            return state?.completed_tasks;
        }
    },
    persist: true
});

// if (import.meta.hot) {
//   import.meta.hot.accept(acceptHMRUpdate(useTaskStore, import.meta.hot))
// }

