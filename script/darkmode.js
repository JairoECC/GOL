// // Obtener el botón de alternancia del modo oscuro y el icono
 const darkModeToggle = document.getElementById('darkModeToggle');
 const icon = document.getElementById('darkModeIcon');

 // Función para alternar el modo oscuro
 function toggleDarkMode() {
     document.body.classList.toggle('dark-mode'); // Alternar la clase dark-mode en el body

     // Guardar el estado actual del modo oscuro en localStorage
     const isDarkMode = document.body.classList.contains('dark-mode');
     localStorage.setItem('darkMode', isDarkMode);
    
     // Actualizar el icono según el estado del modo oscuro
     if (isDarkMode) {
         icon.classList.remove('fa-sun');
         icon.classList.add('fa-moon');
     } else {
         icon.classList.remove('fa-moon');
         icon.classList.add('fa-sun');
     }
 }

 // Listener para el botón de alternancia del modo oscuro
 darkModeToggle.addEventListener('click', toggleDarkMode);

 // Verificar y aplicar el modo oscuro almacenado al cargar la página
 document.addEventListener('DOMContentLoaded', () => {
     const isDarkMode = localStorage.getItem('darkMode') === 'true';

     // Aplicar la clase dark-mode si corresponde
     if (isDarkMode) {
         document.body.classList.add('dark-mode');
         icon.classList.remove('fa-sun');
         icon.classList.add('fa-moon');
     } else {
         document.body.classList.remove('dark-mode');
         icon.classList.remove('fa-moon');
         icon.classList.add('fa-sun');
     }
 });
