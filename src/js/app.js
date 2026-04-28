document.addEventListener ('DOMContentLoaded', function() {

    eventListeners();

    darkMode();

    borrarAlerta();
});

function darkMode() {
    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
    
    if (prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    }
    
    prefiereDarkMode.addEventListener('change', function() {
        if (prefiereDarkMode.matches) {
        document.body.classList.add('dark-mode');
        } else {
        document.body.classList.remove('dark-mode');
        }
    });

    const botonDarkMode = document.querySelector('.dark-mode-boton');
    botonDarkMode.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
    });
}


function eventListeners() {
    const mobilMenu = document.querySelector('.mobile-menu');

    mobilMenu.addEventListener('click', navegacionResponsive);

    // Muestra campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach(input=>input.addEventListener('click', mostrarMetodoContacto))

    console.log(metodoContacto);
}

function navegacionResponsive() {
    const navegacion = document.querySelector('.navegacion');

    navegacion.classList.toggle('mostrar')
}

function mostrarMetodoContacto(e) { // e correspondiente a "event"
    const contactoDiv = document.querySelector('#contacto'); /* Usamos "#" para señalara un id existente */

    if (e.target.value === 'telefono') {
        contactoDiv.innerHTML = `
            <label for="telefono"></label>
            <input type="tel" placeholder="Número de Contacto de la forma +598 91000000" id="celular" name="contacto[telefono]" required>

            <p>Elija la fecha y la hora para ser contactado</p>

            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="contacto[fecha]">

            <label for="hora">Hora:</label>
            <input type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]"><!-- min y max establece el rango que se puede seleccionar -->
        `;
    } else {
        contactoDiv.innerHTML = `
            <label for="email"></label>
            <input type="email" placeholder="Déjanos tú E-mail: (ejemplo; correo@correo.com)" id="email" name="contacto[email]" required>
        `;
    }
}

function borrarAlerta() {
    // 1. Verificamos si estamos en la página del admin. Si no existe el elemento con ID 'admin-page', la función termina aquí
    if (!document.getElementById('admin-page')) {
        return;
    }

    // 2. Si estamos en el admin, buscamos la alerta
    const alerta = document.querySelector('.alerta');

    // 3. Eliminamos solo si existe
    if (alerta) {
        setTimeout(() => {
            alerta.remove();
        }, 5000);
    }
}