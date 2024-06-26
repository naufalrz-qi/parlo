// Toggle class active
const navbarNav = document.querySelector(".navbarC-nav");

// Hamburger menu clicked
document.querySelector("#hamburger-menu").onclick = () => {
    navbarNav.classList.toggle("active");
};

// close when outside clicked
const hamburger = document.querySelector("#hamburger-menu");
document.addEventListener("click", (e) => {
    if (!hamburger.contains(e.target) && !navbarNav.contains(e.target)) {
        navbarNav.classList.remove("active");
    }
});
