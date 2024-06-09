window.addEventListener("load", () => {
if (window.innerWidth >= 768 && window.innerWidth < 992) { //medium

        document.getElementById("con").classList.replace("ps-5", "ps-4");

        const container = document.getElementById("con");
        const cols = container.querySelectorAll("div.col");

        cols.forEach(col => {
            col.style.width = "31vw";
            col.style.marginBottom = "50px";
        });


    } else if (window.innerWidth < 768) { //small

        document.getElementById("con").classList.replace("row", "col");
        document.getElementById("con").classList.replace("ps-5", "ps-4");

        const container = document.getElementById("con");
        const cols = container.querySelectorAll("div.col");

        cols.forEach(col => {
            col.style.width = "90vw";
            col.style.marginBottom = "50px";
        });

    }

});