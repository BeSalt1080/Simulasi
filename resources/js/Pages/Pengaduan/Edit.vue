<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const props = defineProps({
    pengaduan: {
        type: Object,
        required: true
    }
})
const form = useForm({
    pesan: null,
    foto: null,
    _method: 'PUT'
});

const submit = () => {
    form.post(route('pengaduan.update', props.pengaduan.id), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};


form.pesan = props.pengaduan.pesan
</script>
<template>
    <Head title="Edit Pengaduan" />
    <AuthenticatedLayout>
        <div class="container mx-auto mt-20 flex justify-center ">
            <form @submit.prevent="submit" class="flex flex-col gap-3 w-fit p-10 border shadow-md rounded-3xl">
                <h1 class="text-center text-2xl text-primary-content font-bold mb-7">Edit Pengaduan</h1>
                <label class="form-control w-full max-w-xs">
                    <div class="label pt-0">
                        <span class="label-text">Foto</span>
                    </div>
                    <input type="file" class="file-input file-input-bordered file-input-primary w-full max-w-xs"
                        @input="(e) => { form.foto = e.target.files[0] }" accept="image/*" />
                    <InputError class="mt-2" />
                </label>
                <label class="form-control w-full max-w-xs">
                    <div class="label pt-0">
                        <span class="label-text">Pesan</span>
                    </div>
                    <textarea class="textarea textarea-primary resize-none" rows="3" placeholder="Pesan"
                        v-model="form.pesan"></textarea>

                </label>
                <button class="btn btn-primary mt-5">Submit</button>
            </form>
        </div>
    </AuthenticatedLayout>
</template>
