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

    public function alquilarSocioProducto($numeroCliente, $numeroSoporte) {
        $socio = $this->socios[$numeroCliente - 1]; // Obtener el socio
        $producto = $this->productos[$numeroSoporte - 1]; // Obtener el producto

        try {
            // Intentar alquilar el producto
            $socio->alquilar($producto);
            

            // Actualizamos los contadores en Videoclub
            $this->numProductosAlquilados++;
            $this->numTotalAlquileres++;

        } catch (\Util\SoporteYaAlquiladoException $e) {
            echo "Error: " . $e->getMessage() . "\n";
        } catch (\Util\CupoSuperadoException $e) {
            echo "Error: " . $e->getMessage() . "\n";
        } catch (\Util\SoporteNoEncontradoException $e) {
            echo "Error: " . $e->getMessage() . "\n";
        } catch (\Util\ClienteNoEncontradoException $e) {
            echo "Error: " . $e->getMessage() . "\n";
        }
    }

    public function alquilarSocioProductos(int $numSocio, array $numerosProductos) {
        $socio = $this->socios[$numSocio - 1]; // Obtener el socio

        // Verificar si todos los productos están disponibles
        foreach ($numerosProductos as $numeroProducto) {
            $producto = $this->productos[$numeroProducto - 1]; // Obtener cada producto
            if ($producto->alquilado) {
                // Si algún producto está alquilado, no alquilamos ninguno
                echo "Error: El producto '{$producto->titulo}' no está disponible.\n";
                return; // Salir del método sin hacer el alquiler
            }
        }

        // Si todos los productos están disponibles, alquilamos
        foreach ($numerosProductos as $numeroProducto) {
            $producto = $this->productos[$numeroProducto - 1]; // Obtener cada producto
            try {
                $socio->alquilar($producto); // Alquilamos el producto para el socio
                $producto->alquilar(); // Marcamos el producto como alquilado

                // Actualizamos los contadores en Videoclub
                $this->numProductosAlquilados++;
                $this->numTotalAlquileres++;

                echo "Producto '{$producto->titulo}' alquilado con éxito.\n";
            } catch (\Util\SoporteYaAlquiladoException $e) {
                echo "Error: " . $e->getMessage() . "\n";
            } catch (\Util\CupoSuperadoException $e) {
                echo "Error: " . $e->getMessage() . "\n";
            } catch (\Util\SoporteNoEncontradoException $e) {
                echo "Error: " . $e->getMessage() . "\n";
            } catch (\Util\ClienteNoEncontradoException $e) {
                echo "Error: " . $e->getMessage() . "\n";
            }
        }
    }

    public function devolverSocioProducto(int $numSocio, int $numeroProducto) {
        $socio = $this->socios[$numSocio - 1];  // Obtenemos el socio
        $producto = $this->productos[$numeroProducto - 1];  // Obtenemos el producto

        // Comprobamos si el producto está alquilado y lo devolvemos
        if ($producto->alquilado) {
            $producto->devolver();  // Actualizamos el estado del producto a disponible
            echo "El producto '{$producto->titulo}' ha sido devuelto por el socio '{$socio->nombre}'.\n";
        } else {
            echo "El producto '{$producto->titulo}' no está alquilado y no puede devolverse.\n";
        }

        return $this;  // Permite encadenamiento de métodos
    }

    public function devolverSocioProductos(int $numSocio, array $numerosProductos) {
        foreach ($numerosProductos as $numeroProducto) {
            // Llamamos al método devolverSocioProducto para cada producto
            $this->devolverSocioProducto($numSocio, $numeroProducto);
        }

        return $this;  // Permite encadenamiento de métodos
    }

    

}