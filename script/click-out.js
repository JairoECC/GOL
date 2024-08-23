document.addEventListener('click', function(event) {
    var ul = document.querySelector('nav ul');
    var checkbtn = document.querySelector('.checkbtn');
    var checkbox = document.getElementById('check');
    var closer = document.querySelector('.closer');

    // Si el clic ocurre fuera del menú o del botón y el menú está mostrado
    if (!ul.contains(event.target) && event.target !== checkbtn && event.target !== checkbox && checkbox.checked) {
        checkbox.checked = false; // Oculta el menú marcando el checkbox
    }

    // Si el clic ocurre en el span con clase 'closer', cierra el menú
    if (event.target === closer) {
        checkbox.checked = false; // Oculta el menú marcando el checkbox
    }
});
