<script setup>
import InputError from '@/Components/InputError.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    nik: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Sign Up" />
    <div class="container mx-auto px-4 h-full">
        <div class="flex content-center items-center justify-center h-full">
            <div class="w-full lg:w-6/12 px-4">
                <div
                    class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-base-200 border-0">

                    <div class="flex-auto px-4 lg:px-10 py-10 pt-0">
                        <div class="text-center my-5 font-bold">
                            <h1 class="text-xl">Sign in</h1>
                        </div>
                        <form @submit.prevent="submit" class="flex flex-col gap-3">
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">Name</span>
                                </div>
                                <input type="text" placeholder="Name" v-model="form.name"
                                    class="input input-bordered w-full" required autofocus />
                                <InputError class="mt-2" :message="form.errors.name" />
                            </label>
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
                                    <span class="label-text">NIK</span>
                                </div>
                                <input type="text" placeholder="NIK" v-model="form.nik" class="input input-bordered w-full"
                                    required autofocus />
                                <InputError class="mt-2" :message="form.errors.nik" />
                            </label>
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">Password</span>
                                </div>
                                <input type="Password" placeholder="Password" v-model="form.password"
                                    class="input input-bordered w-full" required autofocus />
                                <InputError class="mt-2" :message="form.errors.password" />
                            </label>
                            <label class="form-control w-full">
                                <div class="label">
                                    <span class="label-text">Confirm Password</span>
                                </div>
                                <input type="password" placeholder="Confirm Password" v-model="form.password_confirmation"
                                    class="input input-bordered w-full" required autofocus />
                                <InputError class="mt-2" :message="form.errors.password_confirmation" />
                            </label>
                            <div class="form-control">
                                <label class="cursor-pointer">
                                    <input type="checkbox" class="checkbox checkbox-primary me-2" v-model="form.remember" />
                                    <span class="label-text">I agree with the
                                        <a href="javascript:void(0)" class="link link-primary">
                                            Privacy Policy
                                        </a></span>
                                </label>
                            </div>
                            <div class="text-center">
                                <button class="btn btn-block btn-primary" type="submit"
                                    :class="{ 'btn-disabled': form.processing }">
                                    Create Account
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="text-right">
                    <Link :href="route('login')" class="link">Already have an account?</Link>
                </div>
            </div>
        </div>
    </div>
</template>
