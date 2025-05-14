import { defineStore } from 'pinia';
import _ from "lodash";

const config = useRuntimeConfig();

export const useAuthStore = defineStore('auth', {
    state: () => {
        return {
            apiResponse: {},
            isLoading: false,
            error: {},
            user: {},
            token: null
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
        },
        getUser:(state) => {
            return state?.user;
        },
        getToken:(state) => {
            return state?.token;
        }
    },
    actions: {
        async login(email: string, password: string) {
            this.isLoading = true;

            try {
                const { 
                    data: responseData
                } : {
                    data: any
                } = await $fetch(`${config.public.apiBase}/api/auth/login`, {
                    method: 'post',
                    body: { 
                        email,
                        password,
                    }
                });

                if (responseData) {
                    const { user, token } = (responseData as any);
                    this.user = user;
                    this.token = token;
                } 

            } catch(err: any) {
                this.error = err?.data
            }


            this.isLoading = false;
        },
        async register(email: string, password: string, name: string) {
            this.isLoading = true;

            try {
                 const { 
                    data: responseData 
                } : {
                    data: any
                } = await $fetch(`${config.public.apiBase}/api/auth/register`, {
                    method: 'post',
                    body: { 
                        email,
                        password,
                        name
                    }
                });

                if (responseData) {
                    const { user, token } = (responseData as any);
                    this.user = user;
                    this.token = token;
                } 
            } catch(err: any) {
                this.error = err?.data
            }


            this.isLoading = false;
        }
    },
    persist: true
});
