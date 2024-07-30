<?php
require 'vendor/autoload.php';

use PhpOffice\PhpWord\TemplateProcessor as PhpWordTemplateProcessor;

$templateProcessor = new PhpWordTemplateProcessor('plantilla.docx');
$templateProcessor->setValue('nombre', 'Test Name');
$templateProcessor->setValue('email', 'test@example.com');
$templateProcessor->saveAs('test_output.docx');
