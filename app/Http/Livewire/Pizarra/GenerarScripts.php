<?php
namespace App\Http\Livewire\Pizarra;

use App\Models\pizarra;
use Livewire\Component;

class GenerarScripts extends Component
{
    public $NOMBRE;
    public $ESTADO;
    public $pizarra; 
    public $scriptResultado; // Agrega la variable $scriptResultado
    protected $listeners = ['generarScriptTablaspsql','generarScriptTablasSQLSERVVER','generarScriptTablasMYSQL','generarScriptTablasOracle'];

    public function mount(pizarra $pizarra){
        $this->pizarra = $pizarra;
  
    }


    public function render()
    {
        
        $this->NOMBRE = $this->pizarra->nombre;
        $this->ESTADO = $this->pizarra->estado; 

        // Asigna el script resultado a la variable $scriptResultado
      

        return view('livewire.pizarra.generar-scripts');
    }

    public function generarScriptTablaspsql()
    {
       //dd('estaaqui');
       if($this->ESTADO== null){
       return ;       

       }
        $data = json_decode($this->ESTADO);
        $tablas = $data->tablas;

        $script = 'CREATE DATABASE   '. $this->NOMBRE. ';'. PHP_EOL;
        $script .= ' USE DATABASE '. PHP_EOL;

        foreach ($tablas as $tabla) {
            $tablaName = $tabla->name;
            $tablaAttributes = $tabla->attributes;

            $script .= 'CREATE TABLE ' . $tablaName . ' (' . PHP_EOL;
            $script .= '    id SERIAL PRIMARY KEY,' . PHP_EOL;

            foreach ($tablaAttributes as $attribute) {
                $script .= '    ' . $attribute . ' VARCHAR(50),' . PHP_EOL;
            }

            $script = rtrim($script, ',' . PHP_EOL) . PHP_EOL . ');' . PHP_EOL . PHP_EOL;
        }

        $this->scriptResultado = $script;
        return $script;
    }

    public function generarScriptTablasSQLSERVVER()
    {
        if($this->ESTADO== null){
            return ;       
     
            }
        $data = json_decode($this->ESTADO);
        $tablas = $data->tablas;

        $script = 'CREATE DATABASE   '. $this->NOMBRE. ';'. PHP_EOL;
        $script .= ' USE DATABASE '. PHP_EOL;

        foreach ($tablas as $tabla) {
            $tablaName = $tabla->name;
            $tablaAttributes = $tabla->attributes;

            $script .= 'CREATE TABLE ' . $tablaName . ' (' . PHP_EOL;
            $script .= '    id INT IDENTITY(1,1) PRIMARY KEY,' . PHP_EOL;

            foreach ($tablaAttributes as $attribute) {
                $script .= '    ' . $attribute . ' VARCHAR(50),' . PHP_EOL;
            }

            $script = rtrim($script, ',' . PHP_EOL) . PHP_EOL . ');' . PHP_EOL . PHP_EOL;
        }
        $this->scriptResultado = $script;
        return $script;
    }

    public function generarScriptTablasMYSQL()
    {
        if($this->ESTADO== null){
            return ;       
     
            }
        $data = json_decode($this->ESTADO);
        $tablas = $data->tablas;
        $script = 'CREATE DATABASE   '. $this->NOMBRE. ';'. PHP_EOL;
        $script .= ' USE DATABASE '. PHP_EOL;

        foreach ($tablas as $tabla) {
            $tablaName = $tabla->name;
            $tablaAttributes = $tabla->attributes;

            $script .= 'CREATE TABLE ' . $tablaName . ' (' . PHP_EOL;
            $script .= '    id INT AUTO_INCREMENT PRIMARY KEY,' . PHP_EOL;

            foreach ($tablaAttributes as $attribute) {
                $script .= '    ' . $attribute . ' VARCHAR(50),' . PHP_EOL;
            }

            $script = rtrim($script, ',' . PHP_EOL) . PHP_EOL . ');' . PHP_EOL . PHP_EOL;
        }
        $this->scriptResultado = $script;
        return $script;
    }

    public function generarScriptTablasOracle()
{
    if ($this->ESTADO == null) {
        return;
    }

    $data = json_decode($this->ESTADO);
    $tablas = $data->tablas;

    $script = 'CREATE DATABASE ' . $this->NOMBRE . ';' . PHP_EOL;
    $script .= '"PARA USAR LA BASE DE DATOS" '. '"sqlplus usuario/contraseña@nombre_basedatos"'. PHP_EOL;

    foreach ($tablas as $tabla) {
        $tablaName = $tabla->name;
        $tablaAttributes = $tabla->attributes;

        $script .= 'CREATE TABLE ' . $tablaName . ' (' . PHP_EOL;
        $script .= '    id NUMBER PRIMARY KEY,' . PHP_EOL;

        foreach ($tablaAttributes as $attribute) {
            $script .= '    ' . $attribute . ' VARCHAR(50),' . PHP_EOL;
        }

        $script = rtrim($script, ',' . PHP_EOL) . PHP_EOL . ');' . PHP_EOL . PHP_EOL;
    }

    $this->scriptResultado = $script;
    return $script;
}

}

