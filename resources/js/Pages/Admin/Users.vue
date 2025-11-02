<script setup>
import Card  from '@/Components/Card.vue'
import  CardHeader  from '@/Components/CardHeader.vue'
import  CardContent  from '@/Components/CardContent.vue'
import  Input  from '@/Components/TextInput.vue'
import  Button  from '@/Components/PrimaryButton.vue'
// import { DataTable } from '@/Components/ui/data-table'
import AppLayout from '@/Layouts/AdminAppLayout.vue';

// Props que vienen desde Laravel
defineProps({
  users: Array,
})

// Estado para búsqueda (a futuro)

</script>

<template>
  <AppLayout title="Usuarios">
  
  <div class="p-6 space-y-6">
    <div class="flex justify-between items-center">
      <h1 class="text-2xl font-bold">Gestión de usuarios</h1>
      <Button>Agregar usuario</Button>
    </div>

    <Card>
      <CardHeader>
        <div class="flex justify-between items-center">
          <h2 class="text-lg font-semibold">Lista de usuarios</h2>
          <Input v-model="search" placeholder="Buscar..." class="w-1/3" />
        </div>
      </CardHeader>

      <CardContent>
        <div class="overflow-x-auto">
          <table class="min-w-full border border-gray-200 text-sm rounded-xl">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
              <tr>
                <th class="px-4 py-2 text-left">ID</th>
                <th class="px-4 py-2 text-left">Nombre</th>
                <th class="px-4 py-2 text-left">Email</th>
                <th class="px-4 py-2 text-left">Acciones</th>
              </tr>
            </thead>
            <tbody>
                
              <tr v-for="user in users" :key="user.id" class="border-t">
                <td class="px-4 py-2">{{ user.id }}</td>
                <td class="px-4 py-2">{{ user.name }}</td>
                <td class="px-4 py-2">{{ user.email }}</td>
                <td class="px-4 py-2">
                  <Button variant="outline" size="sm">Editar</Button>
                </td>
              </tr>
              <tr v-if="users.length === 0">
                <td colspan="4" class="text-center py-4 text-gray-500">
                  No hay usuarios registrados.
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </CardContent>
    </Card>
  </div>
  </AppLayout>
</template>
