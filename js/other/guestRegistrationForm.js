function book() {
    var refNo = document.getElementById("refNo").innerText; // require
    var surname = document.getElementById("surname").value; // require
    var fname = document.getElementById("fname").value; // require
    var lname = document.getElementById("lname").value; // require
    var mobile = document.getElementById("mobile").value; // require
    var nic = document.getElementById("nic").value; // require
    var passport = document.getElementById("passport").value;
    var email = document.getElementById("email").value; // require
    var address = document.getElementById("address").value;
    var nopa = document.getElementById("nopa").value; // require
    var nopc = document.getElementById("nopc").value; // require
    var country = document.getElementById("country").value;
    var nationality = document.getElementById("nationality").value;
    var religion = document.getElementById("religion").value;
    var arr = document.getElementById("arr").value; // require
    var de = document.getElementById("de").value; // require
    var rt = document.getElementById("rt").value; // require
    var mp = document.getElementById("mp").value; // require
    var ta = document.getElementById("ta").value;

    var currentDate = new Date(Date.now());
    var today = currentDate.toISOString().split('T')[0];

    if (refNo.trim() == "") {
        alert("Something Went Wrong. Please Try Re-Freshing the Page");
    } else if (surname == 0) {
        var msg = "Select Surname";
        var color = "bg-warning";
        toast(msg, color);
    } else if (fname.trim() == "") {
        var msg = "Insert First Name";
        var color = "bg-warning";
        toast(msg, color);
    } else if (lname.trim() == "") {
        var msg = "Insert Last Name";
        var color = "bg-warning";
        toast(msg, color);
    } else if (mobile.trim() == "") {
        var msg = "Insert Mobile Number";
        var color = "bg-warning";
        toast(msg, color);
    } else if (nic.trim() == "") {
        var msg = "Insert NIC";
        var color = "bg-warning";
        toast(msg, color);
    } else if (email.trim() == "") {
        var msg = "Insert Email Address";
        var color = "bg-warning";
        toast(msg, color);
    } else if (nopa <= 0) {
        var msg = "Select Adults Count";
        var color = "bg-warning";
        toast(msg, color);
    } else if (nopc < 0) {
        var msg = "Select Child Count";
        var color = "bg-warning";
        toast(msg, color);
    } else if (arr.trim() == "" || new Date(arr) < today) {
        var msg = "Select Valid Arrival Date";
        var color = "bg-warning";
        toast(msg, color);
    } else if (de.trim() == "" || new Date(de) < new Date()) {
        var msg = "Select Valid Departure Date";
        var color = "bg-warning";
        toast(msg, color);
    } else if (rt == 0) {
        var msg = "Select Room Type";
        var color = "bg-warning";
        toast(msg, color);
    } else if (mp == 0) {
        var msg = "Select Meal Plan";
        var color = "bg-warning";
        toast(msg, color);
    } else {

        var form = new FormData();
        form.append("refNo", refNo);
        form.append("surname", surname);
        form.append("fname", fname);
        form.append("lname", lname);
        form.append("mobile", mobile);
        form.append("nic", nic);
        form.append("email", email);
        form.append("nopa", nopa);
        form.append("nopc", nopc);
        form.append("arr", arr);
        form.append("de", de);
        form.append("rt", rt);
        form.append("mp", mp);

        if (passport.trim() != "") {
            form.append("passport", passport);
        }
        if (address.trim() != "") {
            form.append("address", address);
        }
        if (country != 0) {
            form.append("country", country);
        }
        if (nationality != 0) {
            form.append("nationality", nationality);
        }
        if (religion != 0) {
            form.append("religion", religion);
        }
        if (ta.trim() != "") {
            form.append("ta", ta);
        }

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = request.responseText;
                if (response == 1) {
                    alert("Booking Success");
                    sendRefEmail();
                    window.close();
                } else if (response == 2) {
                    alert("Invalid Details");
                }else{
                    console.log(response)
                }
            }
        };
        request.open("POST", "addBookingForm.php", true);
        request.send(form);

    }
}

function sendRefEmail(){

    var msg = "Email Sending Started";
    toast(msg, "bg-info");

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {

        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;

            if (response == 1) {
                var msg = "Email Sending Success";
                toast(msg, "bg-success");
            } else {
                var msg = "Email Sending Faild";
                toast(msg, "bg-success");
                alert(response);
            }
        }
    }
    request.open("POST", "sendRefEmail.php", true);
    request.send();

}