<template>
    <AdminLayout title="Permisos">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Permisos</h1>
            <NavLink :href="route('admin.permissions.create')" class="btn btn-primary">
                Nuevo Permiso
            </NavLink>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Nombre</th>
                        <th class="px-6 py-3 text-right text-sm font-semibold text-gray-700 uppercase">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <tr v-for="permission in permissions" :key="permission.id">
                        <td class="px-6 py-4 text-gray-800">{{ permission.name }}</td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <NavLink
                                :href="route('admin.permissions.edit', permission.id)"
                                class="btn btn-sm btn-secondary"
                            >
                                Editar
                            </NavLink>
                            <button
                                @click="destroy(permission.id)"
                                class="btn btn-sm btn-danger"
                            >
                                Eliminar
                            </button>
                        </td>
                    </tr>

                    <tr v-if="!permissions.length">
                        <td colspan="2" class="text-center py-6 text-gray-500">
                            No hay permisos registrados.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminAppLayout.vue'
import NavLink from '@/Components/NavLink.vue'
import { router } from '@inertiajs/vue3'
import { defineProps } from 'vue'

const props = defineProps({
    permissions: Array,
})

const destroy = (id) => {
    if (confirm('¿Seguro que deseas eliminar este permiso?')) {
        router.delete(route('admin.permissions.destroy', id))
    }
}
</script>
