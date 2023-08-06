

    function toggleContacto() {
        var contactoDiv = document.querySelector('.contacto');
        var toggleButton = document.getElementById('toggleButton');

        if (contactoDiv.style.display === 'none') {
            contactoDiv.style.display = 'block';
            toggleButton.textContent = 'Nascondere dati';
        } else {
            contactoDiv.style.display = 'none';
            toggleButton.textContent = 'Mostrare dati';
        }
    }
    document.getElementById('toggleButton').addEventListener('click', toggleContacto);
   
