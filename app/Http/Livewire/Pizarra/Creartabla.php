<?php

namespace App\Http\Livewire\Pizarra;

use App\Models\pizarra;
use Livewire\Component;
use PhpParser\Node\Expr\Cast\String_;

class Creartabla extends Component
{

    public $nombreTabla;
    public $atributos = [];
    public $pizarra;
    public $tablas = [];
    protected $listeners = ['crearTabla','render'];

    public function render()

    {
        $pizarra = pizarra::find(1);
        if ($pizarra == null) {
            $this->tablas = null;
        } else {
            $this->tablas = $pizarra->estado;
        }
        return view('livewire.pizarra.creartabla');
    }


// public function crearTabla($elementosInformacion)
// {
//     $this->pizarra = pizarra::find(1);  
    
//     // Codificar el arreglo resultante como JSON
//     $tablasJson = json_encode($elementosInformacion);
//     // Asignar el nuevo JSON al atributo 'tablas'   
    
//     $this->pizarra->estado = $tablasJson;

//     // Guardar los cambios en la base de datos
//     $this->pizarra->save();
//     $this->tablas=$this->pizarra->estado;
//     $this->render();
// }

public function crearTabla($elementosInformacion, $relacionesInformacion)
{
    $this->pizarra = pizarra::find(1);

    // Combinar la información de las tablas y las relaciones en un solo array
    $data = [
        'tablas' => $elementosInformacion,
        'relaciones' => $relacionesInformacion
    ];

    // Codificar el array combinado como JSON
    $estadoJson = json_encode($data);

    // Asignar el nuevo JSON al atributo 'estado' de la pizarra
    $this->pizarra->estado = $estadoJson;

    // Guardar los cambios en la base de datos
    $this->pizarra->save();

    $this->tablas = $this->pizarra->estado;
    $this->render();
}



    

}