const iconContainer = document.querySelector(".icon");

iconContainer.addEventListener("click", (event) => {
  const target = event.target;
  if (target.matches(".heart") || target.matches(".heart i")) {
    toggleActive(target.closest(".heart"));
    console.log("Heart clicked");
  } else if (target.matches(".cart") || target.matches(".cart i")) {
    toggleActive(target.closest(".cart"));
    console.log("Cart clicked");
  }
});

function toggleActive(element) {
  element.classList.toggle("active");
}
