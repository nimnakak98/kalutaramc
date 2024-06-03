// Get the modal and images
var modal = document.querySelector('.modal');
var modalImg = document.querySelector('.modal-content');
var closeBtn = document.querySelector('.close');
var images = document.querySelectorAll('.images img');

// Add click event listener to each image
images.forEach(function(image) {
    image.addEventListener('click', function() {
        modal.style.display = 'block';
        modalImg.src = this.src;
    });
});

// Close the modal when the close button is clicked
closeBtn.addEventListener('click', function() {
    modal.style.display = 'none';
});

// Close the modal when clicking outside of the modal content
window.addEventListener('click', function(event) {
    if (event.target == modal) {
        modal.style.display = 'none';
    }
});

// Show images for selected topic
document.querySelectorAll('.topic').forEach(function(topic) {
    topic.addEventListener('click', function() {
        var topicName = this.getAttribute('data-topic');
        images.forEach(function(image) {
            if (image.getAttribute('data-topic') === topicName) {
                image.style.display = 'block';
            } else {
                image.style.display = 'none';
            }
        });
    });
});
