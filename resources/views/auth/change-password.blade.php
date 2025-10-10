<x-guest-layout>
    <div class="max-w-md mx-auto mt-10">
        <x-authentication-card>
            <x-slot name="logo">
                <img src="/logo.png" alt="Logo" class="w-20 h-20 mx-auto" />
            </x-slot>

            <h2 class="text-lg font-semibold mb-4">Cambia tu contraseña</h2>

            @if(session('warning'))
                <div class="bg-yellow-100 text-yellow-800 p-2 rounded mb-3">
                    {{ session('warning') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.change.update') }}">
                @csrf

                <div>
                    <x-label for="password" value="Nueva contraseña" />
                    <x-input id="password" type="password" name="password" required autofocus />
                </div>

                <div class="mt-4">
                    <x-label for="password_confirmation" value="Confirmar contraseña" />
                    <x-input id="password_confirmation" type="password" name="password_confirmation" required />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-button>Cambiar contraseña</x-button>
                </div>
            </form>
        </x-authentication-card>
    </div>
</x-guest-layout>
