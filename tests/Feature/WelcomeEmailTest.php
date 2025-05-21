<?php

namespace Tests\Feature;

use App\Jobs\SendWelcomeEmail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class WelcomeEmailTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Prueba que verifica que el comando artisan añada los jobs a la cola.
     */
    public function test_send_welcome_emails_jobs_to_queue(): void
    {
        Queue::fake();
        Mail::fake();

        // Crear 10 usuarios para las pruebas
        User::factory()->count(10)->create(['email_sent' => false]);

        $this->artisan('emails:send-welcome', ['count' => 5])
            ->assertSuccessful();

        Queue::assertPushed(SendWelcomeEmail::class, 5);
    }

    /**
     * Prueba que verifica que el comando artisan no envíe correos a usuarios que ya lo han recibido.
     */
    public function test_command_users_who_already_receive_email(): void
    {
        Queue::fake();
        Mail::fake();

        // Crear usuarios que recibieron y no recibieron correos
        User::factory()->count(5)->create(['email_sent' => true]);
        User::factory()->count(3)->create(['email_sent' => false]);

        $this->artisan('emails:send-welcome', ['count' => 5])
            ->expectsOutput('Solo se encontraron 3 usuarios que no han recibido correos de bienvenida.')
            ->assertSuccessful();

        Queue::assertPushed(SendWelcomeEmail::class, 3);
    }

    /**
     * Prueba que verifica que el comando artisan muestre un mensaje cuando no hay usuarios disponibles.
     */
    public function test_warning_when_no_users_available(): void
    {
        Queue::fake();
        Mail::fake();

        // Crear algunos usuarios que recibieron correos
        User::factory()->count(3)->create(['email_sent' => true]);

        $this->artisan('emails:send-welcome')
            ->expectsOutput('No hay usuarios disponibles que no hayan recibido ya un correo de bienvenida.')
            ->assertSuccessful();

        Queue::assertNothingPushed();
    }
}
