<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-base-200 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">Selamat Datang {{ $page.props.auth.user.name }}!</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
