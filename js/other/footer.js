if (window.innerWidth < 992) {

    document.getElementById("news").classList.remove("ms-3");

}

function addToNewsletter() {

    var email = document.getElementById("n_email").value;
    if (email.trim() == '') {
        var msg = "Insert Your Email Address";
        var color = "bg-warning";
        toast(msg, color);
    } else {
        var form = new FormData();
        form.append("email", email);

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {

            if (request.readyState == 4 && request.status == 200) {
                var response = request.responseText;
                if (response == 1) {
                    var msg = "Insert Your Email Address";
                    var color = "bg-warning";
                    toast(msg, color);
                } else if (response == 2) {
                    var msg = "Email Sending Faild";
                    var color = "bg-warning";
                    toast(msg, color);
                } else if (response == 3) {
                    var msg = "Email Adding Successful";
                    var color = "bg-success";
                    toast(msg, color);
                } else if (response == 4) {
                    var msg = "Invalid Email Address";
                    var color = "bg-danger";
                    toast(msg, color);
                } else {
                    alert(response);
                }

                setTimeout(() => {

                    window.location.reload();
                    
                }, 900);
            }

        }
        request.open("POST", "addToNewsletter.php", true);
        request.send(form);
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

    msg = null;
    color = null;
}