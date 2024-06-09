
var msg_Type = 1;//new

var msg;
var color;

function newOld(type) {
    msg_Type = type;

    if (msg_Type == 1) {//new
        document.getElementById("newMsgBtn").classList.remove("btn-primary");
        document.getElementById("newMsgBtn").classList.add("btn-outline-primary");

        document.getElementById("allMsgBth").classList.remove("btn-outline-dark");
        document.getElementById("allMsgBth").classList.add("btn-dark");
    } else if (msg_Type == 2) {//all
        document.getElementById("newMsgBtn").classList.remove("btn-outline-primary");
        document.getElementById("newMsgBtn").classList.add("btn-primary");

        document.getElementById("allMsgBth").classList.remove("btn-dark");
        document.getElementById("allMsgBth").classList.add("btn-outline-dark");
    }

    msgRequest();
}

window.addEventListener("load", () => {

    msgRequest();

});


function msgRequest() {

    var form = new FormData();
    form.append("msg_Type", msg_Type);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;

            if (response == 1) {
                document.getElementById("msgList").innerHTML = '';
                msg = "No New Messages";
                color = "bg-dark";

                toast(msg, color);
            } else if (response == 2) {
                msg = "something went wrong";
                color = "bg-danger";

                toast(msg, color);
            } else {
                document.getElementById("msgList").innerHTML = response;
            }
        }
    }
    request.open("POST", "loadMessages.php", true);
    request.send(form);
}

var message_id;
var message_status_id;

function readMsg(msg_id, msg_status_id) {

    message_id = msg_id;
    message_status_id = msg_status_id;

    var form = new FormData();
    form.append("msg_id", msg_id);
    form.append("msg_status_id", msg_status_id);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;

            if (response == 2) {
                msg = "Couldn't Find The Message";
                color = "bg-danger";

                toast(msg, color);
            } else if (response == 3) {
                msg = "Something Went Wrong";
                color = "bg-danger";

                toast(msg, color);
            } else {
                document.getElementById("msgDisplay").innerHTML = response;

                if (msg_status_id == 2 && parseInt(document.getElementById("msgCount").innerHTML) - 1 >= 0) {
                    document.getElementById("msgCount").innerHTML = parseInt(document.getElementById("msgCount").innerHTML) - 1;
                }
            }
        }
    }
    request.open("POST", "readMessages.php", true);
    request.send(form);

}

function sendEmail(email) {
    var replyMsg = document.getElementById("replyText").value;

    if (replyMsg.trim() == "") {
        document.getElementById("darkbg" + email).classList.add("bg-danger");

        msg = "Please Insert Reply Message";
        color = "bg-warning";

        toast(msg, color);
    } else {
        document.getElementById("darkbg" + email).classList.add("bg-dark");

        msg = "Reply Sending Start ..";
        color = "bg-success";

        toast(msg, color);

        var form = new FormData();
        form.append("email", email);
        form.append("replyMsg", replyMsg);

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = request.responseText;

                if (response == 1) {
                    msg = "Reply Email Sending Success";
                    color = "bg-success";

                    toast(msg, color);

                    if (message_status_id == 2) {
                        message_status_id = 1;
                    }
                    readMsg(message_id, message_status_id)

                } else if (response == 2) {
                    msg = "Reply Email Sending Faild";
                    color = "bg-danger";

                    toast(msg, color);
                } else if (response == 3) {
                    msg = "Please Insert Reply Msg";
                    color = "bg-warning";

                    toast(msg, color);
                } else if (response == 4) {
                    msg = "Something Went Wrong";
                    color = "bg-warning";

                    toast(msg, color);
                } else {
                    alert(response);
                }
            }
        }
        request.open("POST", "replyAdminEmail.php", true);
        request.send(form);

    }

}

function newsletter() {
    var text = document.getElementById("message-text").value;
    var title = document.getElementById("title").value;
    if (title.trim() == '') {
        alert("Insert The Title");
        document.getElementById("title").classList.add("border-danger");

    } else if (text.trim() == '') {
        alert("Insert The Message");
        document.getElementById("message-text").classList.add("border-danger");
        document.getElementById("title").classList.remove("border-danger");
    } else {

        document.getElementById("cb1").classList.add("d-none");
        document.getElementById("cb2").classList.add("d-none");

        document.getElementById("message-text").classList.remove("border-danger");
        document.getElementById("title").classList.remove("border-danger");
        document.getElementById("st").classList.remove("d-none");
        document.getElementById("newssend").classList.add("disabled");

        var form = new FormData();
        form.append("title", title);
        form.append("text", text);

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = request.responseText;

                document.getElementById("st").classList.add("d-none");
                document.getElementById("newssend").classList.remove("disabled");

                document.getElementById("cb2").classList.remove("d-none");
                document.getElementById("cb1").classList.remove("d-none");
                document.getElementById("cb2").click();

                if (response == 1) {
                    var msg = "You dont have any subscribers";
                    var color = "bg-black";
                    toast(msg, color);
                } else if (response == 2) {
                    var msg = "Please Insert Reply Message";
                    var color = "bg-danger";
                    toast(msg, color);
                } else if (response == 3) {
                    var msg = "Please Insert The Message Title";
                    var color = "bg-danger";
                    toast(msg, color);
                } else {
                    var r = JSON.parse(response);
                    var msg = r.success + " " + " Messages Sussceesfully Send." + " " + r.faild + " Messages Sending Faild";
                    var color = "bg-info";
                    toast(msg, color);
                }

                setTimeout(() => {
                    window.location.reload();
                }, 900);
                

            }
        }
        request.open("POST", "newsLetter.php", true);
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

function reset() {
    document.getElementById("msgSpan").innerHTML = null;
    document.getElementById("msgEmail").value = "";
}

function searchMessage() {
    var email = document.getElementById("msgEmail").value;

    document.getElementById("msgSpan").innerHTML = "<img class='offset-6' src='../designImages/loading.gif'/>";

    var form = new FormData();
    form.append("email", email);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {

        if (request.readyState == 4 && request.status == 200) {
            var response = JSON.parse(request.responseText);

            if (response.status == 1) {

                document.getElementById("msgSpan").innerHTML = response.content;
                document.getElementById("msgTable").classList.remove("d-none");

            } else if (response.status == 2) {
                if (!document.getElementById("msgTable").classList.contains("d-none")) {
                    document.getElementById("msgTable").classList.add("d-none");
                }
                document.getElementById("msgSpan").innerHTML = "";
            }
        }

    };
    request.open("POST", "loadMsg.php", true);
    request.send(form);
}

function viewM(id) {
    document.getElementById("msgTr" + id).classList.toggle("d-none");
    if (document.getElementById("view" + id).innerHTML == "View") {
        document.getElementById("view" + id).innerHTML = "Hide"
        document.getElementById("view" + id).classList.replace("btn-success", "btn-dark");
    } else {
        document.getElementById("view" + id).innerHTML = "View"
        document.getElementById("view" + id).classList.replace("btn-dark", "btn-success");
    }
}

function takeAction(id, email) {
    var option = document.getElementById("select" + id).value;

    if (option == 1) { // send register form

        document.getElementById("msgTable").classList.add("disabled");

        var msg = "Emailing Started";
        var color = "bg-info";
        toast(msg, color);

        var form = new FormData();
        form.append("id", id);
        form.append("email", email);

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {

            if (request.readyState == 4 && request.status == 200) {
                var response = request.responseText;

                if (response == 1) {

                    var msg = "Succesfully Emailed";
                    var color = "bg-success";
                    toast(msg, color);

                    document.getElementById("msgTable").classList.remove("disabled");
                } else if (response == 2) {
                    var msg = "Something Went Wrong";
                    var color = "bg-warning";
                    toast(msg, color);
                    document.getElementById("msgTable").classList.remove("disabled");
                }
            }

        };
        request.open("POST", "sendForm.php", true);
        request.send(form);

    } else if (option == 2) { // delete

        document.getElementById("msgTable").classList.add("disabled");

        var msg = "Deleting Started";
        var color = "bg-info";
        toast(msg, color);

        var form = new FormData();
        form.append("id", id);
        form.append("email", email);

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {

            if (request.readyState == 4 && request.status == 200) {

                var response = request.responseText;

                if (response == 1) {

                    var msg = "Succesfully Deleted";
                    var color = "bg-success";
                    toast(msg, color);

                    document.getElementById("tr" + id).classList.add("d-none");
                    document.getElementById("msgTable").classList.remove("disabled");
                } else {
                    var msg = "Something Went Wrong";
                    var color = "bg-warning";
                    toast(msg, color);
                    document.getElementById("msgTable").classList.remove("disabled");
                }
            }

        };
        request.open("POST", "deleteMsg.php", true);
        request.send(form);

    }
}