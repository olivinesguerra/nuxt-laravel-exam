import { defineStore } from 'pinia';
import _ from "lodash";

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
        async login(email: string, password: string) {
            this.isLoading = true;

            const { data: responseData, error } = await useFetch(`${process.env.API_URL}/api/auth/login`, {
                method: 'post',
                body: { 
                    email,
                    password,
                }
            });

            if (responseData.value) {
                this.apiResponse = responseData.value;
            } else if (error?.value) {
                this.error = error?.value
            }



            this.isLoading = false;
        },
        async register(email: string, password: string, name: string) {
            this.isLoading = true;

            const { data: responseData, error } = await useFetch(`${process.env.API_URL}/api/auth/register`, {
                method: 'post',
                body: { 
                    email,
                    password,
                    name
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

