window.addEventListener("load", function () {
    let mainMenu = document.getElementById("mainmenu");
    let buttonHamburger = document.getElementById("mobilemenu");
    let buttonBackToTop = document.getElementById("back-to-top");
    let buttonDelete = document.getElementsByClassName("delete");

    window.isMobile = function() {
        let styles = window.getComputedStyle(mobileMenu);

        if (styles.getPropertyValue("display") === "block")
            return true;
        else
            return false;
    };

    window.addEventListener('scroll', function (e) {
        let offset = 60;

        if (document.body.scrollTop > offset || document.documentElement.scrollTop > offset)
            buttonBackToTop.style.display = "block";
        else
            buttonBackToTop.style.display = "none";
    });

    buttonBackToTop.addEventListener("click", function () {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
    });

    buttonHamburger.addEventListener("click", function () {
        this.classList.toggle("open");
        mainMenu.classList.toggle("open");
    });

    for (let i = 0; i < buttonDelete.length; i++) {
        buttonDelete[i].addEventListener("click", function(e) {
            if (!confirm("Biztos, hogy törli?"))
                e.preventDefault();
        });
    }

});