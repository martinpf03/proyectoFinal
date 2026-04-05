// Obtener elementos
const menuIcon = document.getElementById("menu-icon");
const menuLateral = document.getElementById("menu-lateral");

// Agregar evento de clic para abrir/cerrar el menú
menuIcon.addEventListener("click", () => {
    menuLateral.classList.toggle("open");
});

menuLateral.addEventListener("mouseleave", () => {
    menuLateral.classList.remove("open");
});