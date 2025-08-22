document.addEventListener('DOMContentLoaded', function() {
    eventosDocumento();
    darkMode();
});

function darkMode() {
    const preferenciasDelUsusario = window.matchMedia('(prefers-color-scheme: dark)');
    if(preferenciasDelUsusario.matches) {
        document.body.classList.add('dark-mode');
    } else {
        document.body.classList.remove('dark-mode');
    };
    preferenciasDelUsusario.addEventListener('change', function() {
        if(preferenciasDelUsusario.matches) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        };
    });

    const botonDarkMode = document.querySelector('.dark-mode-boton');
    botonDarkMode.addEventListener('click', function() {
        document.body.classList.toggle('dark-mode');
    });
};

function eventosDocumento() {
    const movilMenu = document.querySelector('.movil-menu');
    movilMenu.addEventListener('click', navegacionMovil);
    // Campos condicionales
    const metodoContacto = document.querySelectorAll('input[name="contacto[contacto]"]');
    metodoContacto.forEach(element => element.addEventListener('click', metodoContactoM));
};

function navegacionMovil() {
    const navegacion = document.querySelector('.nav');
    if(navegacion.classList.contains('mostrar')) {
        navegacion.classList.remove('mostrar');
    } else {
        navegacion.classList.add('mostrar');
    };
};

function metodoContactoM(e) {
    console.log();
    const contactoDiv = document.querySelector('#contacto');
    if(e.target.value === 'telefono') {
        contactoDiv.innerHTML = `
            <label for="telefono">Numero de teléfono</label>
            <input type="tel" id="telefono" name="contacto[telefono]" placeholder="Tu Teléfono">
            <p>Elija la fecha y la hora para la llamada</p>
            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="contacto[fecha]">
            <label for="hora">Hora</label>
            <input type="time" id="hora" name="contacto[hora]" min="09:00" max="18:00">
        `;
    } else {
        contactoDiv.innerHTML = `
            <p>Escriba su e-mail</p>
            <label for="email">E-mail</label>
            <input type="email" id="email" name="contacto[email]" placeholder="Tu E-mail" require>
        `;
    }
}