function openFullscreen() {
    var imageContainer = document.getElementById('imageContainer');
    imageContainer.style.display = 'block';
    document.body.style.overflow = 'hidden'; // Disable scrolling
}

function closeFullscreen() {
    var imageContainer = document.getElementById('imageContainer');
    imageContainer.style.display = 'none';
    document.body.style.overflow = ''; // Enable scrolling
}
