document.addEventListener("DOMContentLoaded", () => {
    const sidebar = document.getElementById("sidebar");
    const content = document.getElementById("content");
    const toggleBtn = document.querySelector(".toggle-btn");
    const searchInput = document.getElementById("sidebarSearch");

    // Botón hamburguesa
    toggleBtn?.addEventListener("click", () => {
        sidebar.classList.toggle("show");
        content.classList.toggle("collapsed");
    });

    // Submenús
    document.querySelectorAll(".menu-group > button").forEach((button) => {
        button.addEventListener("click", () => {
            const submenu = button.nextElementSibling;
            submenu.style.display =
                submenu.style.display === "flex" ? "none" : "flex";
        });
    });

    // Buscador en tiempo real con ocultación de grupos
    searchInput?.addEventListener("input", function () {
        const filter = this.value.toLowerCase();
        const allGroups = document.querySelectorAll(".menu-group");

        allGroups.forEach((group) => {
            const submenu = group.querySelector(".submenu");
            const links = submenu.querySelectorAll("a");
            let hasMatch = false;

            links.forEach((link) => {
                const text = link.textContent.toLowerCase();
                if (text.includes(filter)) {
                    link.style.display = "flex";
                    hasMatch = true;
                } else {
                    link.style.display = "none";
                }
            });

            if (hasMatch) {
                group.style.display = "block";
                submenu.style.display = "flex";
            } else {
                group.style.display = "none";
            }
        });

        // Enlaces fuera de submenús
        const staticLinks = document.querySelectorAll("#menuItems > a");
        staticLinks.forEach((link) => {
            const text = link.textContent.toLowerCase();
            link.style.display = text.includes(filter) ? "flex" : "none";
        });
    });
});
