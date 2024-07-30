<?php

namespace Robinsonherrera\Catis;

use PhpOffice\PhpWord\TemplateProcessor;
use Exception;

class GeneradorDocumentos {
    public function generarDocumento($datosFormulario) {
        date_default_timezone_set('America/Bogota');
        $fechaCarpeta = date('Ymd');
        $nombreCarpeta = '4 a 5 meses';
        $directorioBase = __DIR__ . "/../Historialclinico/Primera Infancia/{$nombreCarpeta}";
        $this->crearDirectorio($directorioBase);
        $directorioFecha = "{$directorioBase}/{$fechaCarpeta}";

        // Verificar si existe el número de documento (cédula) para crear una subcarpeta adicional
        $cedula = isset($datosFormulario['document_number']) ? preg_replace('/[^A-Za-z0-9_\-]/', '_', $datosFormulario['document_number']) : 'Desconocido';
        $directorioCedula = "{$directorioFecha}/{$cedula}";
        $this->crearDirectorio($directorioCedula);

        // Array de rutas a las plantillas
        $plantillas = [
            'plantilla1' => __DIR__ . '/../plantilla1.docx',
            'plantilla2' => __DIR__ . '/../plantilla2.docx',
            'plantilla3' => __DIR__ . '/../plantilla3.docx'
        ];

        foreach ($plantillas as $nombrePlantilla => $plantillaPath) {
            if (!file_exists($plantillaPath)) {
                echo "Plantilla no encontrada: $plantillaPath\n";
                continue;
            }

            $templateProcessor = new TemplateProcessor($plantillaPath);

            // Mostrar los datos del formulario para depuración
            print_r($datosFormulario);

            foreach ($datosFormulario as $clave => $valor) {
                // Escapar caracteres especiales para evitar problemas en el documento
                $templateProcessor->setValue($clave, htmlspecialchars($valor));
            }

            // Sanitizar el nombre del paciente para el nombre del archivo
            $nombreSanitizado = isset($datosFormulario['patient_name']) 
                ? preg_replace('/[^A-Za-z0-9_\-]/', '_', $datosFormulario['patient_name']) 
                : 'Desconocido';
                
            $timestamp = date('YmdHis');
            $resultadoPath = "{$directorioCedula}/{$nombrePlantilla}_{$nombreSanitizado}_{$timestamp}.docx";

            try {
                $templateProcessor->saveAs($resultadoPath);
                echo "Documento generado: $resultadoPath\n";
            } catch (Exception $e) {
                echo "Error al guardar el documento para {$nombrePlantilla}: " . $e->getMessage() . "\n";
            }
        }
    }

    private function crearDirectorio($directorio) {
        if (!file_exists($directorio)) {
            if (!mkdir($directorio, 0775, true)) {
                throw new Exception("Error al crear el directorio: $directorio");
            }
        }
    }
}









