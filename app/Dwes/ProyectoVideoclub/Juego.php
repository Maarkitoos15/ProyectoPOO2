<?php
namespace Dwes\ProyectoVideoclub;
include_once "Soporte.php";

class Juego extends Soporte {
    public $consola;
    public $minNumJugadores;
    public $maxNumJugadores;

    public function __construct($titulo, $precio, $consola, $minJugadores, $maxJugadores) {
        parent::__construct($titulo, rand(1000, 9999), $precio);  // Precio debe ser un número
        $this->consola = $consola;
        $this->minNumJugadores = $minJugadores;
        $this->maxNumJugadores = $maxJugadores;

}

    public function muestraJugadoresPosibles() {
        echo "Jugadores posibles: " . $this->minNumJugadores . " a " . $this->maxNumJugadores . "\n";

}
    public function muestraResumen() {
        parent::muestraResumen(); 
        echo "Consola: " . $this->consola . "\n";
        $this->muestraJugadoresPosibles();

}
}

?>