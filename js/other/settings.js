document.getElementById("re").addEventListener("click", () => {
    document.getElementById("logonew").click();
});

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


function loadprofileimg() {
    var file = document.getElementById("pimg").files[0];
    var url = URL.createObjectURL(file);

    document.getElementById("pnewimg").style.backgroundImage = "url('" + url + "')";
}


function updateProfile() {

    var f_name = document.getElementById("fproname").value;
    var l_name = document.getElementById("lproname").value;
    var email = document.getElementById("prneemail").value;
    var mobile = document.getElementById("pronemo").value;
    var profile = document.getElementById("pimg");

    if (f_name.trim() == "" && l_name.trim() == "" && email.trim() == "" && mobile.trim() == "") {
        var msg = "Fill THe Details";
        var color = "bg-warning";

        toast(msg, color);
    } else {

        var form = new FormData();
        form.append("f_name", f_name);
        form.append("l_name", l_name);
        form.append("email", email);
        form.append("mobile", mobile);

        if (profile.files[0] == null) {
            form.append("img", '1');
        } else {

            form.append("img", '2');
            form.append("profile", profile.files[0]);
        }

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = request.responseText;

                if (response == 1) {
                    var msg = "Update Process Success";
                    var color = "bg-success";

                    toast(msg, color);
                } else if (response == 2) {

                    var msg = "Logo Uploading Faild";
                    var color = "bg-danger";

                    toast(msg, color);

                } else if (response == 3) {
                    var msg = "Invalid Image File Format";
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
                } else {
                    alert(response);
                }

            }
        }
        request.open("POST", "updateProfile.php", true);
        request.send(form);
    }

}

function updatePassword() {
    var oldP = document.getElementById("oldPassword").value;
    var newP = document.getElementById("newPassword").value;
    var reNewP = document.getElementById("reNewPassword").value;

    if (oldP.trim() == '' || newP.trim() == '' || reNewP.trim() == '') {
        var msg = "Fill The Neccesary Fields";
        var color = "bg-danger";

        toast(msg, color);
    } else {
        if (newP === reNewP) {

            var form = new FormData();
            form.append("oldP", oldP);
            form.append("newP", newP);
            form.append("reNewP", reNewP);

            var request = new XMLHttpRequest();
            request.onreadystatechange = function () {
                if (request.readyState == 4 && request.status == 200) {
                    var response = request.responseText;

                    if (response == 1) {
                        var msg = "Password Succesfuly Updated";
                        var color = "bg-success";

                        toast(msg, color);
                    } else if (response == 2) {

                        var msg = "In-correct Old Password";
                        var color = "bg-danger";

                        toast(msg, color);

                    } else if (response == 3) {
                        var msg = "Couldn't Find The Admin";
                        var color = "bg-danger";

                        toast(msg, color);
                    } else if (response == 4) {
                        var msg = "New Passwords Don't Match";
                        var color = "bg-danger";

                        toast(msg, color);
                    } else if (response == 5) {
                        var msg = "Fill The Details";
                        var color = "bg-warning";

                        toast(msg, color);
                    } else if (response == 6) {
                        var msg = "Password Size Must Be Less Than 45";
                        var color = "bg-warning";

                        toast(msg, color);
                    } else {
                        alert(response);
                    }

                }
            }
            request.open("POST", "updatePassword.php", true);
            request.send(form);

        } else {
            var msg = "New Password Values Don't Match";
            var color = "bg-danger";

            toast(msg, color);
        }
    }
}


function verifyMe() {
    var msg = "Verfication Code Sending Start ...";
    var color = "bg-success";

    toast(msg, color);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;

            if (response == 1) {
                var msg = "Verfication Code Sending Success";
                var color = "bg-success";

                toast(msg, color);

                setTimeout(() => {
                    alert("We Have Send A Tempary Password To Your Email Address. Please Use It For Update Your Password");
                }, 150);

            } else if (response == 2) {
                var msg = "Verfication Code Sending Faild";
                var color = "bg-danger";

                toast(msg, color);
            } else if (response == 3) {
                var msg = "Couldn't Find The Email Address";
                var color = "bg-warning";

                toast(msg, color);
            } else {
                alert(response);
            }
        }
    }
    request.open("POST", "adminVerify.php", true);
    request.send();
}


