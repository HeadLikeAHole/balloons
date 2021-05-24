// create image preview
const imageInput = document.getElementById('image');
const imagePreview = document.getElementById('image-preview');

imageInput.addEventListener('change', e => {
    const [file] = e.target.files;
    if (file) imagePreview.src = URL.createObjectURL(file);
});
