
function toast(msg, color) {

    var toastLiveExample = document.getElementById('liveToastA');
    var toast = new bootstrap.Toast(toastLiveExample);

    var now = new Date();
    var time = now.getHours() + " " + now.getMinutes();

    document.getElementById("timeA").innerHTML = "At " + time;
    document.getElementById("msgA").innerHTML = msg;
    document.getElementById("headerColorA").classList.add(color);

    toast.show();

    msg = null;
    color = null;
}