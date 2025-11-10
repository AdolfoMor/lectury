<template>
    <AdminLayout :title="form.id ? 'Editar Rol' : 'Crear Rol'">
        <div class="max-w-2xl mx-auto bg-white shadow rounded-lg p-6">
            <h1 class="text-2xl font-semibold text-gray-800 mb-6">
                {{ form.id ? 'Editar Rol' : 'Crear Rol' }}
            </h1>

            <form @submit.prevent="submit">
                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Nombre del Rol</label>
                    <input
                        v-model="form.name"
                        type="text"
                        class="input"
                        required
                    />
                    <InputError :message="form.errors.name" />
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 mb-2">Permisos</label>
                    <div class="grid grid-cols-2 gap-2">
                        <label
                            v-for="permission in permissions"
                            :key="permission.id"
                            class="flex items-center space-x-2"
                        >
                            <input
                                type="checkbox"
                                :value="permission.name"
                                v-model="form.permissions"
                            />
                            <span class="text-gray-700">{{ permission.name }}</span>
                        </label>
                    </div>
                </div>

                <div class="flex justify-end mt-6 space-x-2">
                    <NavLink :href="route('admin.roles.index')" class="btn btn-secondary">
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
import { useForm, router } from '@inertiajs/vue3'
import { defineProps } from 'vue'

const props = defineProps({
    role: Object,
    permissions: Array,
})

const form = useForm({
    id: props.role?.id ?? null,
    name: props.role?.name ?? '',
    permissions: props.role?.permissions?.map(p => p.name) ?? [],
})

const submit = () => {
    if (form.id) {
        form.put(route('admin.roles.update', form.id))
    } else {
        form.post(route('admin.roles.store'))
    }
}
</script>
