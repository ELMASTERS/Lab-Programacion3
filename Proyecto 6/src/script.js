document.addEventListener("DOMContentLoaded", function() {
    fetch('menu.json')
        .then(response => response.json())
        .then(data => renderMenu(data));

    document.getElementById('menuForm').addEventListener('submit', function(event) {
        event.preventDefault();
        addMenuOption();
    });
});

function renderMenu(data) {
    const menu = document.getElementById('menu');
    menu.innerHTML = '';
    data.menu.forEach(option => {
        const menuItem = document.createElement('a');
        menuItem.href = option.enlace;
        menuItem.textContent = option.nombre;menu
        menu.appendChild(menuItem);
    });
}

function addMenuOption() {
    const nombre = document.getElementById('nombre').value;
    const enlace = document.getElementById('enlace').value;

    // Añadir la nueva opción de menú a la vista
    const menu = document.getElementById('menu');
    const newMenuItem = document.createElement('a');
    newMenuItem.href = enlace;
    newMenuItem.textContent = nombre;
    menu.appendChild(newMenuItem);

    // Obtener el contenido actual del JSON y actualizarlo
    fetch('menu.json')
        .then(response => response.json())
        .then(data => {
            const newId = data.menu.length ? data.menu[data.menu.length - 1].id + 1 : 1;
            const newOption = { id: newId, nombre: nombre, enlace: enlace };
            data.menu.push(newOption);
            return fetch('update_menu6.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            });
        })
        .then(response => response.json())
        .then(updatedData => {
            if (updatedData.status === 'success') {
                console.log('Menu updated successfully');
                // Limpiar los campos del formulario
                document.getElementById('nombre').value = '';
                document.getElementById('enlace').value = '';
            } else {
                console.error('Error:', updatedData.message);
            }
        })
        .catch(error => console.error('Error:', error));
}
