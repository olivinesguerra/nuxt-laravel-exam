<script setup lang="ts">
    import { Button } from "@/src/components/atoms/ui/button";
    import { Input } from '@/src/components/atoms/ui/input';
    import { Label } from '@/src/components/atoms/ui/label';

    import { useAuthStore } from "@/src/store/useAuthStore";

    const email = ref('');
    const password = ref('');
    const name = ref('');

    const { register, isLoading, apiResponse } = useAuthStore();

    const onSubmitCliked = async () => {
        await register(email?.value, password?.value, name?.value);
        await navigateTo('/dashboard')
    };

</script>

<template>
  <div class="flex flex-col h-screen bg-black text-white items-center justify-center px-[500px]">
    <Label class="flex mb-[20px]">Login</Label>
    <Input class="flex mb-[20px]" type="email"  placeholder="Email" v-model="email" />
    <Input class="flex mb-[20px]" type="password" placeholder="Password" v-model="password" />
    <Input class="flex mb-[20px]" placeholder="Name" v-model="name" />
    <Button class="flex w-full"  @click="onSubmitCliked">Submit</Button>
  </div>
</template>

<style scoped>

</style>