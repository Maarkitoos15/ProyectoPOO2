<?php
namespace Dwes\ProyectoVideoclub;

include_once "Soporte.php";

class Dvd extends Soporte {
    public $idiomas = [];
    public $formatoPantalla;

    public function __construct($titulo, $numero, $precio, $idiomas, $formatoPantalla) {
        parent::__construct($titulo, $numero, $precio);
        $this->idiomas = $idiomas;
        $this->formatoPantalla = $formatoPantalla;
    }

    public function muestraResumen() {
        echo parent::muestraResumen();
        echo "<br><strong>Idiomas:</strong> " . implode(", ", $this->idiomas); // Corregido
        echo "<br><strong>Formato de pantalla:</strong> " . $this->formatoPantalla . "<br>";
    }
}
?>
