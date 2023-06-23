<?php

namespace App\Http\Livewire\Pizarra;

use Livewire\Component;

class GenerarVistas extends Component
{
    protected $listeners = ['generarPlantillaHTML'];
    public $scriptResultado; 

    public function render()
    {
        return view('livewire..pizarra.generar-vistas');
    }

    function generarPlantillaHTML($nombreTabla, $atributos)
    {
     
        $html = '<h2>' . $nombreTabla . '</h2>';
        
        // Generar campos de entrada para los atributos
        foreach ($atributos as $atributo) {
            $html .= '<label for="' . $atributo . '">' . $atributo . ':</label>';
            $html .= '<input type="text" id="' . $atributo . '" name="' . $atributo . '"><br>';
        }
        
        // Agregar botones "Guardar" y "Eliminar"
        $html .= '<button onclick="guardar()">Guardar</button>';
        $html .= '<button onclick="eliminar()">Eliminar</button>';
        
        // Agregar un contenedor para mostrar el resultado
        $html .= '<div id="resultado"></div>';
        
        // Agregar el script JavaScript para las funciones guardar() y eliminar()
        $html .= '
            <script>
                function guardar() {
                    // Código para guardar los datos aquí...
                    document.getElementById("resultado").innerHTML = "Datos guardados";
                    document.getElementById("resultadoVista").value = document.getElementById("resultado").innerHTML;
                }
                
                function eliminar() {
                    // Código para eliminar los datos aquí...
                    document.getElementById("resultado").innerHTML = "Datos eliminados";
                    document.getElementById("resultadoVista").value = document.getElementById("resultado").innerHTML;
                }
            </script>
        ';
        $this->scriptResultado = $html;
        return $html;
    }
}
