<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
        {
            \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'admin']);
            \Spatie\Permission\Models\Role::firstOrCreate(['name' => 'member']);
            $email = env('ADMIN_EMAIL', 'admin@example.com');

            $admin = User::where('email', $email)->first();

            if ($admin) {
                $this->command->warn("Admin ya existe: {$email}");
                return;
            }
            $admin = User::create([
                'name' => env('ADMIN_NAME', 'Administrador'),
                'email' => $email,
                'password' => Hash::make(env('ADMIN_PASSWORD', 'change_me_123')),
                'must_change_password' => true, 
            ]);

            if (method_exists($admin, 'assignRole')) {
                $admin->assignRole('admin');
            }

            $this->command->info("Admin creado correctamente: {$email}");
            $this->command->warn("Cambia la contraseña inmediatamente.");
            Log::warning("Admin user seeded. Remember to change credentials.");
        }
}
