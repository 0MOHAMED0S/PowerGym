function toggleSidebar() {
    const sidebar = document.getElementById("sidebar");

    if (sidebar.style.transform === "translateX(100%)" || sidebar.style.transform === "") {
        sidebar.style.transform = "translateX(0)";
        sidebar.style.marginRight="0px";
        // Add event listener to close sidebar when clicking outside
        document.addEventListener('click', closeSidebarOutside);
    } else {
        closeSidebar();
    }
}

function closeSidebar() {
    const sidebar = document.getElementById("sidebar");

    if (sidebar) {
        sidebar.style.transform = "translateX(100%)";
        sidebar.style.marginRight="0";
        // Remove event listener when sidebar is closed
        document.removeEventListener('click', closeSidebarOutside);
    }
}

function closeSidebarOutside(event) {
    const sidebar = document.getElementById("sidebar");
    const openBtn = document.querySelector('.open-btn');
    // Check if the click is outside the sidebar and not on the open button
    if (sidebar && !sidebar.contains(event.target) && event.target !== openBtn) {
        closeSidebar();
    }
}