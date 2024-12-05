window.onload = function() {
    document.querySelectorAll('.menu-item').forEach(item => {
        item.addEventListener('click', function() {
            this.classList.toggle('active');

            // Fecha outros submenus se um estiver ativo
            document.querySelectorAll('.menu-item').forEach(otherItem => {
                if (otherItem !== this) {
                    otherItem.classList.remove('active');
                }
            });
        });
    });

    const Logo = document.getElementById('Logo'),
        Theme = document.getElementById('Theme'),
        perfilIcon = document.getElementById("Perfil"),
        submenuPerfil = document.getElementById("submenu-perfil");

    Logo.addEventListener('click', function() {
        window.location.reload();
    });

    if (Theme) {
        Theme.addEventListener("click", function() {
            document.querySelector('.sidebar').classList.toggle("light-mode");
        });
    }

    // Alterna a visibilidade do submenu
    perfilIcon.addEventListener("mouseenter", function() {
        submenuPerfil.style.display = submenuPerfil.style.display === "none" || submenuPerfil.style.display === "" ? "block" : "none";
    });

    // Fecha o submenu
    document.addEventListener("mouseleave", function(event) {
        if (!perfilIcon.contains(event.target) && !submenuPerfil.contains(event.target)) {
            submenuPerfil.style.display = "none";
        }
    });
}