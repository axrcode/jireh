<?php

namespace App\Http\Livewire\Docente\Cursos;

use App\Models\Anuncio;
use Livewire\Component;

class Anuncios extends Component
{
    public $curso;

    public function mount($curso)
    {
        $this->curso = $curso;
    }

    public function render()
    {
        $all_anuncios = Anuncio::where('curso_id', $this->curso)
            ->orderBy('destacado', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);

        if ( sizeof($all_anuncios) > 0 ) {
            $anuncios = $all_anuncios;
        } else {
            $anuncios = 'none';
        }

        return view('livewire.docente.cursos.anuncios', [
            'anuncios' => $anuncios,
            'curso' => $this->curso,
        ]);
    }
}
