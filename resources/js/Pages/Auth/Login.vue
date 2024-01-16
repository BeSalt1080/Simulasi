<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import InputError from '@/Components/InputError.vue';

defineProps({
    canResetPassword: {
        type: Boolean,
    }
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

</script>

<template>
    <Head title="Sign in" />
    <div class="w-full mx-auto px-4 h-full">
        <div class="flex content-center items-center justify-center h-full">
            <div class="w-full lg:w-4/12 px-4">
                <div
                    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-base-200 border-0">
                    <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                        <div class="text-center my-5 font-bold">
                            <h1 class="text-xl">Sign in</h1>
                        </div>
                        <form @submit.prevent="submit" class="flex flex-col gap-5">
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">Email</span>
                                </div>
                                <input type="email" placeholder="Email" v-model="form.email"
                                    class="input input-bordered w-full" required autofocus />
                                <InputError class="mt-2" :message="form.errors.email" />
                            </label>
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">Password</span>
                                </div>
                                <input type="password" placeholder="Password" v-model="form.password"
                                    class="input input-bordered w-full" required autofocus />
                                <InputError class="mt-2" :message="form.errors.password" />
                            </label>
                            <div class="form-control">
                                <label class="cursor-pointer">
                                    <input type="checkbox" class="checkbox checkbox-primary me-2" v-model="form.remember" />
                                    <span class="label-text">Remember me</span>
                                </label>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-block btn-primary" type="submit"
                                    :class="{ 'btn-disabled': form.processing }">
                                    SIGN IN
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="flex flex-wrap mt-6 relative">
                    <div class="w-1/2">
                        <Link v-if="canResetPassword" :href="route('password.request')" class="link">
                        Forgot password?
                        </Link>
                    </div>
                    <div class="w-1/2 text-right">
                        <Link :href="route('register')" class="link">
                        Create new account
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
