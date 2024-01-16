<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    pengaduan: {
        type: Object,
        required: true
    }
})

const form = useForm({
    pesan: null,
    status: null,
    pengaduan_id: props.pengaduan.id
});


const submit = () => {
    form.post(route('tanggapan.store'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>
<template>
    <Head title="Tanggapan" />
    <AuthenticatedLayout>
        <div class="w-1/4 mx-auto mt-20 flex justify-center">
            <form @submit.prevent="submit" class="flex flex-col gap-3 w-full p-10 border shadow-md rounded-3xl">
                <h1 class="text-center text-2xl text-primary-content font-bold mb-7">Tambah Tanggapan</h1>
                <label class="form-control w-full">
                    <div class="label pt-0">
                        <span class="label-text">Pesan</span>
                    </div>
                    <textarea class="textarea textarea-primary resize-none" rows="3" placeholder="Pesan"
                        v-model="form.pesan" required></textarea>
                    <InputError class="mt-2" :message="form.errors.pesan" />
                </label>
                <select class="select select-primary w-full" v-model="form.status">
                    <option disabled selected :value="null">Status</option>
                    <option value="Pending">Pending</option>
                    <option value="Proses">Proses</option>
                    <option value="Selesai">Selesai</option>
                </select>
                <button class="btn btn-primary mt-5">Submit</button>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
