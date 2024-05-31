const sliderTl = document.querySelector(".sli-list"),
  firstSlider = sliderTl.querySelectorAll(".item-card")[0];

let isSragStart = false,
  timeOutId,
  prevPageX,
  prevScrollLeft,
  diffX;
let firstSliderWidth = firstSlider.clientWidth;
let scrollWidth = sliderTl.scrollWidth - sliderTl.offsetWidth;

const DragStart = (e) => {
  // updatating global variables value on mouse down event
  prevPageX = e.pageX;
  prevScrollLeft = sliderTl.scrollLeft;
  isSragStart = true;
};

const Dragging = (e) => {
  // scrolling images/carousel to left according to mouse pointer
  if (!isSragStart) return;
  e.preventDefault();
  sliderTl.classList.add("Dragging");
  // getting the difference of x coordinates between current and previous page X
  diffX = e.pageX - prevPageX;
  sliderTl.scrollLeft = prevScrollLeft - diffX;
};
const DragStop = () => {
  isSragStart = false;
  sliderTl.classList.remove("Dragging");
  showHideIcon();
};

sliderTl.addEventListener("mousedown", DragStart);
sliderTl.addEventListener("mousemove", Dragging);
sliderTl.addEventListener("mouseup", DragStop);

// previous and next buttons
const nextButton = document.getElementById("next");
const prevButton = document.getElementById("prev");

//Attach click event listener to previous button and next
nextButton.onclick = nextSlide;
prevButton.onclick = prevSlide;

const showHideIcon = () => {
  if (Math.ceil(sliderTl.scrollLeft) === scrollWidth) {
    nextButton.classList.add("disabled");
  } else {
    nextButton.classList.remove("disabled");
  }
  if (sliderTl.scrollLeft == 0) {
    prevButton.classList.add("disabled");
  } else {
    prevButton.classList.remove("disabled");
  }
};
// move to next slide
function nextSlide() {
  // if clicked icon is left, reduce width value from the carousel scroll left else add to it
  sliderTl.scrollLeft += firstSliderWidth;
    setTimeout(() => showHideIcon(), 100);
}
//Move to previous slide
function prevSlide() {
  // if clicked icon is left, reduce width value from the carousel scroll left else add to it
  sliderTl.scrollLeft -= firstSliderWidth;
    setTimeout(() => showHideIcon(), 100);
}
