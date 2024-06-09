window.addEventListener("resize",()=>{
    window.location.reload();
});


function type(type) {

    document.getElementById("1").classList.remove("active");
    document.getElementById("2").classList.remove("active");
    document.getElementById("3").classList.remove("active");
    document.getElementById("4").classList.remove("active");

    document.getElementById(type).classList.add("active");

    var form = new FormData();
    form.append("type", type);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            document.getElementById("foodContainer").innerHTML = request.responseText;
        }
    }
    request.open("POST", "food.php", true);
    request.send(form);

}