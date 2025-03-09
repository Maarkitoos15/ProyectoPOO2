<?php
include_once "Videoclub.php";

$vc = new Videoclub("Severo 8A");

// Incluir algunos soportes de prueba
$vc->incluirJuego("God of War", 19.99, "PS4", 1, 1);
$vc->incluirJuego("The Last of Us Part II", 49.99, "PS4", 1, 4);
$vc->incluirDvd("Torrente", 1, 4.5, "es", "16:9"); // Agregado un número válido
$vc->incluirDvd("Origen", 2, 4.5, "es,en,fr", "16:9");
$vc->incluirDvd("El Imperio Contraataca", 3, 3, "es,en", "16:9");
$vc->incluirCintaVideo("Los cazafantasmas", 3.5, 107, "16:9");
$vc->incluirCintaVideo("El nombre de la Rosa", 1.5, 140, "16:9");

// Listar los productos
$vc->listarProductos();

// Crear algunos socios
$vc->incluirSocio("Amancio Ortega");
$vc->incluirSocio("Pablo Picasso", 2);

// Realizar alquileres
echo "Realizando alquileres:\n";
$vc->alquilarSocioProducto(1, 2); // Socio 1 alquila producto 2
$vc->alquilarSocioProducto(1, 3); // Socio 1 alquila producto 3

// Intentar alquilar un producto ya alquilado
echo "Intentando alquilar un producto ya alquilado:\n";
$vc->alquilarSocioProducto(1, 2); // Socio 1 ya tiene el producto 2

// Intentar alquilar más productos de lo permitido
echo "Intentando alquilar más productos de lo permitido:\n";
$vc->alquilarSocioProducto(1, 6); // Socio 1 supera el máximo permitido

// Listar los socios
$vc->listarSocios();
?>
