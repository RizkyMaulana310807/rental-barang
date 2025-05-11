function toggleDropdown() {
    const dropdown = document.getElementById("userDropdown");
    dropdown.classList.toggle("hidden");
}

function toggleMobileMenu() {
    const menu = document.getElementById("mobile-menu");
    menu.classList.toggle("hidden");
}

// Optional: Tutup dropdown jika klik di luar
document.addEventListener("click", function (event) {
    const button = document.getElementById("userButton");
    const dropdown = document.getElementById("userDropdown");

    if (!button.contains(event.target) && !dropdown.contains(event.target)) {
        dropdown.classList.add("hidden");
    }
});
