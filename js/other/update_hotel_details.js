document.getElementById("re1").addEventListener("click", () => {
    document.getElementById("logonewW").click();
});

document.getElementById("re2").addEventListener("click", () => {
    document.getElementById("logonewB").click();
});

function loadWhiteLogo() {
    var file = document.getElementById("logonewW").files[0];
    var url = URL.createObjectURL(file);

    document.getElementById("nowlogoW").src = url;
}

function loadBlackLogo() {
    var file = document.getElementById("logonewB").files[0];
    var url = URL.createObjectURL(file);

    document.getElementById("nowlogoB").src = url;
}

function updateHotelDetails() {

    var name = document.getElementById("s_name").value;
    var email = document.getElementById("s_email").value;
    var app_password = document.getElementById("s_app_password").value;
    var mobile = document.getElementById("s_mobile").value;
    var line_1 = document.getElementById("s_line_1").value;
    var line_2 = document.getElementById("s_line_2").value;
    var map_link = document.getElementById("map_link").value;
    var fb_link = document.getElementById("fb_link").value;
    var white_logo = document.getElementById("logonewW");
    var black_logo = document.getElementById("logonewB");

    if (fb_link.trim() == "" && map_link.trim() == "" && name.trim() == "" && email.trim() == "" && line_1.trim() == "" && line_2.trim() == "" && mobile.trim() == "" && app_password.trim()=="") {
        
        var msg = "Fill THe Details";
        var color = "bg-warning";

        toast(msg, color);
    } else {

        var form = new FormData();
        form.append("name", name);
        form.append("email", email);
        form.append("app_password", app_password);
        form.append("mobile", mobile);
        form.append("line_1", line_1);
        form.append("line_2", line_2);
        form.append("map_link", map_link);
        form.append("fb_link", fb_link);

        if (white_logo.files[0] == null) {
            form.append("w_img", '1');
        } else {

            form.append("w_img", '2');
            form.append("w_logo", white_logo.files[0]);
        }

        if (black_logo.files[0] == null) {
            form.append("b_img", '1');
        } else {

            form.append("b_img", '2');
            form.append("b_logo", black_logo.files[0]);
        }

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = request.responseText;

                if (response == 1||response == 11) {
                    var msg = "Update Process Success";
                    var color = "bg-success";

                    toast(msg, color);
                } else if (response == 2) {

                    var msg = "Logo Uploading Faild";
                    var color = "bg-danger";

                    toast(msg, color);

                } else if (response == 3) {
                    var msg = "Invalid Logo File Format";
                    var color = "bg-warning";

                    toast(msg, color);
                } else if (response == 4) {
                    var msg = "In-valid Mobile Number";
                    var color = "bg-warning";

                    toast(msg, color);
                } else if (response == 5) {
                    var msg = "Mobile Number Limit is 10";
                    var color = "bg-warning";

                    toast(msg, color);
                } else if (response == 6) {
                    var msg = "In-valid Email Address";
                    var color = "bg-warning";

                    toast(msg, color);
                } else if (response == 7) {
                    var msg = "Fill The Details";
                    var color = "bg-dark";
                    toast(msg, color);
                }else if (response == 8) {
                    var msg = "App Password and Email Updates Should Happen Simultaneously";
                    var color = "bg-warning";
                    toast(msg, color);
                } else {
                    alert(response);
                }

            }
        }
        request.open("POST", "update_hotel.php", true);
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