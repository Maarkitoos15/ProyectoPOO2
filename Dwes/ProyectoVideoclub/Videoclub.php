<?php
namespace Dwes\ProyectoVideoclub;
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

    public function incluirCintaVideo($titulo, $numero, $precio, $duracion) {
        $this->incluirProducto(new CintaVideo($titulo, $numero, $precio, $duracion));
        return $this; // Permite encadenamiento de métodos
    }

    public function incluirDvd($titulo, $numero, $precio, $idiomas, $formatoPantalla) {
        $this->incluirProducto(new Dvd($titulo, $numero, $precio, $idiomas, $formatoPantalla));
        return $this;
    }

    public function incluirJuego($titulo, $numero, $precio, $consola, $minJugadores, $maxJugadores) {
        $this->incluirProducto(new Juego($titulo, $numero, $precio, $consola, $minJugadores, $maxJugadores));
        return $this;
    }

    public function incluirSocio($nombre, $maxAlquileresConcurrentes = 3) {
        $this->socios[] = new Cliente($nombre, $maxAlquileresConcurrentes);
        $this->numSocios++;
        return $this;
    }

    public function listarProductos() {
        echo "Productos disponibles:\n";
        foreach ($this->productos as $producto) {
            echo $producto->muestraResumen() . "\n";
        }
        return $this;
    }

    public function listarSocios() {
        echo "Socios del videoclub:\n";
        foreach ($this->socios as $socio) {
            echo $socio->muestraResumen() . "\n";
        }
        return $this;
    }

    public function alquilarSocioProducto($numeroCliente, $numeroSoporte): Videoclub {
        $socio = $this->socios[$numeroCliente - 1] ?? null;
        $producto = $this->productos[$numeroSoporte - 1] ?? null;

        if ($socio && $producto) {
            $socio->alquilar($producto);
        } else {
            echo "Error: Cliente o producto no encontrado.\n";
        }

        return $this;
    }
}
?>
