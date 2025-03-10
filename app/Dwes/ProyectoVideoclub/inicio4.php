<?php
namespace Dwes\ProyectoVideoclub;
require_once 'Videoclub.php';

$videoclub = new Videoclub("Mi Videoclub");

$videoclub->incluirCintaVideo("Pulp Fiction", 1.99, 154, "16:9")
          ->incluirDvd("El Rey Leon", 2, 19.99, ["Español", "Ingles"], "16:9")
          ->incluirJuego("FIFA 25",2, 49.99, "PS5", 1, 4);
        

$videoclub->incluirSocio("Juan Pérez")
          ->incluirSocio("Ana López");

$videoclub->alquilarSocioProducto(1, 1)
          ->alquilarSocioProducto(1, 2)
          ->alquilarSocioProducto(2, 3);

$videoclub->listarProductos()
          ->listarSocios();
?>