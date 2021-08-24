<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EvidenceSuggestion extends Mailable
{
    public $subject = "Prueba SED - Resultado de Evidencias";
    public $aprobadas;
    public $incorrectas;
    public $recomendaciones;
    public $usuario;
    public $prueba;
    public $analista;
    public $observacion;
    public $telefono;
    public $direccion;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($verify, $unverify,$recommendation, $username, $testName, $analistName, $observation, $phone, $address)
    {
        $this->aprobadas = $verify;
        $this->incorrectas = $unverify;
        $this->recomendaciones = $recommendation;
        $this->usuario = $username;
        $this->prueba = $testName;
        $this->analista = $analistName;
        $this->observacion = $observation;
        $this->telefono = $phone;
        $this->direccion = $address;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.evidence-suggestion');
    }
}
