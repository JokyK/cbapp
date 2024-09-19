
    // Script para mostrar/ocultar el submenú con animación
    document.getElementById("libretaNotasLink").addEventListener("click", function() {
        var submenu = document.getElementById("submenuGrados");
        if (submenu.style.maxHeight) {
            submenu.style.maxHeight = null;
            submenu.style.display = "none";
        } else {
            submenu.style.display = "flex";
            submenu.style.maxHeight = submenu.scrollHeight + "px";
        }
    });

    // SCRIPT PARA MOSTRAR LA ANIMACIÓN DEL BOTÓN DEL SIDEBAR
    document.getElementById("menu-toggle").addEventListener("click", function() {
    var wrapper = document.getElementById("wrapper");
    var icon = this.querySelector("i");

    wrapper.classList.toggle("toggled");

    // Añadir o quitar la clase de rotación
    if (wrapper.classList.contains("toggled")) {
        icon.classList.add("rotate");
        icon.classList.remove("rotate-back");
    } else {
        icon.classList.remove("rotate");
        icon.classList.add("rotate-back");
    }
});