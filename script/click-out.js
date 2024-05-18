document.addEventListener('click', function(event) {
    var ul = document.querySelector('nav ul');
    var checkbtn = document.querySelector('.checkbtn');
    var checkbox = document.getElementById('check');

    // Si el clic ocurre fuera del menú o del botón y el menú está mostrado
    if (!ul.contains(event.target) && event.target !== checkbtn && event.target !== checkbox && checkbox.checked) {
        checkbox.checked = false; // Oculta el menú marcando el checkbox
    }
});