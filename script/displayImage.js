function displayImage(input) {
    var file = input.files[0];
    var reader = new FileReader();
    reader.onload = function(e) {
        document.getElementById('profileDisplay').src = e.target.result;
    }
    reader.readAsDataURL(file);
}