document.getElementById('vehicleForm').addEventListener('submit', function (event) {
    const image = document.getElementById('image').files[0];
    if (!image || image.size > 2 * 1024 * 1024) { // Restrict file size to 2MB
        alert('Please select an image under 2MB.');
        event.preventDefault();
    }
});
