<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archivos Generados</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Archivos Generados</h1>
    <div class="container">
        <div id="navigation">
            <button id="back-button" style="display:none;">Volver</button>
        </div>
        <div id="content">
            <!-- Aquí se cargará el contenido de las carpetas -->
        </div>
    </div>
    <script>
    let pathStack = [];

    function renderFolderContent(path) {
        const xhr = new XMLHttpRequest();
        xhr.open('GET', `list_folders.php?path=${encodeURIComponent(path)}`, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                document.getElementById('content').innerHTML = xhr.responseText;
                document.getElementById('back-button').style.display = pathStack.length > 0 ? 'inline-block' : 'none';
            }
        };
        xhr.send();
    }

    function navigateTo(path) {
        pathStack.push(path);
        renderFolderContent(path);
    }

    function goBack() {
        if (pathStack.length > 0) {
            pathStack.pop(); // Remove current path
            const previousPath = pathStack[pathStack.length - 1] || ''; // Get previous path
            renderFolderContent(previousPath);
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('back-button').addEventListener('click', goBack);

        document.getElementById('content').addEventListener('click', function(e) {
            const folderElement = e.target.closest('.folder');
            if (folderElement) {
                const folderPath = folderElement.getAttribute('data-folder');
                navigateTo(folderPath);
            }
        });

        // Renderizar carpetas iniciales
        renderFolderContent('');
    });
    </script>
</body>
</html>

