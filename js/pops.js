// When the page loads, show the popup and overlay
$(document).ready(function () {
    $("#overlay, #popup").fadeIn(1000); // Fade in the overlay and popup
});

// Close the popup and overlay when the close button is clicked
$("#close").on("click", function (e) {
    e.preventDefault();
    $("#overlay, #popup").fadeOut(1000); // Fade out the overlay and popup
});

// Close the popup and overlay when clicking outside of the popup
$("#overlay").on("click", function () {
    $("#overlay, #popup").fadeOut(1000); // Fade out the overlay and popup
});
