<script src="<?php echo $sourcePath; ?>/public/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo $sourcePath; ?>/public/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo $sourcePath; ?>/public/dist/js/adminlte.js"></script>

<script>
    function defaultColorTheme() {
        try {
            const bodyElement = document.getElementById("body-theme");
            const navElement = document.getElementById("nav-theme");
            const asideElement = document.getElementById("aside-theme");
            const iconElement = document.getElementById("icon-theme");
            const textElement = document.getElementById("text-theme");

            if (localStorage.colorThemeType == "light") {
                bodyElement.classList.remove("dark-mode");
                bodyElement.classList.add("light-mode");

                navElement.classList.remove("navbar-dark");
                navElement.classList.add("navbar-light");

                asideElement.classList.remove("sidebar-dark-primary");
                asideElement.classList.add("sidebar-light-primary");

                iconElement.classList.remove("fa-moon");
                iconElement.classList.add("fa-sun");

                textElement.innerHTML = "Tema Terang";
            } else if (localStorage.colorThemeType == "dark") {
                bodyElement.classList.remove("light-mode");
                bodyElement.classList.add("dark-mode");

                navElement.classList.remove("navbar-light");
                navElement.classList.add("navbar-dark");

                asideElement.classList.remove("sidebar-light-primary");
                asideElement.classList.add("sidebar-dark-primary");

                iconElement.classList.remove("fa-sun");
                iconElement.classList.add("fa-moon");

                textElement.innerHTML = "Tema Gelap";
            };
        } catch (err) {};
    };

    function changeColorTheme() {
        const bodyElement = document.getElementById("body-theme");
        const navElement = document.getElementById("nav-theme");
        const asideElement = document.getElementById("aside-theme");
        const iconElement = document.getElementById("icon-theme");
        const textElement = document.getElementById("text-theme");

        if (localStorage.colorThemeType == "light") {
            bodyElement.classList.remove("light-mode");
            bodyElement.classList.add("dark-mode");

            navElement.classList.remove("navbar-light");
            navElement.classList.add("navbar-dark");

            asideElement.classList.remove("sidebar-light-primary");
            asideElement.classList.add("sidebar-dark-primary");

            iconElement.classList.remove("fa-sun");
            iconElement.classList.add("fa-moon");

            textElement.innerHTML = "Tema Gelap";

            localStorage.colorThemeType = "dark";
        } else if (localStorage.colorThemeType == "dark") {
            bodyElement.classList.remove("dark-mode");
            bodyElement.classList.add("light-mode");

            navElement.classList.remove("navbar-dark");
            navElement.classList.add("navbar-light");

            asideElement.classList.remove("sidebar-dark-primary");
            asideElement.classList.add("sidebar-light-primary");

            iconElement.classList.remove("fa-moon");
            iconElement.classList.add("fa-sun");

            textElement.innerHTML = "Tema Terang";

            localStorage.colorThemeType = "light";
        };
    };

    if (!localStorage.colorThemeType) {
        localStorage.colorThemeType = "light";
    };

    defaultColorTheme();
</script>