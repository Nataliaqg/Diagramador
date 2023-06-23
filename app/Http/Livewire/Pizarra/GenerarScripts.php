<?php
namespace App\Http\Livewire\Pizarra;

use App\Models\pizarra;
use Livewire\Component;

class GenerarScripts extends Component
{
    public $NOMBRE;
    public $ESTADO;
    public $scriptResultado; // Agrega la variable $scriptResultado
    protected $listeners = ['generarScriptTablaspsql','generarScriptTablasSQLSERVVER','generarScriptTablasMYSQL'];


    public function render()
    {
        $pizarra = pizarra::find(1);
        $this->NOMBRE = $pizarra->nombre;
        $this->ESTADO = $pizarra->estado; 

        // Asigna el script resultado a la variable $scriptResultado
      

        return view('livewire.pizarra.generar-scripts');
    }

    public function generarScriptTablaspsql()
    {
       //dd('estaaqui');
        $data = json_decode($this->ESTADO);
        $tablas = $data->tablas;

        $script = 'CREATE DATABASE   '. $this->NOMBRE. ';'. PHP_EOL;

        foreach ($tablas as $tabla) {
            $tablaName = $tabla->name;
            $tablaAttributes = $tabla->attributes;

            $script .= 'CREATE TABLE ' . $tablaName . ' (' . PHP_EOL;
            $script .= '    id SERIAL PRIMARY KEY,' . PHP_EOL;

            foreach ($tablaAttributes as $attribute) {
                $script .= '    ' . $attribute . ' VARCHAR(100),' . PHP_EOL;
            }

            $script = rtrim($script, ',' . PHP_EOL) . PHP_EOL . ');' . PHP_EOL . PHP_EOL;
        }
        $this->scriptResultado = $script;
        return $script;
    }

    public function generarScriptTablasSQLSERVVER()
    {
        $data = json_decode($this->ESTADO);
        $tablas = $data->tablas;

        $script = 'CREATE DATABASE   '. $this->NOMBRE. ';'. PHP_EOL;

        foreach ($tablas as $tabla) {
            $tablaName = $tabla->name;
            $tablaAttributes = $tabla->attributes;

            $script .= 'CREATE TABLE ' . $tablaName . ' (' . PHP_EOL;
            $script .= '    id INT IDENTITY(1,1) PRIMARY KEY,' . PHP_EOL;

            foreach ($tablaAttributes as $attribute) {
                $script .= '    ' . $attribute . ' VARCHAR(100),' . PHP_EOL;
            }

            $script = rtrim($script, ',' . PHP_EOL) . PHP_EOL . ');' . PHP_EOL . PHP_EOL;
        }
        $this->scriptResultado = $script;
        return $script;
    }

    public function generarScriptTablasMYSQL()
    {
        $data = json_decode($this->ESTADO);
        $tablas = $data->tablas;
        $script = 'CREATE DATABASE   '. $this->NOMBRE. ';'. PHP_EOL;

        foreach ($tablas as $tabla) {
            $tablaName = $tabla->name;
            $tablaAttributes = $tabla->attributes;

            $script .= 'CREATE TABLE ' . $tablaName . ' (' . PHP_EOL;
            $script .= '    id INT AUTO_INCREMENT PRIMARY KEY,' . PHP_EOL;

            foreach ($tablaAttributes as $attribute) {
                $script .= '    ' . $attribute . ' VARCHAR(100),' . PHP_EOL;
            }

            $script = rtrim($script, ',' . PHP_EOL) . PHP_EOL . ');' . PHP_EOL . PHP_EOL;
        }
        $this->scriptResultado = $script;
        return $script;
    }
}

