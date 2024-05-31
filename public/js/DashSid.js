// document.addEventListener('DOMContentLoaded', () => {
//     const sidebar = document.getElementById("sidebar");
//     const icon = document.getElementById("i");

//     // Function to close sidebar when window width is less than 990px
//     function closeSidebar() {
//         if (window.innerWidth < 990) {
//             sidebar.style.transform = "translateX(100%)";
//             icon.addEventListener("click", toggleSidebar);
//         } else {
//             sidebar.style.transform = "translateX(0)";
//             icon.removeEventListener("click", toggleSidebar);
//         }
//     }

//     // Close sidebar initially if window width is less than 990px
//     closeSidebar();

//     // Add event listener to close sidebar when window width changes
//     window.addEventListener('resize', closeSidebar);
// });


function openSidebar() {
    const sidebar = document.getElementById("sidebar");

    // Always open the sidebar
    sidebar.style.transform = "translateX(0)";
    sidebar.style.marginRight = "0px";
}

function closeSidebar() {
    const sidebar = document.getElementById("sidebar");

    if (sidebar) {
        sidebar.style.transform = "translateX(100%)";
        sidebar.style.marginRight = "0";
    }
}

function handleResize() {
    const windowWidth = window.innerWidth;
    const sidebar = document.getElementById("sidebar");

    if (windowWidth <= 990) {
        closeSidebar();
    } else {
        openSidebar();
    }
}

// Call handleResize function when the page loads
window.addEventListener('DOMContentLoaded', handleResize);

// Add event listener for window resize event
window.addEventListener('resize', handleResize);

// Toggle sidebar function
function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");
    const sidebarTransform = sidebar.style.transform;

    if (sidebarTransform === "translateX(100%)" || sidebarTransform === "") {
        openSidebar();
    } else {
        closeSidebar();
    }
}

// Event listener to close sidebar when clicking outside
document.addEventListener('click', function(event) {
    const sidebar = document.getElementById("sidebar");
    const openBtn = document.querySelector('.open-btn');

    if (window.innerWidth <= 990 && sidebar && !sidebar.contains(event.target) && event.target !== openBtn) {
        closeSidebar();
    }
});
