function previewFile() {
    const preview = document.getElementById('previewImage');
    const file = document.getElementById('profileImage').files[0];
    const reader = new FileReader();

    reader.addEventListener("load", function () {
        preview.src = reader.result;
    }, false);

    if (file) {
        reader.readAsDataURL(file);
    }
}