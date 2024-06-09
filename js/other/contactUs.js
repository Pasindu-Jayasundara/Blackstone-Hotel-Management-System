function sendMessage() {
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var messageTitel = document.getElementById("messageTitel").value;
    var message = document.getElementById("message").value;

    if (name.trim() == "") {
        var msg = "Insert Your Name";
        var color = "bg-warning";
        toast(msg, color);
    } else if (email.trim() == "") {
        var msg = "Insert Your Email Address";
        var color = "bg-warning";
        toast(msg, color);
    } else if (messageTitel.trim() == "") {
        var msg = "Insert Your Message Title";
        var color = "bg-warning";
        toast(msg, color);
    } else if (message.trim() == "") {
        var msg = "Insert Your Message";
        var color = "bg-warning";
        toast(msg, color);
    } else {
        var msg = "Message Sending Start";
        var color = "bg-warning";
        toast(msg, color);

        setTimeout(() => {
            document.getElementById("loading").classList.remove("d-none");
            document.getElementById("mainContent").classList.add("d-none");
        }, 3000);

        var form = new FormData();
        form.append("name", name);
        form.append("email", email);
        form.append("title", messageTitel);
        form.append("msg", message);

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {

                document.getElementById("loading").classList.add("d-none");
                document.getElementById("mainContent").classList.remove("d-none");

                var response = request.responseText;
                if (response == 1) {
                    var msg = "Message Sending Success";
                    var color = "bg-success";
                    toast(msg, color);
                } else if (response == 2) {
                    var msg = "Message Sending Faild";
                    var color = "bg-danger";
                    toast(msg, color);
                } else if (response == 3) {
                    var msg = "Insert Nessasary Details";
                    var color = "bg-warning";
                    toast(msg, color);
                } else {
                    showUserErrorModel();
                }
            }
        };
        request.open("POST", "sendEmail.php", true);
        request.send(form);

    }
}