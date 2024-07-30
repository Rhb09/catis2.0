<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

$filePath = 'Db.xlsx';  // Reemplaza con la ruta a tu archivo de Excel

if (file_exists($filePath)) {
    $spreadsheet = IOFactory::load($filePath);
    $sheet = $spreadsheet->getActiveSheet();
    $data = $sheet->toArray();

    // Convertir los datos en formato JSON
    $jsonData = json_encode($data);

    // Devolver los datos en formato JSON
    header('Content-Type: application/json');
    echo $jsonData;
} else {
    echo "El archivo no se encuentra.";
}



