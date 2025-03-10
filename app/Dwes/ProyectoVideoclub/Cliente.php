<?php
namespace Dwes\ProyectoVideoclub;
include_once "Soporte.php";
include "Util/SoporteYaAlquiladoException.php";


class Cliente {
    public $nombre;
    public $numero;
    public $soportesAlquileres = [];
    public $maxAlquilerConcurrente = 3;
    public $numSoportesAlquilados = 0;

     public function __construct($nombre, $numero, $maxAlquilerConcurrente=3) {
        $this->nombre = $nombre;
        $this->numero = $numero;
        $this->maxAlquilerConcurrente = $maxAlquilerConcurrente;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
    }

    public function getNumSoportesAlquilados() {
        return $this->numSoportesAlquilados;
    }

    public function tieneAlquilado(Soporte $s): bool {
        foreach ($this->soportesAlquileres as $soporteAlquilado) {
            if ($soporteAlquilado === $s) {
                return true;
            }
        }
        return false;
    }

    public function alquilar(Soporte $s): Cliente {
        if ($this->tieneAlquilado($s)) {
            throw new Util\SoporteYaAlquiladoException("El soporte ya está alquilado.");
        }
    
        if ($this->numSoportesAlquilados >= $this->maxAlquilerConcurrente) {
            throw new Util\SoporteYaAlquiladoException("No se pueden alquilar más soportes, se ha alcanzado el límite.");
        }
    
        $this->soportesAlquileres[] = $s;
        $this->numSoportesAlquilados++;
        echo "El soporte ha sido alquilado con éxito.\n";
        return $this;
    }
    

    // Método para devolver un soporte
    public function devolver(int $numSoporte): bool {
        foreach ($this->soportesAlquileres as $index => $soporte) {
            if ($soporte->getNumero() === $numSoporte) {
                unset($this->soportesAlquileres[$index]);
                $this->soportesAlquileres = array_values($this->soportesAlquileres); // Reindexar array
                $this->numSoportesAlquilados--;
                echo "El soporte con número $numSoporte ha sido devuelto con éxito.\n";
                return true;
            }
        }
        echo "El soporte con número $numSoporte no estaba alquilado.\n";
        return false;
    }

    // Método para listar los soportes alquilados
    public function listarAlquileres() {
        $soportesAlquilados = $this->soportesAlquileres;
        if (empty($soportesAlquilados)) {
            echo "No hay soportes alquilados.\n";
        } else {
            echo "Soportes alquilados:\n";
            foreach ($soportesAlquilados as $soporte) {
                echo $soporte->muestraResumen() . "\n";
            }
        }   
    }
    public function muestraResumen() {
        return "Nombre: " . $this->nombre . "\n" .
               "Número: " . $this->numero . "\n";
    }
}

?>
