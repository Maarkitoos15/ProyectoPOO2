<?php
require_once 'Soporte.php';
require_once 'CintaVideo.php';
require_once 'Dvd.php';
require_once 'Juego.php';
require_once 'Cliente.php';

class Videoclub {
    public $nombre;
    public $productos = [];
    public $socios = [];
    public $numSocios = 0;

    public function __construct($nombre = '') {
        $this->nombre = $nombre;
    }

    private function incluirProducto(Soporte $producto) {
        $this->productos[] = $producto;
    }

    public function incluirCintaVideo($titulo, $precio, $duracion, $formatoPantalla) {
        $this->incluirProducto(new CintaVideo($titulo, $precio, $duracion, $formatoPantalla));
    }

    public function incluirDvd($titulo, $numero, $precio, $idiomas, $formatoPantalla) {
        $this->incluirProducto(new Dvd($titulo, $numero, $precio, $idiomas, $formatoPantalla));
    }

    public function incluirJuego($titulo, $precio, $consola, $minJugadores, $maxJugadores) {
        $this->incluirProducto(new Juego($titulo, $precio, $consola, $minJugadores, $maxJugadores));
    }

    public function incluirSocio($nombre, $maxAlquileresConcurrentes = 3) {
        $this->socios[] = new Cliente($nombre, $maxAlquileresConcurrentes);
        $this->numSocios++;
    }

    public function listarProductos(){

    echo "Productos disponibles:\n";
    foreach ($this->productos as $producto) {
        echo $producto->muestraResumen() . "\n";
        }
       
    }

    public function listarSocios() {

        echo "Socios del videoclub:\n";
        foreach ($this->socios as $socio) {
            echo $socio->muestraResumen() . "\n";
           
        }

    }

    public function alquilarSocioProducto($numeroCliente,$numeroSoporte){
    
        $socio = $this->socios[$numeroCliente - 1];
        $producto = $this->productos[$numeroSoporte - 1];
        $socio->alquilar($producto);
    }

}