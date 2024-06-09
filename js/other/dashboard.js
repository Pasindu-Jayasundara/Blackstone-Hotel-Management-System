window.addEventListener("load", chart);

function chart() {

    var selectYear = document.getElementById("selectYear").value;
    var year;
    if (selectYear == null || selectYear == '') {
        var date = new Date();
        year = date.getFullYear();
    } else {
        year = selectYear;
    }

    var form = new FormData();
    form.append("year", year);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {

            var jsonTestResponse = request.responseText;
            var response = JSON.parse(jsonTestResponse);

            var response_length = response.length;


            google.charts.load('current', { 'packages': ['corechart'] });
            google.charts.setOnLoadCallback(drawChart);

            function drawChart() {

                var data = new google.visualization.DataTable();
                data.addColumn('string', 'Month');
                data.addColumn('number', 'Offers');
                data.addColumn('number', 'Meals');
                data.addColumn('number', 'Bookings');

                for (var x = 0; x < response_length; x++) {
                    var month = response[x].month;
                    var offers = parseInt(response[x].data["offers"]);
                    var meals = parseInt(response[x].data["meals"]);
                    var bookings = parseInt(response[x].data["bookings"]);

                    data.addRow([month, offers, meals, bookings]);
                }

                var options = {
                    legend: { position: 'bottom' }
                };

                var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

                chart.draw(data, options);

            }

        }

        setTimeout(() => {
            chart();
        }, 60000);

    }
    request.open("POST", "chart.php", true);
    request.send(form);

};

var cc = 0;
var c2c = 0;
var ms = 0;
var bs = 0;

function change() {
    if (cc == 0) {

        cc = 1;

        if (document.getElementById("sc").classList.contains("flex-row")) {
            document.getElementById("sc").classList.replace("flex-row", "flex-column");
        }
        if (document.getElementById("scFD").classList.contains("align-items-end")) {
            document.getElementById("scFD").classList.replace("align-items-end", "align-items-start");
        }
    }

    c2c = 0;
};

function change2() {
    if (c2c == 0 && ms == 0 && bs == 0) {

        c2c = 1;

        if (document.getElementById("sc").classList.contains("flex-column")) {
            document.getElementById("sc").classList.replace("flex-column", "flex-row");
        }
        if (document.getElementById("scFD").classList.contains("align-items-start")) {
            document.getElementById("scFD").classList.replace("align-items-start", "align-items-end");
        }
    }

    cc = 0;
};


function searchMessage() {
    var email = document.getElementById("msgEmail").value;

    change();
    ms = 1;

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

function searchBooking() {
    var refNo = document.getElementById("refNo").value;

    change();
    bs = 1;

    document.getElementById("refSpan").innerHTML = "<img class='offset-6' src='../designImages/loading.gif'/>";

    var form = new FormData();
    form.append("ref", refNo);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {

        if (request.readyState == 4 && request.status == 200) {
            var response = JSON.parse(request.responseText);

            if (response.status == 1) {

                document.getElementById("refSpan").innerHTML = response.content;
                document.getElementById("refTable").classList.remove("d-none");

            } else if (response.status == 2) {
                if (!document.getElementById("refTable").classList.contains("d-none")) {
                    document.getElementById("refTable").classList.add("d-none");
                }
                document.getElementById("refSpan").innerHTML = "";
            }
        }

    };
    request.open("POST", "loadBooking.php", true);
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

function viewM(id) {
    document.getElementById("refTr" + id).classList.toggle("d-none");
    if (document.getElementById("view" + id).innerHTML == "View") {
        document.getElementById("view" + id).innerHTML = "Hide"
        document.getElementById("view" + id).classList.replace("btn-success", "btn-dark");
    } else {
        document.getElementById("view" + id).innerHTML = "View"
        document.getElementById("view" + id).classList.replace("btn-dark", "btn-success");
    }
}

function reset() {
    document.getElementById("msgSpan").innerHTML = null;
    document.getElementById("msgEmail").value = "";

    ms = 0;
    change2();
}

function resetBooking() {
    document.getElementById("refSpan").innerHTML = null;
    document.getElementById("refNo").value = "";

    bs = 0;
    change2();
}

function takeAction(id, email) {
    var option = document.getElementById("select" + id).value;

    if (option == 1) { // send register form

        document.getElementById("msgTable").classList.add("disabled");

        var msg = "Emailing Started";
        var color = "bg-info";
        toast(msg, color);

        document.getElementById("select" + id).setAttribute("disabled",true);

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
                }else if (response == 3) {
                    var msg = "Invalid Details";
                    var color = "bg-warning";
                    toast(msg, color);
                    document.getElementById("msgTable").classList.remove("disabled");
                }
                document.getElementById("select" + id).removeAttribute("disabled");
                document.getElementById("select" + id).selectedIndex=0;
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