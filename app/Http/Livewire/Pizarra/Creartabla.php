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


public function crearTabla($nombreTabla, $atributos)
{
    $this->pizarra = pizarra::find(1);
    $nuevaPersona = [
        'position' => ['x' => 200, 'y' => 200],
        'size' => ['width' => 120, 'height' => 80],
        'name' => $nombreTabla,
        'attributes' => $atributos,
        'methods' => ['saludar()', 'trabajar()'],
    ]; 

    // Decodificar el JSON actual del atributo 'tablas' en un arreglo
  
    if(!$this->pizarra->estado==null){
        $tablasArray = json_decode($this->pizarra->estado, true);
    }

    // Agregar $nuevaPersona al arreglo
    $tablasArray[] = $nuevaPersona;
    

    // Codificar el arreglo resultante como JSON
    $tablasJson = json_encode($tablasArray);

    // Asignar el nuevo JSON al atributo 'tablas'
    
    
    $this->pizarra->estado = $tablasJson;

    // Guardar los cambios en la base de datos
    $this->pizarra->save();
    $this->tablas=$this->pizarra->estado;
    $this->render();
}


    

}