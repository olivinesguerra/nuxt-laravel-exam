import { defineStore } from 'pinia';
import _ from "lodash";


import { useAuthStore } from './useAuthStore'; 

const config = useRuntimeConfig();

export const useTaskStore = defineStore('tasks', {
    state: () => {
        return {
            apiResponse: {},
            isLoading: false,
            error: {},
            task: [],
        };
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
        }
    },
    actions: {
        async createTask(
            title: string, 
            description: string, 
            due_date: number, 
            status: string
        ) {
            this.isLoading = true;

            const authStore = useAuthStore();

            const { data: responseData, error } = await useFetch(`${config.public.apiBase}/api/task`, {
                method: 'post',
                body: { 
                    title,
                    description,
                    due_date,
                    status
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
        async getList(offset: number = 0, limit: number = 1000 ) {
            this.isLoading = true;

            const authStore = useAuthStore();

            const { data: responseData, error } = await useFetch(`${config.public.apiBase}/api/task?offset=${offset}&limit=${limit}`, {
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
    persist: true
});

