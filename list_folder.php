<?php
header('Content-Type: application/json');

$folderPath = $_GET['folder'] ?? '.';

function getFolderContents($path) {
    $contents = [];
    $folders = glob($path . '/*', GLOB_ONLYDIR);
    $files = glob($path . '/*.docx');

    foreach ($folders as $folder) {
        $folderName = basename($folder);
        $folderPath = str_replace(__DIR__ . '/', '', $folder); // Ruta relativa
        $contents[] = [
            'type' => 'folder',
            'id' => preg_replace('/[^a-zA-Z0-9_]/', '_', $folder),
            'name' => $folderName,
            'path' => $folderPath
        ];
    }

    foreach ($files as $file) {
        $fileName = basename($file);
        $filePath = str_replace(__DIR__ . '/', '', $file); // Ruta relativa
        $contents[] = [
            'type' => 'file',
            'name' => $fileName,
            'url' => $filePath
        ];
    }

    return $contents;
}

echo json_encode(getFolderContents($folderPath));
?>
<?php
$baseDirectory = __DIR__;
$path = isset($_GET['path']) ? $_GET['path'] : '';

function renderFolderContent($baseDirectory, $currentDir) {
    $currentDirPath = $baseDirectory . '/' . $currentDir;
    $folders = glob($currentDirPath . '/*', GLOB_ONLYDIR);
    $files = glob($currentDirPath . '/resultado_*.docx');

    if (count($folders) > 0) {
        foreach ($folders as $folder) {
            $folderName = basename($folder);
            echo '<div class="folder" data-folder="' . $currentDir . '/' . $folderName . '">';
            echo '<span>📁 ' . $folderName . '</span>';
            echo '</div>'; // Cierre de folder
        }
    }

    if (count($files) > 0) {
        foreach ($files as $file) {
            $filename = basename($file);
            echo '<a href="' . $currentDir . '/' . $filename . '" download class="file">';
            echo '<span><img src="word-icon.png" alt="Word Icon"> ' . $filename . '</span>';
            echo '</a>';
        }
    } else {
        echo '<p>No hay archivos generados.</p>';
    }
}

if (is_dir($baseDirectory . '/' . $path)) {
    renderFolderContent($baseDirectory, $path);
} else {
    echo '<p>No se encontró la carpeta.</p>';
}
?>