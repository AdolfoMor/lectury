<template>
    <Head title="Cambio de contraseña" />
    <AuthenticationCard>

        <template #logo>
            <AuthenticationCardLogo />
        </template>
        <div class="max-w-md mx-auto mt-10">
            <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            <h2 class="text-lg font-semibold mb-4">Cambia tu contraseña</h2>
            </div>
        <div v-if="warning" class="bg-yellow-100 text-yellow-800 p-2 rounded mb-3">
            {{ warning }}
        </div>

        <form @submit.prevent="updatePassword">
            <div>
            <InputLabel for="password">Nueva contraseña</InputLabel>
            <TextInput id="password" class="mt-1 block w-full" type="password" v-model="form.password" required />
            <InputError :message="form.errors.password" />
            </div>

            <div class="mt-4">
            <InputLabel for="password_confirmation">Confirmar contraseña</InputLabel>
            <TextInput id="password_confirmation" class="mt-1 block w-full" type="password" v-model="form.password_confirmation" required />
            <InputError :message="form.errors.password_confirmation" />
            </div>

            <div class="flex items-center justify-end mt-4">
            <PrimaryButton :disabled="form.processing">Cambiar contraseña</PrimaryButton>
            </div>
        </form>
        </div>
    </AuthenticationCard>

</template>

<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

// Props
defineProps({
  warning: String,
});

// Formulario controlado por Inertia
const form = useForm({
  password: '',
  password_confirmation: '',
});

// Envío del formulario
const updatePassword = () => {
  form.post(route('password.change.update'));
};
</script>
