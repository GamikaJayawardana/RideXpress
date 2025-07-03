let navbar = document.querySelector(".navbar");
let searchBox = document.querySelector(".search-box");

// Toggle search box
document.querySelector("#search-icon").onclick = () => {
    searchBox.classList.toggle("active");
    navbar.classList.remove("active");
};

// Toggle mobile menu
document.querySelector("#menu-icon").onclick = () => {
    navbar.classList.toggle("active");
    searchBox.classList.remove("active");
};

// Add shadow on scroll
let header = document.querySelector("header");

window.addEventListener('scroll', () => {
    header.classList.toggle("shadow", window.scrollY > 0);
});

// Show login/signup popup
function openPopup(form) {
    document.getElementById("popup-container").style.display = "flex";
    document.getElementById("loginForm").style.display = (form === 'login') ? "block" : "none";
    document.getElementById("signupForm").style.display = (form === 'signup') ? "block" : "none";
    document.body.style.overflow = "hidden"; // prevent background scroll
}

// Close popup
function closePopup() {
    document.getElementById("popup-container").style.display = "none";
    document.body.style.overflow = "auto";
}

// Switch between login and signup forms
function toggleForm(form) {
    document.getElementById("loginForm").style.display = (form === 'login') ? "block" : "none";
    document.getElementById("signupForm").style.display = (form === 'signup') ? "block" : "none";
}
