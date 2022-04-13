
// credit: https://alvarotrigo.com/blog/css-animations-scroll/ (doc citation later)
// How to Create CSS Animations on Scroll [With Examples]
// by Oscar Jite
function revealOnScroll() {
    var reveal_elements = document.querySelectorAll(".scroll-reveal");
    for (var i = 0; i < reveal_elements.length; i++) {
        // go thru every section
        var element = reveal_elements[i];
        // get the height of the viewport
        var windowHeight = window.innerHeight;
        // get distance from the top of the viewport
        var elementTop = element.getBoundingClientRect().top; // returns the size of an element and its position relative to the viewport
        var elementVisible = 150;
        if (elementTop < windowHeight - elementVisible) {
            element.classList.add("active");
        } else {
            element.classList.remove("active");
        }
    }
}

window.addEventListener("scroll", revealOnScroll);

// check scroll position on page load
revealOnScroll();