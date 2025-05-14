import { useAuthStore } from "@/src/store/useAuthStore";
import _ from "lodash";

export default defineNuxtRouteMiddleware((to, from) => {
    const { getUser } = useAuthStore();

    console.log(_.isNull(getUser));
    if (_.isNull(getUser)) {
        return navigateTo('/');
    }

    return navigateTo('/dashboard');
})
