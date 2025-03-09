<?php
namespace Dwes\ProyectoVideoclub;
include_once "Soporte.php";

class CintaVideo extends Soporte {
    public $duracion;

    public function __construct($titulo, $numero, $precio, $duracion) {
        parent::__construct($titulo, $numero, $precio);
        $this->duracion = $duracion;
    }

    public function muestraResumen() {
        return parent::muestraResumen() . "\nDuración: " . $this->duracion . " minutos\n";
    }
}
?>
