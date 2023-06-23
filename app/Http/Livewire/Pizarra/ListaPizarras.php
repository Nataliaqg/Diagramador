<?php

namespace App\Http\Livewire\Pizarra;

use App\Models\pizarra;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ListaPizarras extends Component
{

    public $pizarras; 
    public $nombrePizarra;
    public function render()
    {
        $this->pizarras = pizarra::all();

        return view('livewire..pizarra.lista-pizarras');
    }
  
    public function crearPizarra()
{

    if (!empty($this->nombrePizarra)) {
        $usuario = Auth::user();
       
        pizarra::create([
            'nombre' => $this->nombrePizarra,
            'user_id' => $usuario->id           
        ]);     

    }
    $this->render();
    
}

}
