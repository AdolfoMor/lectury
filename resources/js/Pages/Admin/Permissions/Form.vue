<template>
    <AdminLayout :title="form.id ? 'Editar Permiso' : 'Crear Permiso'">
        <div class="max-w-md mx-auto bg-white shadow rounded-lg p-6">
            <h1 class="text-2xl font-semibold text-gray-800 mb-6">
                {{ form.id ? 'Editar Permiso' : 'Crear Permiso' }}
            </h1>

            <form @submit.prevent="submit">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Nombre del permiso</label>
                    <input
                        v-model="form.name"
                        type="text"
                        class="input"
                        required
                    />
                    <InputError :message="form.errors.name" />
                </div>

                <div class="flex justify-end space-x-2">
                    <NavLink :href="route('admin.permissions.index')" class="btn btn-secondary">
                        Cancelar
                    </NavLink>
                    <button type="submit" class="btn btn-primary">
                        {{ form.id ? 'Actualizar' : 'Crear' }}
                    </button>
                </div>
            </form>
        </div>
    </AdminLayout>
</template>

<script setup>
import AdminLayout from '@/Layouts/AdminAppLayout.vue'
import NavLink from '@/Components/NavLink.vue'
import InputError from '@/Components/InputError.vue'
import { useForm } from '@inertiajs/vue3'
import { defineProps } from 'vue'

const props = defineProps({
    permission: Object,
})

const form = useForm({
    id: props.permission?.id ?? null,
    name: props.permission?.name ?? '',
})

const submit = () => {
    if (form.id) {
        form.put(route('admin.permissions.update', form.id))
    } else {
        form.post(route('admin.permissions.store'))
    }
}
</script>
