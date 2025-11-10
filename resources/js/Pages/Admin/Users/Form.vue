<script setup>
import { useForm } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AdminAppLayout.vue';

const props = defineProps({
  user: Object,
  roles: Array,
})

const form = useForm({
  name: props.user?.name ?? '',
  email: props.user?.email ?? '',
  password: '',
  password_confirmation: '',
  role: props.user?.roles?.[0]?.name ?? '',
})

function submit() {
  if (props.user) {
    form.put(route('admin.users.update', props.user.id))
  } else {
    form.post(route('admin.users.store'))
  }
}
</script>

<template>
  <AppLayout title="Usuarios">
  <div class="max-w-lg mx-auto bg-white shadow rounded p-6">
    <h2 class="text-xl font-semibold mb-4">
      {{ props.user ? 'Editar usuario' : 'Nuevo usuario' }}
    </h2>

    <form @submit.prevent="submit">
      <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Nombre</label>
        <input v-model="form.name" type="text" class="w-full border rounded px-3 py-2" />
      </div>

      <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Correo</label>
        <input v-model="form.email" type="email" class="w-full border rounded px-3 py-2" />
      </div>

      <div class="mb-4" v-if="!props.user">
        <label class="block text-sm font-medium mb-1">Contraseña</label>
        <input v-model="form.password" type="password" class="w-full border rounded px-3 py-2" />
      </div>

      <div class="mb-4" v-if="!props.user">
        <label class="block text-sm font-medium mb-1">Confirmar contraseña</label>
        <input v-model="form.password_confirmation" type="password" class="w-full border rounded px-3 py-2" />
      </div>

      <div class="mb-4">
        <label class="block text-sm font-medium mb-1">Rol</label>
        <select v-model="form.role" class="w-full border rounded px-3 py-2">
          <option value="">Seleccionar...</option>
          <option v-for="r in props.roles" :key="r.id" :value="r.name">
            {{ r.name }}
          </option>
        </select>
      </div>

      <div class="flex justify-end">
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
          {{ props.user ? 'Actualizar' : 'Guardar' }}
        </button>
      </div>
    </form>
  </div>
  </AppLayout>
</template>
