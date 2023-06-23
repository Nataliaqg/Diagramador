<?php

namespace App\Http\Livewire;

use App\Models\pizarra;
use Livewire\Component;

class GenerarVistas extends Component
{
    protected $listeners = ['idTablaSeleccionada', 'encontrarTablaPorId'];
    public $contenidoPizarra;
    public $idTablaSeleccionada;
    public $NOMBREBD;
    public $ESTADO;
    public $atributosTabla;
    public $scriptResultado;
    public function render()
    {
        return view('livewire.pizarra.generar-vistas');
    }


    //recibe el contenido de pizarra y tambien el id de la tabla seleccionada
    public function idTablaSeleccionada($contenidoPizarra, $idTablaSeleccionada)
{
    $this->idTablaSeleccionada = $idTablaSeleccionada;
    $this->contenidoPizarra = $contenidoPizarra;
    $this->NOMBREBD = $this->contenidoPizarra['nombre'];
    $this->ESTADO = $this->contenidoPizarra['estado'];
    // Decodificar el JSON de $this->ESTADO a un array asociativo
    $data = json_decode($this->ESTADO, true);

    // Obtener las tablas del estado
    $tablas = $data['tablas'];

    // Buscar la tabla con el ID exacto
    $atributosArray = []; // Array para almacenar los valores de $atributo
    $nombreTabla = ''; // Variable para almacenar el nombre de la tabla

    foreach ($tablas as $tabla) {
        if ($tabla['id'] === $idTablaSeleccionada) {
            // Encontrada la tabla con el ID exacto, almacenar los valores de sus atributos
            $nombreTabla = $tabla['name'];
            $atributos = $tabla['attributes'];
            foreach ($atributos as $atributo) {
                $atributosArray[] = $atributo; // Agregar cada valor de $atributo al array
            }
            break;
        }
    }
    //dd($nombreTabla,$atributosArray);
    $this->generarPlantillaHTML($nombreTabla,$atributosArray);
}

function generarPlantillaHTML($nombreTabla, $atributos)
{
    $html = '<div class="card custom-card">';
    $html .= '<div class="card-body">';
    $html .= '<h2 class="card-title">' . $nombreTabla . '</h2>';
    $html .= '<style>
        .edit-button {
            padding: 8px 16px;
            border-radius: 4px;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        .edit-button.edit {
            background-color: #2196F3;
        }
        
        .edit-button.delete {
            background-color: #F44336;
        }
        
        .edit-button:hover {
            background-color: #555;
        }
        .custom-card {
            background-color: #EAEAFF;
        }
    </style>';
    
    // Generar campos de entrada para los atributos
    foreach ($atributos as $atributo) {
        $html .= '<label for="' . $atributo . '">' . $atributo . ':</label>'.'<br>' ;
        $html .= '<input type="text" id="' . $atributo . '" name="' . $atributo . '"><br>';
    }
    
    // Agregar botones "Guardar" y "Eliminar"
    $html .= '<button class="edit-button edit m-3" onclick="guardar()">Guardar</button>';
    $html .= '<button class="edit-button edit m-3" onclick="eliminar()">Eliminar</button>';
    $html .= '<button class="edit-button edit m-3" onclick="editar()">Editar</button>';
    
    // Agregar un contenedor para mostrar el resultado
    $html .= '<div id="resultado"></div>';
    
    // Agregar el script JavaScript para las funciones guardar(), eliminar() y editar()
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
            
            function editar() {
                // Código para editar los datos aquí...
                document.getElementById("resultado").innerHTML = "Datos editados";
                document.getElementById("resultadoVista").value = document.getElementById("resultado").innerHTML;
            }
        </script>
    ';
    
    $html .= '</div>';
    $html .= '</div>';
    
    $this->scriptResultado = $html;
    return $html;
}


}
