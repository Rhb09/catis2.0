<?php
$testPath = realpath(__DIR__ . '/Historialclinico/4 a 5 meses');
if ($testPath && is_dir($testPath)) {
    echo 'Ruta válida: ' . $testPath;
} else {
    echo 'Ruta no válida o acceso denegado.';
}
?>
