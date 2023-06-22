<?php

namespace App\Http\Livewire\Pizarra;

use Livewire\Component;
use PhpParser\Node\Expr\Cast\String_;

class Creartabla extends Component
{

    public $nombreTabla;
    public $personas = [
        [
            'position' => ['x' => 100, 'y' => 30],
            'size' => ['width' => 120, 'height' => 80],
            'name' => 'Persona',
            'attributes' => ['nombre: String', 'edad: Number'],
            'methods' => ['saludar()', 'trabajar()'],
        ],
        [
            'position' => ['x' => 100, 'y' => 80],
            'size' => ['width' => 120, 'height' => 80],
            'name' => 'Melanie',
            'attributes' => ['nombre: String', 'edad: Number'],
            'methods' => ['saludar()', 'trabajar()'],
        ],
        [
            'position' => ['x' => 200, 'y' => 80],
            'size' => ['width' => 120, 'height' => 80],
            'name' => 'CArla',
            'attributes' => ['nombre: String', 'edad: Number'],
            'methods' => ['saludar()', 'trabajar()'],
        ],
        // Agrega más elementos de persona si es necesario
    ];
    public $persona;



    public $atributos = [];
    protected $listeners = ['crearTabla','render'];

    public function render()

    {

        $this->persona = [
            'position' => ['x' => 100, 'y' => 30],
            'size' => ['width' => 120, 'height' => 80],
            'name' => 'Persona',
            'attributes' => ['nombre: String', 'edad: Number'],
            'methods' => ['saludar()', 'trabajar()'],
        ];



        return view('livewire.pizarra.creartabla');
    }

    public function crearTabla($nombreTabla, $atributos)
    {
        $nuevaPersona = [
            'position' => ['x' => 200, 'y' => 200],
            'size' => ['width' => 120, 'height' => 80],
            'name' => $nombreTabla,
            'attributes' => $atributos,
            'methods' => ['saludar()', 'trabajar()'],
        ];
    
        $this->personas[] = $nuevaPersona;
        

       
    }
    
}
