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

const props = defineProps({
  group: Object,
  courses: Array,
  selectedCourse: Object,
})


const form = useForm({
  course_id: props.selectedCourse?.id ?? props.group?.course_id ?? '',
  name: props.group?.name ?? '',
  start_date: props.group?.start_date ?? '',
  end_date: props.group?.end_date ?? '',
})

function submit() {
  if (props.group) {
    form.put(route('admin.groups.update', props.group.id))
  } else {
    form.post(route('admin.groups.store'))
  }
}
</script>

<template>
<AppLayout :title="props.group ? 'Editar grupo' : 'Crear grupo'">

  <div class="p-6 space-y-6">
    <Card>
      <CardHeader>
        <h2 class="text-xl font-semibold">{{ props.group ? 'Editar grupo' : 'Crear nuevo grupo' }}</h2>
      </CardHeader>

      <CardContent>
        <form @submit.prevent="submit">
          <div v-if="!props.selectedCourse">
            <label class="block mb-1 text-sm font-medium">Curso</label>
            <select v-model="form.course_id" class="w-full border rounded-lg p-2">
              <option disabled value="">Selecciona un curso</option>
              <option v-for="course in props.courses" :key="course.id" :value="course.id">
                {{ course.name }}
              </option>
            </select>
          </div>
          <div v-else>
            <p class="text-sm text-gray-700">
              <strong>Curso:</strong> {{ props.selectedCourse.name }}
            </p>
          </div>

          <div>
            <label class="block mb-1 text-sm font-medium">Nombre del grupo</label>
            <Input v-model="form.name" required placeholder="Ej. Grupo A - Febrero" />
          </div>

          <div class="flex gap-4">
            <div class="flex-1">
              <label class="block mb-1 text-sm font-medium">Fecha inicio</label>
              <Input type="date" v-model="form.start_date" />
            </div>
            <div class="flex-1">
              <label class="block mb-1 text-sm font-medium">Fecha fin</label>
              <Input type="date" v-model="form.end_date" />
            </div>
          </div>

          <Button type="submit" class="mt-4">
            {{ props.group ? 'Actualizar grupo' : 'Crear grupo' }}
          </Button>
        </form>
      </CardContent>
    </Card>
  </div>
</AppLayout>
</template>
