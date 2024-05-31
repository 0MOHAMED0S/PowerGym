var startTime = performance.now(); // Get the time when the page started loading

// Function to hide the loader and re-enable scrolling
function hideLoader() {
    var loader = document.getElementById('loader-wrapper');
    loader.style.display = 'none';
    document.body.style.overflow = 'auto'; // Re-enable scrolling
}

// Event listener for window load event
window.addEventListener('load', function() {
    var endTime = performance.now(); // Get the time when the page finished loading
    var loadTime = endTime - startTime; // Calculate the time taken to load the page
    var delay = Math.max(1500 - loadTime, 0); // Calculate the delay to ensure it's at least 1 second

    setTimeout(function() {
        hideLoader();
    }, delay);
});

// Call hideLoader function after 1 second regardless of page load speed
setTimeout(function() {
    hideLoader();
}, 1000);
