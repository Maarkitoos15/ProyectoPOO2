<?php

include_once "Soporte.php";

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

    public function alquilar(Soporte $s): bool {
        if ($this->tieneAlquilado($s)) {
            echo "No se puede alquilar el soporte porque ya está alquilado.\n";
            return false;
        }

        if ($this->numSoportesAlquilados >= $this->maxAlquilerConcurrente) {
            echo "No se pueden alquilar más soportes, se ha alcanzado el límite.\n";
            return false;
        }

        $this->soportesAlquileres[] = $s;
        $this->numSoportesAlquilados++;
        echo "El soporte ha sido alquilado con éxito.\n";
        return true;
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
