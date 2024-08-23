function openModal(nombre, goles, equipo, foto) {
    document.getElementById('editNombreExistente').value = nombre;
    document.getElementById('editNombre').value = nombre;
    document.getElementById('editGoles').value = goles;
    document.getElementById('editEquipo').value = equipo;
    if (foto) {
        document.getElementById('editProfileDisplay').src = foto;
    } else {
        document.getElementById('editProfileDisplay').src = '../img/user-predeterminado.png';
    }
    document.getElementById('editModal').style.display = "block";
}

document.querySelectorAll('.modal-close').forEach(el => {
    el.addEventListener('click', () => {
        document.getElementById('editModal').style.display = "none";
    });
});

window.onclick = function(event) {
    if (event.target == document.getElementById('editModal')) {
        document.getElementById('editModal').style.display = "none";
    }
}

function displayEditImage(input) {
    var reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('editProfileDisplay').src = e.target.result;
    }
    reader.readAsDataURL(input.files[0]);
}