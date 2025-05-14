import { useAuthStore } from "@/src/store/useAuthStore";
import _ from "lodash";

export default defineNuxtRouteMiddleware((to, from) => {
    const { getUser } = useAuthStore();

    if (_.isNull(getUser)) {
        return navigateTo('/');
    } else if (from.path !== '/dashboard' && to.path !== '/dashboard') {
        return navigateTo('/dashboard');
    }

})
