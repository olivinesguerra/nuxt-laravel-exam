import { defineStore } from 'pinia';
import _ from "lodash";

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

            const { data: responseData, error } = await useFetch(`${process.env.API_URL}/api/auth/login`, {
                method: 'post',
                body: { 
                    email,
                    password,
                }
            });

            if (responseData.value) {
                const { user, token } = (responseData.value as any);

                this.user = user;
                this.token = token;
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
                const { user, token } = (responseData.value as any);
                this.user = user;
                this.token = token;
            } else if (error?.value) {
                this.error = error?.value
            }

            this.isLoading = false;
        }
    },
    persist: true
});
