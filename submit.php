<?php

require 'vendor/autoload.php';

use Robinsonherrera\Catis\GeneradorDocumentos;

// Obtener datos del formulario
$datosFormulario = [
    'patient_name' => $_POST['patient_name'],
    'document_number' => $_POST['document_number'],
    'consultation_date' => $_POST['consultation_date'],
    'accompanying_person' => $_POST['accompanying_person'],
    'relationship' => $_POST['relationship'],
    'document_type' => $_POST['document_type'],
    'perinatal_antecedents' => $_POST['perinatal_antecedents'],
    'general_aspect' => $_POST['general_aspect'],
    'reactivity' => $_POST['reactivity'],
    'entry_method' => $_POST['entry_method']
];

try {
    $generador = new GeneradorDocumentos();
    $generador->generarDocumento($datosFormulario);

    header('Location: index.html');
    exit;
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    exit;
}


