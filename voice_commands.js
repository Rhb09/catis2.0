// Inicializa el reconocimiento de voz
const recognition = new webkitSpeechRecognition() || new SpeechRecognition();
recognition.continuous = true;
recognition.interimResults = true;

// Variables de estado
let isListening = false;

// Funciones para saludar y despedirse
function greetUser() {
    const msg = new SpeechSynthesisUtterance('Hola, ¿en qué puedo ayudarte hoy?');
    window.speechSynthesis.speak(msg);
}

function sayGoodbye() {
    const msg = new SpeechSynthesisUtterance('Adiós, que tengas un buen día.');
    window.speechSynthesis.speak(msg);
}

// Función para manejar los comandos de voz
function handleCommand(command) {
    if (command.includes('rellenar') || command.includes('guardar') || command.includes('enviar')) {
        document.querySelector('form').submit();
    } else if (command.startsWith('nombre paciente ')) {
        var value = command.replace('nombre paciente ', '');
        document.getElementById('patient_name').value = value;
    } else if (command.startsWith('documento número ')) {
        var value = command.replace('documento número ', '');
        document.getElementById('document_number').value = value;
    } else if (command.startsWith('tipo documento ')) {
        var value = command.replace('tipo documento ', '');
        document.getElementById('document_type').value = value;
    } else if (command.startsWith('fecha consulta ')) {
        var value = command.replace('fecha consulta ', '');
        document.getElementById('consultation_date').value = value;
    } else if (command.startsWith('comunidad indígena ')) {
        var value = command.replace('comunidad indígena ', '');
        document.getElementById('comunidad_indigena').value = value;
        updatePueblo();
    } else if (command.startsWith('pueblo ')) {
        var value = command.replace('pueblo ', '');
        document.getElementById('pueblo').value = value;
    } else if (command.startsWith('acompañante ')) {
        var value = command.replace('acompañante ', '');
        document.getElementById('accompanying_person').value = value;
    } else if (command.startsWith('parentesco ')) {
        var value = command.replace('parentesco ', '');
        document.getElementById('relationship').value = value;
    } else if (command.startsWith('semanas gestación ')) {
        var value = command.replace('semanas gestación ', '');
        document.getElementById('semanas_gestacion').value = value;
    } else if (command.startsWith('madre años ')) {
        var value = command.replace('madre años ', '');
        document.getElementById('madre_años').value = value;
    } else if (command.startsWith('madre nacionalidad ')) {
        var value = command.replace('madre nacionalidad ', '');
        document.getElementById('madre_nacionalidad').value = value;
    } else if (command === 'ingresar datos al nacer sí') {
        document.getElementById('ingresar_datos_nacer').value = 'sí';
        toggleDatosNacer();
    } else if (command === 'ingresar datos al nacer no') {
        document.getElementById('ingresar_datos_nacer').value = 'no';
        toggleDatosNacer();
    } else if (command.startsWith('talla nacer ')) {
        var value = command.replace('talla nacer ', '');
        document.getElementById('talla_nacer').value = value;
    } else if (command.startsWith('peso nacer ')) {
        var value = command.replace('peso nacer ', '');
        document.getElementById('peso_nacer').value = value;
    } else if (command.startsWith('pc nacer ')) {
        var value = command.replace('pc nacer ', '');
        document.getElementById('pc_nacer').value = value;
    } else if (command.startsWith('pt nacer ')) {
        var value = command.replace('pt nacer ', '');
        document.getElementById('pt_nacer').value = value;
    } else {
        console.log('Comando no reconocido: ' + command); // Cambiado de alert a console.log
    }
}

// Función para activar y desactivar el reconocimiento de voz
function toggleListening() {
    if (isListening) {
        recognition.stop();
        sayGoodbye();
    } else {
        recognition.start();
        greetUser();
    }
    isListening = !isListening;
}

// Maneja los resultados del reconocimiento de voz
recognition.onresult = function(event) {
    var transcript = '';
    for (var i = event.resultIndex; i < event.results.length; i++) {
        transcript += event.results[i][0].transcript;
    }
    handleCommand(transcript.trim().toLowerCase());
};

// Inicializa el reconocimiento de voz
recognition.onstart = function() {
    console.log('Reconocimiento de voz activado');
};

recognition.onend = function() {
    console.log('Reconocimiento de voz desactivado');
};

// Enlaza el botón de activación/desactivación
document.getElementById('toggleButton').addEventListener('click', toggleListening);
