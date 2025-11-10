<template>
  <AdminLayout title="Roles">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-semibold text-gray-800">Roles</h1>
      <NavLink
        :href="route('admin.roles.create')"
        class="btn btn-primary"
      >
        Nuevo Rol
      </NavLink>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-100">
          <tr>
            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Nombre</th>
            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700 uppercase">Permisos</th>
            <th class="px-6 py-3 text-right text-sm font-semibold text-gray-700 uppercase">Acciones</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-100">
          <tr v-for="role in roles" :key="role.id">
            <td class="px-6 py-4 text-gray-800">{{ role.name }}</td>
            <td class="px-6 py-4 text-gray-600">
              <span
                v-for="permission in role.permissions"
                :key="permission.id"
                class="inline-block bg-gray-200 text-gray-800 text-xs font-semibold mr-1 mb-1 px-2 py-1 rounded">
                {{ permission.name }}
              </span>
            </td>
            <td class="px-6 py-4 text-right space-x-2">
              <NavLink :href="route('admin.roles.edit', role.id)" class="btn btn-sm btn-secondary">
                Editar
              </NavLink>
              <button @click="destroy(role.id)" class="btn btn-sm btn-danger">
                Eliminar
              </button>
            </td>
          </tr>

          <tr v-if="!roles.length">
            <td colspan="3" class="text-center py-6 text-gray-500">
              No hay roles registrados.
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </AdminLayout>
</template>

<script setup>
import { router } from '@inertiajs/vue3'
import AdminLayout from '@/Layouts/AdminAppLayout.vue'
import NavLink from '@/Components/NavLink.vue'
import { defineProps } from 'vue'

const props = defineProps({
    roles: Array,
})

const destroy = (id) => {
    if (confirm('¿Seguro que deseas eliminar este rol?')) {
        router.delete(route('admin.roles.destroy', id))
    }
}
</script>
