<script setup>
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
  courses: Array,
})

// Estado para búsqueda (a futuro)

</script>

<template>
  <AppLayout title="Cursos">
    
  
  <div class="p-6 space-y-6">
    <div class="flex justify-between items-center">
      <h1 class="text-2xl font-bold">Gestión de Cursos</h1>
      <NavLink :href="route('admin.courses.create')">
        <Button>Nuevo curso</Button>
      </NavLink>
    </div>

    <Card>
      <CardHeader>
        <div class="flex justify-between items-center">
          <h2 class="text-lg font-semibold">Lista de Cursos</h2>
          <Input v-model="search" placeholder="Buscar..." class="w-1/3" />
        </div>
      </CardHeader>

      <CardContent>
        <div class="overflow-x-auto">
          <table class="min-w-full border border-gray-200 text-sm rounded-xl">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
              <tr>
                <th class="px-4 py-2 text-left">Nombre</th>
                <th class="px-4 py-2 text-left">Categoría</th>
                <th class="px-4 py-2 text-left">Modalidad</th>
                <th class="px-4 py-2 text-left">Tipo</th>
                <th class="px-4 py-2 text-left">Inicio</th>
                <th class="px-4 py-2 text-left">Fin</th>
                <th class="px-4 py-2 text-left">Acciones</th>
              </tr>
            </thead>
            <tbody>
                
              <tr v-for="course in courses || []" :key="course.id" class="border-t">
                <td class="px-4 py-2">{{ course.name }}</td>
                <td class="px-4 py-2">{{ course.category?.name ?? 'Sin categoría' }}</td>
                <td class="px-4 py-2">{{ course.modality }}</td>
                <td class="px-4 py-2">{{ course.type }}</td>
                <td class="px-4 py-2">{{ course.start_date ?? '-' }}</td>
                <td class="px-4 py-2">{{ course.end_date ?? '-' }}</td>
                <td class="px-4 py-2 space-x-2">
                  <NavLink :href="route('admin.courses.edit', course.id)">
                    <Button size="sm" variant="outline">Editar</Button>
                  </NavLink>
                  <NavLink :href="route('admin.courses.groups', course.id)">
                    Ver grupos
                  </NavLink>

                </td>

              </tr>
              <tr v-if="courses.length === 0">
                <td colspan="4" class="text-center py-4 text-gray-500">
                  No hay Cursos registrados.
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
