<?php
namespace Dwes\ProyectoVideoclub;
require_once "Videoclub.php";
// usando 'use'
use Dwes\ProyectoVideoclub\Videoclub;
use Dwes\ProyectoVideoclub\CintaVideo;
use Dwes\ProyectoVideoclub\Dvd;
use Dwes\ProyectoVideoclub\Juego;
use Dwes\ProyectoVideoclub\Cliente;

$videoclub = new Videoclub("Mi Videoclub");

$videoclub->incluirCintaVideo("Pulp Fiction", 1.99, 154, "16:9")
          ->incluirDvd("El Rey León", 2, 19.99, ["Español", "Inglés"], "16:9")
          ->incluirJuego("FIFA 25",2 ,49.99, "PS5", 1, 4);

$videoclub->incluirSocio("Juan Pérez")
          ->incluirSocio("Ana López");

$videoclub->alquilarSocioProducto(1, 1)
          ->alquilarSocioProducto(1, 2)
          ->alquilarSocioProducto(2, 3);

$videoclub->listarProductos()
          ->listarSocios();
?>