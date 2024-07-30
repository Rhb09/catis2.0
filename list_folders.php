<?php
$baseDirectory = __DIR__ . '/Historialclinico';
$path = isset($_GET['path']) ? $_GET['path'] : '';

function renderFolderContent($baseDirectory, $currentDir) {
    $currentDirPath = $baseDirectory . '/' . $currentDir;

    // Verifica si el directorio actual existe
    if (!is_dir($currentDirPath)) {
        echo '<p>No se encontró la carpeta.</p>';
        return;
    }

    // Obtener el directorio padre
    $parentDir = dirname($currentDir);
    $parentDir = $parentDir === '.' ? '' : $parentDir;

    // Listar carpetas
    $folders = glob($currentDirPath . '/*', GLOB_ONLYDIR);
    // Listar archivos .docx
    $files = glob($currentDirPath . '/*.docx');

    // Mostrar la ruta actual
    $pathParts = explode('/', trim($currentDir, '/'));
    $pathDisplay = '<span class="breadcrumb"><a href="#">Inicio</a>';
    $currentPath = '';
    foreach ($pathParts as $part) {
        $currentPath .= '/' . $part;
        $pathDisplay .= ' > <a href="#' . urlencode($currentPath) . '">' . htmlspecialchars($part) . '</a>';
    }
    $pathDisplay .= '</span>';
    echo $pathDisplay;

    // Mostrar carpetas
    if (count($folders) > 0) {
        foreach ($folders as $folder) {
            $folderName = basename($folder);
            echo '<div class="folder" onclick="updateFolderDisplay(\'' . htmlspecialchars($currentDir . '/' . $folderName) . '\')">';
            echo '<span>📁 ' . htmlspecialchars($folderName) . '</span>';
            echo '</div>';
        }
    }

    // Mostrar archivos .docx
    if (count($files) > 0) {
        foreach ($files as $file) {
            $filename = basename($file);
            echo '<a href="Historialclinico/' . htmlspecialchars($currentDir . '/' . $filename) . '" download class="file">';
            echo '<span><img src="word-icon.png" alt="Word Icon"> ' . htmlspecialchars($filename) . '</span>';
            echo '</a>';
        }
    }
}

// Llamada a la función para renderizar el contenido
renderFolderContent($baseDirectory, $path);
?>




