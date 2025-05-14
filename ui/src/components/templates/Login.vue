<script setup lang="ts">
    import { Button } from "@/components/ui/button";
    import { Input } from '@/components/ui/input';
    import { Label } from '@/components/ui/label';

    import { useAuthStore } from "@/src/store/useAuthStore";

    const email = ref('');
    const password = ref('');

    const { login, isLoading, apiResponse } = useAuthStore();

    const onSubmitCliked = async () => {
        console.log(email?.value);
        console.log(password?.value);

        await login(email?.value, password?.value);
    };

</script>

<template>
  <div class="flex flex-col h-screen bg-black text-white items-center justify-center px-[500px]">
        <Label class="flex mb-[20px]">Login</Label>
        <Input class="flex mb-[20px]" type="email"  placeholder="Email" v-model="email" />
        <Input class="flex mb-[20px]" type="password" placeholder="Password" v-model="password" />
        <Button class="flex w-full"  @click="onSubmitCliked">Submit</Button>
  </div>
</template>

<style scoped>

</style>