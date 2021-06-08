if (window.location.pathname === '/product-form') {
    // create image preview
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('image-preview');

    imageInput.addEventListener('change', e => {
        const [file] = e.target.files;
        if (file) imagePreview.src = URL.createObjectURL(file);
    });
}

const { image, description } = retrievedPost;
// extract filename from url
const fileName = image.split('/').pop();
// fetch image file and set state
fetch(image)
    .then(response => response.blob())
    .then(file => {
        const imageFile = new File([file], fileName);
        this.setState({imageFile: imageFile, imageUrl: image, description: description})
    });