function logout() {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            window.location.reload();
        }
    };

    request.open("POST", "logout.php", true);
    request.send();
}

// side bar

window.addEventListener("load", navBar);

function navBar() {
    var path = window.location.pathname;
    var page = path.split("/").pop();

    if (page == "dashboard.php") {
        document.getElementById("dashboard").classList.add("active");
    } else if (page == "update.php") {
        document.getElementById("content").classList.add("active");
    } else if (page == "message.php") {
        document.getElementById("users").classList.add("active");
    }else if (page == "settings.php") {
        document.getElementById("setting").classList.add("active");
    }else if (page == "help.php") {
        document.getElementById("help").classList.add("active");
    }else if (page == "booking.php") {
        document.getElementById("booking").classList.add("active");
    }else if (page == "home.php") {
        document.getElementById("home").classList.add("active");
    }
}

function toast(msg, color) {

    var toastLiveExample = document.getElementById('liveToast');
    var toast = new bootstrap.Toast(toastLiveExample);

    var now = new Date();
    var time = now.getHours() + " " + now.getMinutes();

    document.getElementById("time").innerHTML = "At " + time;
    document.getElementById("msg").innerHTML = msg;
    document.getElementById("headerColor").classList.add(color);

    toast.show();

    msg=null;
    color=null;

}

function logOut() {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            window.location.reload();
        }
    };

    request.open("POST", "logout.php", true);
    request.send();
}
