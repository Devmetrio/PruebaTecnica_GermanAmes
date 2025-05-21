<?php

namespace App\Services;

use App\Models\LoginHistory;
use App\Models\User;
use App\Models\Profile;

class UserProfileGeneratorService
{
    /**
     * Genera Users con sus Profiles y  de LoginHistory.
     *
     * @param int $totalUsers Número total de Users a generar
     * @return void
     */
    public function generate(int $totalUsers): void
    {
        // Calcular cuántos batchs o lotes se ncesita
        $batchSize = 500;
        $batches = (int) ceil($totalUsers / $batchSize);

        for ($i = 0; $i < $batches; $i++) {
            // Crear users, profiles y loginHistory
            $users = User::factory($batchSize)->create();
            $this->generateProfiles($users);
            $this->generateLoginHistory($users);

            echo "Lote " . ($i + 1) . "/$batches completado: $batchSize usuarios insertados\n";

            // Liberar memoria
            unset($users);
            gc_collect_cycles();
        }
    }

    /**
     * Genera Profiles para un conjunto masivo de Users.
     *
     * @return void
     */
    protected function generateProfiles($users): void
    {
        foreach ($users as $user) {
            $user->profile()->save(Profile::factory()->make());
        }
    }

    /**
     * Genera Login Histories para un conjunto masivo de Users.
     *
     * @return void
     */
    protected function generateLoginHistory($users): void
    {
        foreach ($users as $user) {
            $count = rand(0, 10);
            if ($count > 0) {
                $user->loginHistory()->saveMany(
                    LoginHistory::factory($count)->make()
                );
            }
        }
    }
}
