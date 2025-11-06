<script setup>
import { useForm } from '@inertiajs/vue3'
import Card  from '@/Components/Card.vue'
import  CardHeader  from '@/Components/CardHeader.vue'
import  CardContent  from '@/Components/CardContent.vue'
import  Input  from '@/Components/TextInput.vue'
import  Button  from '@/Components/PrimaryButton.vue'
// import { DataTable } from '@/Components/ui/data-table'
import AppLayout from '@/Layouts/AdminAppLayout.vue';
import NavLink from '@/Components/NavLink.vue';

// Props que vienen desde Laravel
defineProps({
  course: Object,
  groups: Array
})

</script>

<template>
  
  <AppLayout :title="`Grupos de ${course.name}`">

  <div class="p-6 space-y-6">
    <div class="flex justify-between items-center">
      <h1 class="text-2xl font-bold">Grupos de {{ course.name }}</h1>
        <NavLink 
            :href="route('admin.courses.groups.create', course.id)" 
            class="btn btn-primary mb-4"
            >
            Nuevo grupo
        </NavLink>

    </div>

    <Card>
      <CardHeader>
        <div class="flex justify-between items-center">
          <h2 class="text-lg font-semibold">Lista de Grupos</h2>
          <Input v-model="search" placeholder="Buscar..." class="w-1/3" />
        </div>
      </CardHeader>

      <CardContent>
        <div class="overflow-x-auto">
          <table class="min-w-full border border-gray-200 text-sm rounded-xl" v-if="groups && groups.length">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
              <tr>
                <th class="px-4 py-2 text-left">ID</th>
                <th class="px-4 py-2 text-left">Nombre</th>
                <th class="px-4 py-2 text-left">Curso</th>
                <th class="px-4 py-2 text-left">Inicio</th>
                <th class="px-4 py-2 text-left">Fin</th>
                <th class="px-4 py-2 text-left">Acciones</th>
              </tr>
            </thead>
            <tbody>
                
            <tr v-for="group in groups" :key="group.id" class="border-t">
              <td class="px-4 py-2">{{ group.id }}</td>
              <td class="px-4 py-2">{{ group.name }}</td>
              <td class="px-4 py-2">{{ course.name }}</td>
              <td class="px-4 py-2">{{ group.start_date }}</td>
              <td class="px-4 py-2">{{ group.end_date }}</td>
              <td class="px-4 py-2 space-x-2">
                <NavLink :href="route('admin.groups.edit', group.id)">
                  <Button variant="outline" size="sm">Editar</Button>
                </NavLink>
              </td>
            </tr>
            <tr v-if="!groups || groups.length === 0">
                <td colspan="4" class="text-center py-4 text-gray-500">
                No hay Grupos registrados.
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
