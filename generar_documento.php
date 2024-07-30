<?php

require 'vendor/autoload.php';

use Robinsonherrera\Catis\GeneradorDocumentos;

// Datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];

// Crear una instancia del generador de documentos
$generador = new GeneradorDocumentos();
$generador->generarDocumento($nombre, $email);

// Redirigir a index.php después de generar el documento
header('Location: index.html');
exit;
