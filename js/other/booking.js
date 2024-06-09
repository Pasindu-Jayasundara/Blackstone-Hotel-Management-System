window.addEventListener("load", () => {
    loadTodayArrival();
    loadTodayDeparture();
    loadNeedRoomAssigning();
});

function searchBooking() {
    var refNo = document.getElementById("refNo").value;

    if (refNo.trim() != "") {

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
}

function viewAr(id) {
    document.getElementById("arTr" + id).classList.toggle("d-none");
    if (document.getElementById("viewAr" + id).innerHTML == "View") {
        document.getElementById("viewAr" + id).innerHTML = "Hide"
        document.getElementById("viewAr" + id).classList.replace("btn-success", "btn-dark");
    } else {
        document.getElementById("viewAr" + id).innerHTML = "View"
        document.getElementById("viewAr" + id).classList.replace("btn-dark", "btn-success");
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

function viewDe(id) {
    document.getElementById("deTr" + id).classList.toggle("d-none");
    if (document.getElementById("viewDe" + id).innerHTML == "View") {
        document.getElementById("viewDe" + id).innerHTML = "Hide"
        document.getElementById("viewDe" + id).classList.replace("btn-success", "btn-dark");
    } else {
        document.getElementById("viewDe" + id).innerHTML = "View"
        document.getElementById("viewDe" + id).classList.replace("btn-dark", "btn-success");
    }
}


function resetBooking() {
    document.getElementById("nic").value = "";
    document.getElementById("name").value = "";
    document.getElementById("email").value = "";
    document.getElementById("arr").value = "";
    document.getElementById("de").value = "";
}

function resetBooking2() {
    document.getElementById("refNo").value = "";
    document.getElementById("refSpan").innerHTML = "";
}

function loadTodayArrival() {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {

        if (request.readyState == 4 && request.status == 200) {
            var response = JSON.parse(request.responseText);

            if (response.status == 1) {

                document.getElementById("todayArrival").innerHTML = response.content;
                document.getElementById("todayArrivalTable").classList.remove("d-none");

            } else if (response.status == 2) {
                document.getElementById("todayArrival").innerHTML = "<span class='col-12 d-flex justify-content-center align-items-center text-danger'>No Arrivals Today</span>";
            }
        }

    };
    request.open("POST", "loadTodayArrival.php", true);
    request.send();
}

function loadTodayDeparture() {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {

        if (request.readyState == 4 && request.status == 200) {
            var response = JSON.parse(request.responseText);

            if (response.status == 1) {

                document.getElementById("todayDeparture").innerHTML = response.content;
                document.getElementById("todayDepartureTable").classList.remove("d-none");

            } else if (response.status == 2) {
                document.getElementById("todayDeparture").innerHTML = "<span class='col-12 d-flex justify-content-center align-items-center text-danger'>No Departures Today</span>";
            }
        }

    };
    request.open("POST", "loadTodayDeparture.php", true);
    request.send();
}

function sendForm() {

    var nic = document.getElementById("nic").value;
    var name = document.getElementById("name").value;
    var email = document.getElementById("email").value;
    var arr = document.getElementById("arr").value;
    var de = document.getElementById("de").value;

    if (nic.trim() == "") {
        var msg = "Insert NIC";
        var color = "bg-warning";
        toast(msg, color);
    } else if (name.trim() == "") {
        var msg = "Insert Name";
        var color = "bg-warning";
        toast(msg, color);
    } else if (email.trim() == "") {
        var msg = "Insert Email Address";
        var color = "bg-warning";
        toast(msg, color);
    } else if (arr.trim() == "" || !new Date(arr) >= new Date()) {
        var msg = "Select Arrival Date";
        var color = "bg-warning";
        toast(msg, color);
    } else if (de.trim() == "" || !new Date(de) > new Date()) {
        var msg = "Select Departure Date";
        var color = "bg-warning";
        toast(msg, color);
    } else {

        var msg = "Form Sending Started";
        var color = "bg-info";
        toast(msg, color);

        document.getElementById("nic").setAttribute("disabled", true);
        document.getElementById("name").setAttribute("disabled", true);
        document.getElementById("email").setAttribute("disabled", true);
        document.getElementById("arr").setAttribute("disabled", true);
        document.getElementById("de").setAttribute("disabled", true);

        var form = new FormData();
        form.append("nic", nic);
        form.append("name", name);
        form.append("email", email);
        form.append("arr", arr);
        form.append("de", de);

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {

            if (request.readyState == 4 && request.status == 200) {
                var response = request.responseText;

                if (response == 1) {
                    var msg = "Form Sending Success";
                    var color = "bg-success";
                    toast(msg, color);

                    document.getElementById("nic").value = "";
                    document.getElementById("name").value = "";
                    document.getElementById("email").value = "";
                    document.getElementById("arr").value = "";
                    document.getElementById("de").value = "";
                } else if (response == 2) {
                    var msg = "Form Sending Faild";
                    var color = "bg-danger";
                    toast(msg, color);
                } else if (response == 3) {
                    var msg = "Invalid Details";
                    var color = "bg-danger";
                    toast(msg, color);
                }
                document.getElementById("nic").removeAttribute("disabled");
                document.getElementById("name").removeAttribute("disabled");
                document.getElementById("email").removeAttribute("disabled");
                document.getElementById("arr").removeAttribute("disabled");
                document.getElementById("de").removeAttribute("disabled");

            }

        };
        request.open("POST", "sendNewBookingForm.php", true);
        request.send(form);

    }

}

var roomModel;
function arrived(id) {
    roomModel = new bootstrap.Modal(document.getElementById("roomAssignModel" + id));
    roomModel.show();
}

function roomNumber(value, id) {
    var form = new FormData();
    form.append("value", value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {

        if (request.readyState == 4 && request.status == 200) {
            var response = JSON.parse(request.responseText);

            document.getElementById("rn" + id).innerHTML = response.content;

        }

    };
    request.open("POST", "roomNumber.php", true);
    request.send(form);
}

/*   

[ {typeName:"AC",typeId:1,roomName:"2",roomId:1}, {typeName:"AC",typeId:1,roomName:"2",roomId:1} ]

*/

var arr = [];
function addToOb(id) {
    var typeId = document.getElementById("rtype" + id).value;
    var typeName = document.getElementById("rtype" + id).options[document.getElementById("rtype" + id).selectedIndex].text;
    var roomId = document.getElementById("rn" + id).value;
    var roomName = document.getElementById("rn" + id).options[document.getElementById("rn" + id).selectedIndex].text;

    var ob = {};
    ob.typeName = typeName;
    ob.typeId = typeId;
    ob.roomName = roomName;
    ob.roomId = roomId;

    var isDuplicate = arr.some(function (item) {
        // Compare objects based on their property values
        return (
            item.typeName === ob.typeName &&
            item.typeId === ob.typeId &&
            item.roomName === ob.roomName &&
            item.roomId === ob.roomId
        );
    });

    if (!isDuplicate) {
        arr.push(ob);
        displayArr(id);
    }
}

function displayArr(id) {
    document.getElementById("arrayCD" + id).innerHTML = "";
    arr.forEach((obj) => {
        var content = obj.typeName + " " + obj.roomName;
        var element = document.createElement("p");
        element.textContent = content;
        document.getElementById("arrayCD" + id).appendChild(element);
    });
}

function resetModel(id) {
    arr = [];
    document.getElementById("arrayCD" + id).innerHTML = "";
}

function markArrived(id) {
    if (arr.length > 0) {
        var form = new FormData();
        form.append("id", id);
        form.append("arr", JSON.stringify(arr));

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {

            if (request.readyState == 4 && request.status == 200) {
                var response = request.responseText;
                if (response == 1) {

                    document.getElementById("artd" + id).innerHTML = '<i class="large green checkmark icon"></i>';
                    document.getElementById("arrayCD" + id).innerHTML = "";
                    roomModel.hide();
                    arr = [];

                    loadAssignedRooms(id);

                } else if (response == 2) {
                    alert(response);
                }

            }

        };
        request.open("POST", "markArrived.php", true);
        request.send(form);
    } else {
        document.getElementById("arrayCD" + id).innerHTML = "<span class='text-danger fw-bold'>Select Room First</span>";
    }
}

function loadAssignedRooms(id) {
    var form = new FormData();
    form.append("id", id);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {

        if (request.readyState == 4 && request.status == 200) {
            var response = JSON.parse(request.responseText);

            document.getElementById("art" + id).innerHTML = response.content;
            document.getElementById("arrT" + id).innerHTML = response.arrTime;
            document.getElementById("depA" + id).innerHTML = response.arrTime;

        }

    };
    request.open("POST", "loadAssignedRooms.php", true);
    request.send(form);
}

function departured(id) {
    var form = new FormData();
    form.append("id", id);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {

        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response == 2) {
                alert(response);
            } else {

                document.getElementById("detd" + id).innerHTML = '<i class="large green checkmark icon"></i>';

                document.getElementById("ardT" + id).innerHTML = response;
                document.getElementById("dedT" + id).innerHTML = response;

            }
        }

    };
    request.open("POST", "markDepartured.php", true);
    request.send(form);
}


function roomAvailiability() {

    var v = document.getElementById("dateIn").value;

    var form = new FormData();
    form.append("date", v);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {

            document.getElementById("roomAv").innerHTML = request.responseText;

        }

    };
    request.open("POST", "roomAvailiability.php", true);
    request.send(form);

}

function resetAvailibility() {
    document.getElementById("dateIn").value = "";
    document.getElementById("roomAv").innerHTML = "";
}

function bookNow() {

    var nic = document.getElementById("bnnic").value;
    var name = document.getElementById("bnname").value;
    var email = document.getElementById("bnemail").value;
    var arr = document.getElementById("bnarr").value;
    var de = document.getElementById("bndep").value;
    var roomtype = document.getElementById("bnroomtype").value;
    var mealplan = document.getElementById("bnmealplan").value;
    var mobile = document.getElementById("bnmobile").value;

    if (nic.trim() == "") {
        var msg = "Insert NIC";
        var color = "bg-warning";
        toast(msg, color);
    } else if (name.trim() == "") {
        var msg = "Insert Name";
        var color = "bg-warning";
        toast(msg, color);
    } else if (email.trim() == "") {
        var msg = "Insert Email Address";
        var color = "bg-warning";
        toast(msg, color);
    } else if (arr.trim() == "" || !new Date(arr) >= new Date()) {
        var msg = "Select Arrival Date";
        var color = "bg-warning";
        toast(msg, color);
    } else if (de.trim() == "" || !new Date(de) > new Date()) {
        var msg = "Select Departure Date";
        var color = "bg-warning";
        toast(msg, color);
    } else if (roomtype == 0) {
        var msg = "Select Room Type";
        var color = "bg-warning";
        toast(msg, color);
    } else if (mealplan == 0) {
        var msg = "Select Meal Plan";
        var color = "bg-warning";
        toast(msg, color);
    } else if (mobile.trim() == "") {
        var msg = "Insert Mobile Number";
        var color = "bg-warning";
        toast(msg, color);
    } else {

        var msg = "Booking Started";
        toast(msg, "bg-info");

        document.getElementById("bnnic").setAttribute("disabled", true);
        document.getElementById("bnname").setAttribute("disabled", true);
        document.getElementById("bnemail").setAttribute("disabled", true);
        document.getElementById("bnarr").setAttribute("disabled", true);
        document.getElementById("bndep").setAttribute("disabled", true);
        document.getElementById("bnroomtype").setAttribute("disabled", true);
        document.getElementById("bnmealplan").setAttribute("disabled", true);
        document.getElementById("bnmobile").setAttribute("disabled", true);

        var form = new FormData();
        form.append("nic", nic);
        form.append("name", name);
        form.append("email", email);
        form.append("arr", arr);
        form.append("de", de);
        form.append("roomtype", roomtype);
        form.append("mealplan", mealplan);
        form.append("mobile", mobile);

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {

            if (request.readyState == 4 && request.status == 200) {
                var response = request.responseText;

                if (response == 1) {
                    var msg = "Booking Success";
                    toast(msg, "bg-success");

                    sendEmail();

                    document.getElementById("bnnic").value = "";
                    document.getElementById("bnname").value = "";
                    document.getElementById("bnemail").value = "";
                    document.getElementById("bnarr").value = new Date();
                    document.getElementById("bndep").value = "";
                    document.getElementById("bnroomtype").setSelectedIndex = 0;
                    document.getElementById("bnmealplan").setSelectedIndex = 0;
                    document.getElementById("bnmobile").value = "";

                    loadTodayArrival();
                    loadTodayDeparture();

                } else if (response == 2) {
                    var msg = "Invalid Details";
                    toast(msg, "bg-danger");
                }
                document.getElementById("bnnic").removeAttribute("disabled");
                document.getElementById("bnname").removeAttribute("disabled");
                document.getElementById("bnemail").removeAttribute("disabled");
                document.getElementById("bnarr").removeAttribute("disabled");
                document.getElementById("bndep").removeAttribute("disabled");
                document.getElementById("bnroomtype").removeAttribute("disabled");
                document.getElementById("bnmealplan").removeAttribute("disabled");
                document.getElementById("bnmobile").removeAttribute("disabled");

            }

        };
        request.open("POST", "addNewBooking.php", true);
        request.send(form);

    }

}

function sendEmail() {

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
    request.open("POST", "sendBookNowEmail.php", true);
    request.send();

}

function restBookNow() {

    document.getElementById("bnnic").value = "";
    document.getElementById("bnname").value = "";
    document.getElementById("bnemail").value = "";
    document.getElementById("bnarr").value = new Date("Y-m-d H:i:s");
    document.getElementById("bndep").value = "";
    document.getElementById("bnroomtype").setSelectedIndex = 0;
    document.getElementById("bnmealplan").setSelectedIndex = 0;
    document.getElementById("bnmobile").value = "";

}

function loadNeedRoomAssigning() {

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {

        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;

            document.getElementById("roomAssigning").innerHTML = response;

        }
    }
    request.open("POST", "loadNeedRoomAssigning.php", true);
    request.send();

}

var assRoomAssignModel;
function showAssignModel(id) {
    assRoomAssignModel = new bootstrap.Modal(document.getElementById("assRoomAssignModel" + id));
    assRoomAssignModel.show();
}

function assRoomNumber(value, id) {
    var form = new FormData();
    form.append("value", value);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {

        if (request.readyState == 4 && request.status == 200) {
            var response = JSON.parse(request.responseText);

            document.getElementById("roomNumber" + id).innerHTML = response.content;

        }

    };
    request.open("POST", "roomNumber.php", true);
    request.send(form);
}

var arrAss = [];
function addToRoomAssOb(id) {
    var typeId = document.getElementById("roomtype" + id).value;
    var typeName = document.getElementById("roomtype" + id).options[document.getElementById("roomtype" + id).selectedIndex].text;
    var roomId = document.getElementById("roomNumber" + id).value;
    var roomName = document.getElementById("roomNumber" + id).options[document.getElementById("roomNumber" + id).selectedIndex].text;

    var ob = {};
    ob.typeName = typeName;
    ob.typeId = typeId;
    ob.roomName = roomName;
    ob.roomId = roomId;

    var isDuplicate = arrAss.some(function (item) {
        // Compare objects based on their property values
        return (
            item.typeName === ob.typeName &&
            item.typeId === ob.typeId &&
            item.roomName === ob.roomName &&
            item.roomId === ob.roomId
        );
    });

    if (!isDuplicate) {
        arrAss.push(ob);
        displayAssArr(id);
    }
}

function displayAssArr(id) {
    document.getElementById("selectedroomDisplay" + id).innerHTML = "";
    arrAss.forEach((obj) => {
        var content = obj.typeName + " " + obj.roomName;
        var element = document.createElement("p");
        element.textContent = content;
        document.getElementById("selectedroomDisplay" + id).appendChild(element);
    });
}

function resetAssModel(id) {
    arrAss = [];
    document.getElementById("selectedroomDisplay" + id).innerHTML = "";
}

function markAssArrived(id) {
    if (arrAss.length > 0) {
        var form = new FormData();
        form.append("id", id);
        form.append("arr", JSON.stringify(arrAss));

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {

            if (request.readyState == 4 && request.status == 200) {
                var response = request.responseText;
                if (response == 1) {

                    document.getElementById("assStatus" + id).innerHTML = '<i class="large green checkmark icon"></i>';
                    document.getElementById("selectedroomDisplay" + id).innerHTML = "";
                    assRoomAssignModel.hide();
                    arr = [];

                    loadNeedRoomAssigning();

                } else if (response == 2) {
                    alert(response);
                }

            }

        };
        request.open("POST", "markRoomAssigning.php", true);
        request.send(form);
    } else {
        document.getElementById("selectedroomDisplay" + id).innerHTML = "<span class='text-danger fw-bold'>Select Room First</span>";
    }
}

function deleteAlreadyAssigned(id) {

    var form = new FormData();
    form.append("registered_guest_has_room_numbers_id", id);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {

        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;
            if (response == 1) {

                document.getElementById("alasul"+id).classList.add("d-none");

                loadNeedRoomAssigning();

            } else if (response == 2) {
                alert("Something went wrong");
            }

        }

    };
    request.open("POST", "removeAlreadyAsssignedRooms.php", true);
    request.send(form);

}