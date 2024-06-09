var wm;
window.addEventListener("load", () => {

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;

            if (response == 1) {

                wm = new bootstrap.Modal(document.getElementById("warning"));
                wm.show();

            }

        }
    }
    request.open("POST", "checkSignin.php", true);
    request.send();
});

function signIn() {

    var email = document.getElementById("email");
    var password = document.getElementById("password");

    if (email.value.trim() == '') {

        email.classList.add("border-danger");

    } else if (password.value.trim() == '') {

        email.classList.remove("border-danger");
        password.classList.add("border-danger");

    } else {

        email.classList.remove("border-danger");
        password.classList.remove("border-danger");

        var form = new FormData();
        form.append("email", email.value);
        form.append("password", password.value);

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = request.responseText;

                if (response == 1) {

                    window.location.href = "dashboard.php";

                } else if (response == 2) {

                    new bootstrap.Modal(document.getElementById("deactive")).show();

                } else if (response == 4) {

                    var msg = "Invalid Details";
                    var color = "bg-danger";
                    toast(msg, color);

                } else if (response == 5) {

                    var msg = "Incorrect Email Format";
                    var color = "bg-warning";
                    toast(msg, color);

                } else if (response == 6) {

                    var msg = "Provide Nessasary Details";
                    var color = "bg-warning";
                    toast(msg, color);

                } else {
                    alert(response);
                }

            }
        }
        request.open("POST", "signin.php", true);
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

function showPassword() {

    var pF = document.getElementById("password").getAttribute("type");
    if (pF == "text") {
        document.getElementById("password").setAttribute("type", "password");
    } else if (pF == "password") {
        document.getElementById("password").setAttribute("type", "text");
    }

}


function logOut() {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            wm.hide();
            window.location.reload();
        }
    };

    request.open("POST", "logout.php", true);
    request.send();
}


// // forgot password

var fp_bModel;

function forgotPasswordModel() {
    var fp_model = document.getElementById("forgotPasswordEmailModel");
    fp_bModel = new bootstrap.Modal(fp_model);
    fp_bModel.show();
}

var b_f_p_e_v_model;

function verifyForgotPasswordEmail() {
    var forgot_password_email = document.getElementById("forgot_password_email").value;

    fp_bModel.hide();

    var como = new bootstrap.Modal(document.getElementById("comoid"));
    como.show();

    var f_p_e_v_model = document.getElementById("forgotPasswordEmailVerificationModel");
    b_f_p_e_v_model = new bootstrap.Modal(f_p_e_v_model);

    var form = new FormData();
    form.append("forgot_password_email", forgot_password_email);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {

            var response = request.responseText;
            como.hide();


            if (response == "1") {
                alert("Invalid Details");
            } else if (response == "2") {
                alert("Something Went Wrong");
                window.location.reload();
            } else if (response == "3") {
                alert("Please Fill The Details");
            } else if (response == "5") {
                b_f_p_e_v_model.show();

                alert("Check your Email for Verification Code");
            }

        }
    };

    request.open("POST", "verifyForgotPasswordEmail.php", true);
    request.send(form);

}

var b_newPasswordModel;

function forgotPasswordEmailVerfication() {
    var forgotPasswordEmailVerificationCode = document.getElementById("forgotPasswordEmailVerificationCode").value;

    b_f_p_e_v_model.hide();

    var newPasswordModel = document.getElementById("newPasswordModel");
    b_newPasswordModel = new bootstrap.Modal(newPasswordModel);


    var form = new FormData();
    form.append("forgotPasswordEmailVerificationCode", forgotPasswordEmailVerificationCode);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {

            var response = request.responseText;

            if (response == "3") {
                alert("Please Fill The Details");
            } else if (response == "success") {
                b_newPasswordModel.show();
            } else {
                alert(response);
            }

        }
    };

    request.open("POST", "verifyForgotPasswordEmailCode.php", true);
    request.send(form);

}

function updateForgotPassword() {

    var forgotPasswordNewPassword = document.getElementById("forgotPasswordNewPassword").value;

    b_newPasswordModel.hide();

    var form = new FormData();
    form.append("forgotPasswordNewPassword", forgotPasswordNewPassword);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {

            if (request.responseText == "1") {
                var msg = "Password Reset Success";
                var color = "bg-success";
                toast(msg, color);

                setTimeout(() => {
                    window.location.reload();
                }, 800);
            } else {
                alert(request.responseText);
            }
        }
    };

    request.open("POST", "updateForgotPassword.php", true);
    request.send(form);
}