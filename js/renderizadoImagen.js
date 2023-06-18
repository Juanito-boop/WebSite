document.getElementById('imageInput').addEventListener('change', function (event) {
    var file = event.target.files[0];
    var reader = new FileReader();

    reader.onload = function ({ target: { result } }) {
        document.getElementById('imagePreview').setAttribute('src', result);
    }

    reader.readAsDataURL(file);
});