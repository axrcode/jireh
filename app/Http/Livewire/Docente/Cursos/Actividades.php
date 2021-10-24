<?php

namespace App\Http\Livewire\Docente\Cursos;

use App\Models\Actividad;
use Livewire\Component;

class Actividades extends Component
{
    public $curso;

    public function mount($curso)
    {
        $this->curso = $curso;
    }

    public function render()
    {
        $all_actividades = Actividad::where('curso_id', $this->curso)
            ->orderBy('destacado', 'DESC')
            ->orderBy('fecha_vencimiento', 'ASC')
            ->orderBy('created_at', 'ASC')
            ->paginate(10);

        if ( sizeof($all_actividades) > 0 ) {
            $actividades = $all_actividades;
        } else {
            $actividades = 'none';
        }

        return view('livewire.docente.cursos.actividades', [
            'actividades' => $actividades,
        ]);
    }
}
