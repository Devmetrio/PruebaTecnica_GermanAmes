<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Services\UserProfileGeneratorService;

class UserSeeder extends Seeder
{
    /**
     * Ejecuta el seeders de User.
     */
    public function run(): void
    {        
        $this->command->info('Registrando ingreso masivo de usuarios.');
        
        $generator = new UserProfileGeneratorService();
        $totalUsers = 10000000; 
        
        $generator->generate($totalUsers);
        
        $this->command->info("Se han generado $totalUsers usuarios con sus perfiles en segundos");
        
    }
}