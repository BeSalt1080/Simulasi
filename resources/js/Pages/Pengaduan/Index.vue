<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router } from '@inertiajs/vue3';
import DeleteIcon from '@/Components/DeleteIcon.vue'
import EditIcon from '@/Components/EditIcon.vue'
import DetailIcon from '@/Components/DetailIcon.vue'
import PrintIcon from '@/Components/PrintIcon.vue'
import { ref } from 'vue';

const props = defineProps({
    pengaduans: {
        type: Array,
        required: true
    }
})
const state = ref([])

for (let i = 0; i < props.pengaduans.length; i++) {
    state.value.push({ 'state': false })
}
const remove = ($id) => {
    router.visit(route('pengaduan.destroy', $id), {
        method: 'delete',
    })
}

</script>
<template>
    <Head title="Pengaduan" />
    <AuthenticatedLayout>
        <div class="container mx-auto mt-10">
            <div class="flex justify-between">
                <h1 class="font-bold text-xl">Tabel Pengaduan</h1>
                <div class="flex align-middle gap-2">
                    <a :href="route('generate')" class="btn btn-secondary" v-if="$page.props.auth.user.role != 0">
                        <PrintIcon />
                    </a>
                    <Link :href="route('pengaduan.create')" class="btn btn-primary">Tambah Pengaduan</Link>
                </div>
            </div>
            <div class="overflow-x-auto mt-5">
                <table class="table">
                    <!-- head -->
                    <thead>
                        <tr>
                            <th class="w-fit text-center">Foto</th>
                            <th class="text-center">Pelapor</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Pesan</th>
                            <th class="w-10 text-center">Status</th>
                            <th class="w-10 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <template v-for="(pengaduan, index) in pengaduans" :key="pengaduan.id">
                            <tr v-if="pengaduan.user_id == $page.props.auth.user.id || $page.props.auth.user.role != 0">
                                <td class="w-40 h-40">
                                    <div class="avatar">
                                        <div class="w-full">
                                            <img :src="'/image/' + pengaduan.foto" :alt="pengaduan.foto" />
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{ pengaduan.user.name }}
                                </td>
                                <td class="text-nowrap text-center">
                                    {{ pengaduan.tgl_pengaduan }}
                                </td>
                                <td>
                                    {{ pengaduan.pesan }}
                                </td>
                                <td class="w-10">
                                    <div :class="{
                                        'badge badge-success': pengaduan.status == 'Selesai',
                                        'badge badge-warning': pengaduan.status == 'Proses',
                                        'badge badge-error': pengaduan.status == 'Pending'
                                    }" class="p-5">{{ pengaduan.status }}</div>
                                </td>
                                <td>
                                    <div class="flex gap-2">
                                        <Link :href="route('pengaduan.show', pengaduan.id)" class="btn btn-info">
                                        <DetailIcon />
                                        </Link>
                                        <Link :href="route('pengaduan.edit', pengaduan.id)" class="btn btn-warning">
                                        <EditIcon />
                                        </Link>
                                        <button class="btn btn-error" @click="() => {
                                            console.log(state);
                                            state[index].state = true
                                        }">
                                            <DeleteIcon />
                                        </button>
                                        <dialog :open="state[index].state" class="modal bg-base-200">
                                            <div class="modal-box">
                                                <h3 class="font-bold text-lg">Apakah Anda YAKIN ingin menghapus pengaduan
                                                    ini?
                                                </h3>
                                                <p class="py-4">Pengaduan ini akan hilang secara permanen</p>
                                                <div class="modal-action">
                                                    <form @submit.prevent="remove(pengaduan.id)" method="dialog">
                                                        <button type="submit" class="btn btn-error"
                                                            @click="state[index].state = false">Delete</button>
                                                    </form>
                                                    <form>
                                                        <button class="btn"
                                                            @click="state[index].state = false">Close</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </dialog>
                                    </div>
                                </td>
                            </tr>
                        </template>
                        <tr v-if="pengaduans.length == 0">
                            <td class="text-3xl text-center" colspan="10">
                                <span>Pengaduan Belum Ada Isi</span>
                            </td>
                        </tr>
                    </tbody>
                    <!-- foot -->
                    <tfoot>
                        <tr class="border-t">
                            <th class="text-center">Foto</th>
                            <th class="text-center">Pelapor</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Pesan</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </tfoot>

                </table>
            </div>
        </div>

    </AuthenticatedLayout>
</template>
