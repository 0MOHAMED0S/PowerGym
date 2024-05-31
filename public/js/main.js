// Smooth scroll
// document.querySelectorAll('a[href^="#"]').forEach(anchor => {
//     anchor.addEventListener('click', function(e) {
//         e.preventDefault();

//         document.querySelector(this.getAttribute('href')).scrollIntoView({
//             behavior: 'smooth'
//         });
//     });
// });
// Smooth scroll and add 'active' class to the link in sidebar

document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();

        const target = document.querySelector(this.getAttribute('href'));
        const targetPosition = target.getBoundingClientRect().top + window.scrollY;
        const startPosition = window.scrollY;
        const distance = targetPosition - startPosition;
        const duration = 1000; // Adjust duration as needed
        const startTime = performance.now(); // Record start time

        function step(currentTime) {
            const elapsedTime = currentTime - startTime;
            const easing = easeInOutCubic(Math.min(elapsedTime / duration, 1)); // Calculate easing
            window.scrollTo(0, startPosition + distance * easing);

            if (elapsedTime < duration) {
                window.requestAnimationFrame(step);
            } else {
                window.scrollTo(0, targetPosition); // Snap to target position
            }
        }

        window.requestAnimationFrame(step);
        // Remove 'active' class from all links
        document.querySelectorAll('a[href^="#"]').forEach(link => {
            link.classList.remove('active');
        });

        // Add 'active' class to the clicked link
        this.classList.add('active');
    });
});

function easeInOutCubic(t) {
    // cubic-bezier(0.645, 0.045, 0.355, 1)
    return t < 0.5 ? 4 * t * t * t : (t - 1) * (2 * t - 2) * (2 * t - 2) + 1;
}
