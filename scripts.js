if (window.location.pathname === '/product-form') {
    // create image preview
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('image-preview');

    imageInput.addEventListener('change', e => {
        const [file] = e.target.files;
        if (file) {
            imagePreview.classList.remove('d-none');
            imagePreview.src = URL.createObjectURL(file);
        }
    });
}
