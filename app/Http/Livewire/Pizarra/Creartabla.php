<?php

namespace App\Http\Livewire\Pizarra;

use App\Models\pizarra;
use Livewire\Component;
use Livewire\Livewire;
use PhpParser\Node\Expr\Cast\String_;

class Creartabla extends Component
{
    public $tablaSeleccionadaId;
    public $nombreTabla;
    public $atributos = [];
    public $pizarra;
    public $tablas = [];
    protected $listeners = ['crearTabla', 'render','actualizarTablaSeleccionada'];

    public function mount(pizarra $pizarra){
        $this->pizarra = $pizarra;
  
    }
    public function render()

    {
        $pizarra = $this->pizarra;
        if ($pizarra == null) {
            $this->tablas = null;
        } else {
            $this->tablas = $pizarra->estado;
        }
        // Inicializar la propiedad $tablaSeleccionadaId
        $this->tablaSeleccionadaId = null;
        return view('livewire.pizarra.creartabla');
    }

    public function crearTabla($elementosInformacion, $relacionesInformacion)
    {
        // $this->pizarra = pizarra::find(1);

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

    public function actualizarTablaSeleccionada($tablaId)
    {
        // Obtener la instancia actualizada de la pizarra
        // $this->pizarra = pizarra::find(1);
    
        // Verificar si se encontró la pizarra
        if ($this->pizarra) {
            // Actualizar la propiedad $tablaSeleccionadaId con el ID de la tabla seleccionada
            $this->tablaSeleccionadaId = $tablaId;
    
            // Emitir el evento 'idTablaSeleccionada' con el valor actual de $this->pizarra
            $this->emit('idTablaSeleccionada', $this->pizarra, $this->tablaSeleccionadaId);
            // return redirect()->route('generarvista')->with([
            //     'idTablaSeleccionada' => $this->pizarra,
            //     'tablaSeleccionadaId' => $this->tablaSeleccionadaId
            // ]);
            
        }
    
        //dd($this->pizarra, $this->tablaSeleccionadaId);
    }
    
}
