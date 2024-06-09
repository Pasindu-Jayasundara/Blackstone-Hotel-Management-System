window.addEventListener("load", () => {
    loadGrowthImage();
});

function loadGrowthImage() {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        document.getElementById("gic").innerHTML = request.responseText;

        setTimeout(() => {
            loadGrowthImage();
        }, 10000);
    };
    request.open("POST", "loadGrowthImage.php", true);
    request.send();
}