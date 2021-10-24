<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificacionInscripcion extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Inscripción Exitosa';

    public $info_inscripcion, $empresa, $academico_actual;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct( $info_inscripcion, $empresa, $academico_actual )
    {
        $this->info_inscripcion = $info_inscripcion;
        $this->empresa = $empresa;
        $this->academico_actual = $academico_actual;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('public.inscripcion.notificacion');
    }
}
