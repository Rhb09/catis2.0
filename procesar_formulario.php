<?php

require_once dirname(__FILE__).'/PHPWord-master/src/PhpWord/Autoloader.php';
\PhpOffice\PhpWord\Autoloader::register();

use PhpOffice\PhpWord\TemplateProcessor;

// Recogemos los datos del formulario
$patient_name = $_POST['patient_name'];
$document_number = $_POST['document_number'];
$consultation_date = $_POST['consultation_date'];
$accompanying_person = $_POST['accompanying_person'];
$relationship = $_POST['relationship'];
$notes = $_POST['notes'];
$document_type = $_POST['document_type'];
$perinatal_antecedents = $_POST['perinatal_antecedents'];
$general_aspect = $_POST['general_aspect'];
$reactivity = $_POST['reactivity'];
$entry_method = $_POST['entry_method'];

$templateWord = new TemplateProcessor('plantilla.docx');

// Asignamos valores a la plantilla
$templateWord->setValue('patient_name', $patient_name);
$templateWord->setValue('document_number', $document_number);
$templateWord->setValue('consultation_date', $consultation_date);
$templateWord->setValue('accompanying_person', $accompanying_person);
$templateWord->setValue('relationship', $relationship);
$templateWord->setValue('notes', $notes);
$templateWord->setValue('document_type', $document_type);
$templateWord->setValue('perinatal_antecedents', $perinatal_antecedents);
$templateWord->setValue('general_aspect', $general_aspect);
$templateWord->setValue('reactivity', $reactivity);
$templateWord->setValue('entry_method', $entry_method);

// Guardamos el documento
$outputFile = 'Documento_Paciente.docx';
$templateWord->saveAs($outputFile);

// Forzamos la descarga del archivo
header('Content-Description: File Transfer');
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Disposition: attachment; filename="'.basename($outputFile).'"');
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . filesize($outputFile));

flush(); // Flush system output buffer
readfile($outputFile);

exit;

