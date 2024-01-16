<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import BackIcon from '@/Components/BackIcon.vue';

const props = defineProps({
    pengaduan: {
        type: Object,
        required: true
    },
    tanggapan: {
        type: Object,
        required: false
    }
})

</script>
<template>
    <Head title="Detail Pengaduan" />
    <AuthenticatedLayout>
        <div class="container md:w-5/6 lg:w-2/3 xl:w-1/2 mx-auto mt-20 p-5 flex border rounded-3xl shadow-xl">
            <div class="w-1/2">
                <img class="rounded-3xl w-full" :src="'/image/' + pengaduan.foto" :alt="pengaduan.foto">
            </div>
            <div class="w-1/2 p-5 pt-0 pe-0 h-fit">
                <div class="flex justify-end">
                    <Link class="btn btn-circle" :href="route('pengaduan.index')">
                    <BackIcon />
                    </Link>
                </div>

                <div class="h-1/2">
                    <div class="divider divider-primary">
                        <h1 class="font-extrabold text-xl">Pengaduan</h1>
                    </div>
                    <p class="text-xl font-bold">{{ pengaduan.pesan }}</p>
                    <div class="text-lg font-bold mt-5">Tanggal: {{ pengaduan.tgl_pengaduan }}</div>

                    <div class="">Oleh: <span class="text-xl font-bold text-primary">{{ pengaduan.user.name }}</span></div>
                </div>
                <div class="h-1/2">
                    <div class="divider divider-primary">
                        <h1 class="font-extrabold text-xl">Tanggapan</h1>
                    </div>
                    <div class="text-center flex flex-col justify-between h-full gap-3" v-if="!pengaduan.tanggapan">
                        <p class="">Belum ada tanggapan</p>
                        <Link :href="route('tanggapan.show', pengaduan.id)" class="btn btn-primary"
                            v-if="$page.props.auth.user.role != 0">Tambah Tanggapan</Link>
                    </div>

                    <div class="flex flex-col justify-between h-full " v-else>
                        <p class="text-xl font-bold">{{ pengaduan.tanggapan.pesan }}</p>
                        <div class="text-lg text-secondary-content font-bold mt-5">Tanggal: {{
                            pengaduan.tanggapan.tgl_tanggapan }}
                        </div>
                        <div class="">Oleh: <span class="text-xl font-bold text-primary">{{ tanggapan.user.name
                        }}</span>
                        </div>
                        <Link :href="route('tanggapan.edit', pengaduan.tanggapan.id)" class="btn btn-primary mt-5"
                            v-if="$page.props.auth.user.role != 0">Edit Tanggapan
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
