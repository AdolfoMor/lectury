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
  course: Object,
  categories: Array,
})


const form = useForm({
  name: props.course?.name ?? '',
  description: props.course?.description ?? '',
  category_id: props.course?.category_id ?? '',
  modality: props.course?.modality ?? 'En línea',
  type: props.course?.type ?? 'Gratuito',
  price: props.course?.price ?? '',
  start_date: props.course?.start_date ?? '',
  end_date: props.course?.end_date ?? '',
})

function submit() {
  if (props.course) {
    form.put(route('admin.courses.update', props.course.id))
  } else {
    form.post(route('admin.courses.store'))
  }
}
</script>

<template>
<AppLayout :title="course ? 'Editar Curso' : 'Nuevo Curso'">

  <div class="p-6 space-y-6">
    <Card>
      <CardHeader>
        <h2 class="text-xl font-semibold">{{ course ? 'Editar Curso' : 'Crear nuevo curso' }}</h2>
      </CardHeader>

      <CardContent>
        <form @submit.prevent="submit" class="space-y-4">
          <div>
            <label class="block text-sm font-medium">Nombre</label>
            <Input v-model="form.name" required />
          </div>

          <div>
            <label class="block text-sm font-medium">Descripción</label>
            <textarea v-model="form.description" class="w-full border rounded-md p-2" rows="3"></textarea>
          </div>

          <div>
            <label class="block text-sm font-medium">Categoría</label>
            <select v-model="form.category_id" class="border rounded-md p-2 w-full">
              <option value="">-- Selecciona una categoría --</option>
              <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{ cat.name }}</option>
            </select>
          </div>

          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium">Modalidad</label>
              <select v-model="form.modality" class="border rounded-md p-2 w-full">
                <option>Presencial</option>
                <option>En línea</option>
                <option>Mixta</option>
              </select>
            </div>

            <div>
              <label class="block text-sm font-medium">Tipo</label>
              <select v-model="form.type" class="border rounded-md p-2 w-full">
                <option>Gratuito</option>
                <option>Pago</option>
              </select>
            </div>
          </div>

          <div v-if="form.type === 'Pago'">
            <label class="block text-sm font-medium">Precio</label>
            <Input v-model="form.price" type="number" step="0.01" />
          </div>

          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium">Fecha de inicio</label>
              <Input v-model="form.start_date" type="date" />
            </div>
            <div>
              <label class="block text-sm font-medium">Fecha de fin</label>
              <Input v-model="form.end_date" type="date" />
            </div>
          </div>

          <div class="flex justify-end gap-2 pt-4">
            <NavLink :href="route('admin.courses.index')">
              <Button variant="outline">Cancelar</Button>
            </NavLink>
            <Button type="submit">Guardar</Button>
          </div>
        </form>
      </CardContent>
    </Card>
  </div>
</AppLayout>
</template>
