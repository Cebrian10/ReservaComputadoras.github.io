document.addEventListener("DOMContentLoaded", function() {
    var alert = document.querySelector('.alerta');
    if (alert) {
        setTimeout(function() {
            alert.style.display = 'none';
        }, 3000);
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const equipos = document.querySelectorAll('.eq img');

    equipos.forEach(function(equipo) {
        equipo.addEventListener('click', function() {
            const equipoId = equipo.id.split('-')[1]; 
            const form = document.createElement('form');
            form.method = 'post';
            form.action = '?op=reserve';
            
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'equipo_id';
            input.value = equipoId;
            
            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        });
    });
    
});

document.addEventListener('DOMContentLoaded', function() {
    let equipos = document.querySelectorAll('.eq');

    equipos.forEach(function(equipo) {
        // Verifica el texto dentro del párrafo para determinar el estado
        if (equipo.querySelector('p').innerText === 'Disponible') {
            equipo.classList.add('available'); //si el equipo esta disponible, añande la clase 'avaible'
            equipo.style.cursor = 'pointer';
        } else {
            equipo.classList.add('occupied');//si no, añade la clase 'occupied'
            equipo.style.disabled = 'true';
            equipo.style.pointerEvents = 'none'; // Si el equipo esta ocupado no es cliqueable
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const salonSelect = document.getElementById('salonSelect');
    const equipos = document.querySelectorAll('.eq');
    const lineas = document.querySelectorAll('.linea');

    salonSelect.addEventListener('change', function () {
        const selectedSalonId = salonSelect.value;

        // Ocultar todas las líneas al principio
        lineas.forEach(linea => {
            linea.style.display = 'none';
        });

        equipos.forEach(equipo => {
            const salonId = equipo.getAttribute('data-salon-id'); // Obtén el valor del atributo personalizado 'data-salon-id'
            if (salonId === selectedSalonId) {
                equipo.style.display = 'flex'; // Mostrar el equipo si coincide

                // Mostrar la línea que contiene el equipo
                const linea = equipo.closest('.linea');
                linea.style.display = 'flex';
            } else {
                equipo.style.display = 'none'; // Ocultar los demás equipos
            }
        });

    });

    // Ocultar todas las computadoras y líneas al principio
    equipos.forEach(equipo => {
        equipo.style.display = 'none';
    });

    lineas.forEach(linea => {
        linea.style.display = 'none';
    });

    // Mostrar las del salón predeterminado (si lo hay)
    const selectedSalonId = salonSelect.value;
    equipos.forEach(equipo => {
        const salonId = equipo.getAttribute('data-salon-id'); // Obtén el valor del atributo personalizado 'data-salon-id'
        if (salonId === selectedSalonId) {
            equipo.style.display = 'flex'; // Mostrar el equipo si coincide

            // Mostrar la línea que contiene el equipo
            const linea = equipo.closest('.linea');
            linea.style.display = 'flex';
        } else {
            equipo.style.display = 'none'; // Ocultar los demás equipos
        }
    });

});