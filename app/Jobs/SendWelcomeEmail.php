<?php

namespace App\Jobs;

use App\Mail\WelcomeMailMessage;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * El número de intentos para el job.
     *
     * @var int
     */
    public $tries = 3;

    /**
     * El usuario al que se enviará el correo.
     *
     * @var \App\Models\User
     */
    protected $user;

    /**
     * Crea una nueva instancia del job.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Ejecuta el job.
     *
     * @return void
     */
    public function handle(): void
    {
        // Enviar el correo
        Mail::to($this->user->email)->send(new WelcomeMailMessage($this->user));

        $this->user->email_sent = true;
        $this->user->save();
    }
}
