<?php

namespace App\Console\Commands;

use App\Jobs\SendWelcomeEmail;
use App\Models\User;
use Illuminate\Console\Command;

class RandomWelcomeEmails extends Command
{
    /**
     * El nombre y la firma del comando.
     *
     * @var string
     */
    protected $signature = 'emails:send-welcome {count=500}';


    /**
     * La descripción del comando.
     *
     * @var string
     */
    protected $description = 'Envía correos de bienvenida a un grupo de usuarios aleatorios';


    /**
     * Ejecuta el comando de la consola.
     *
     * @return int
     */
    public function handle(): int
    {
        $count = $this->argument('count');

        $this->info("Enviando correos de bienvenida a {$count} usuarios aleatorios");

        // Obtener usuarios aleatorios que no hayan recibido el correo de bienvenida
        $users = User::where('email_sent', false)
            ->inRandomOrder()
            ->limit($count)
            ->get();

        $actualCount = $users->count();

        if ($actualCount === 0) {
            $this->warn('No hay usuarios disponibles que no hayan recibido ya un correo de bienvenida.');
            return Command::SUCCESS;
        }

        if ($actualCount < $count) {
            $this->warn("Solo se encontraron {$actualCount} usuarios que no han recibido correos de bienvenida.");
        }

        $progressBar = $this->output->createProgressBar($actualCount);
        $progressBar->start();

        // Se hace uso de chunk de 100 para reuducir la sobrecarga de memoria
        $users->chunk(100)->each(function ($chunk) use ($progressBar) {
            foreach ($chunk as $user) {
                SendWelcomeEmail::dispatch($user);
                $progressBar->advance();
            }
        });

        $progressBar->finish();
        $this->newLine(1);
        $this->info("Se han programado {$actualCount} correos de bienvenida para su envío.");

        return Command::SUCCESS;
    }
}
