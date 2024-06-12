var startTime = performance.now(); 

function hideLoader() {
    var loader = document.getElementById('loader-wrapper');
    loader.style.display = 'none';
    document.body.style.overflow = 'auto';
}

window.addEventListener('load', function() {
    var endTime = performance.now();
    var loadTime = endTime - startTime;
    var delay = Math.max(1500 - loadTime, 0);

    setTimeout(function() {
        hideLoader();
    }, delay);
});

setTimeout(function() {
    hideLoader();
}, 1000);
