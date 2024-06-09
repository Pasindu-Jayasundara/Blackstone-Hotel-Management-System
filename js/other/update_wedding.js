
window.addEventListener("load", () => {
    loadManageWedding();
});


var type;

function changetype() {
    type = document.getElementById("type").value;
    var nametag = document.getElementById("nametag");
    var description = document.getElementById("desc");
    var weinsertText = document.getElementById("weinsertText");
    var weimgdiv = document.getElementById("weimgdiv");

    if (type == 1) { // hall

        nametag.innerHTML = "Hall Name";
        description.classList.remove("d-none");
        weinsertText.classList.remove("d-none");
        weimgdiv.classList.remove("d-none");

    } else if (type == 2) { //features

        nametag.innerHTML = "Feature";
        description.classList.add("d-none");
        weinsertText.classList.add("d-none");
        weimgdiv.classList.add("d-none");

    } else if (type == 3) { //menu

        nametag.innerHTML = "Menu Name";
        description.classList.remove("d-none");
        weinsertText.classList.remove("d-none");
        weimgdiv.classList.remove("d-none");

    }
}

var show = 1;
function showtype() {

    show = document.getElementById("show").value;

    loadManageWedding();

}

function loadManageWedding() {

    var form = new FormData();
    form.append("type", show);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;

            document.getElementById("manageWeddingDiv").innerHTML = "";
            document.getElementById("manageWeddingDiv").innerHTML = response;

        }
    }

    request.open("POST", "loadAvailableWedding.php", true);
    request.send(form);
}

function weimgloadtmp() {
    var img = document.getElementById("weimg").files[0];
    var url = URL.createObjectURL(img);
    document.getElementById("weimgtag").classList.remove("d-none");
    document.getElementById("weimgtag").src = url;
    document.getElementById("weimglabel").innerHTML = "Change Image";
}


var of;
var correct = false;


function nameCheck(name) {

    if (type == 1) { // hall
        of = "Wedding Hall";
    } else if (type == 2) { // feature
        of = "Feature";
    } else if (type == 3) { // menu
        of = "Menu";
    }

    if (name.trim() == '') {
        var msg = "Insert " + of + " Name";
        var color = "bg-warning";
        toast(msg, color);
    } else if (name.length > 44) {
        var msg = of + " Too Long";
        var color = "bg-warning";
        toast(msg, color);
    } else {
        correct == true;
    }
}


function we_add_new() {

    var form = new FormData();

    if (type == 1) {  // hall

        var img1 = document.getElementById("weimg1");
        var img2 = document.getElementById("weimg2");
        var insertText = document.getElementById("weinsertText").value;
        var name = document.getElementById("wename").value;

        nameCheck(name);

        correct = false;

        if (insertText.trim() == '') {
            var msg = "Insert Wedding Hall Description";
            var color = "bg-warning";
            toast(msg, color);
        } else if (insertText.length > 44) {
            var msg = "Wedding Hall Description Too Long";
            var color = "bg-warning";
            toast(msg, color);
        } else if (img1.files.length == 0 || img2.files.length == 0) {

            var msg = "Select " + of + " Image";
            var color = "bg-warning";
            toast(msg, color);

        } else {
            correct = true;
            form.append("txt", insertText);
            form.append("img1", img1.files[0]);
            form.append("img2", img2.files[0]);
        }


    } else if (type == 2) { // feature

        var name = document.getElementById("wename").value;
        nameCheck(name);

    } else if (type == 3) { // menu

        var img = document.getElementById("weimg");
        var name = document.getElementById("wename").value;
        var insertText = document.getElementById("weinsertText").value;

        nameCheck(name);

        correct = false;
        if (insertText.trim() == '') {
            var msg = "Insert Wedding Menu Description";
            var color = "bg-warning";
            toast(msg, color);
        } else if (insertText.length > 44) {
            var msg = "Wedding Menu Description Too Long";
            var color = "bg-warning";
            toast(msg, color);
        } else if (img.files.length == 0) {

            var msg = "Select " + of + " Image";
            var color = "bg-warning";
            toast(msg, color);

        } else {
            correct = true;
            form.append("img", img.files[0]);
            form.append("txt", insertText);
        }

    }

    if (correct == true) {

        form.append("name", name);
        form.append("type", type);

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = JSON.parse(request.responseText);

                var msg = response.txt;
                var color = response.status;

                toast(msg, color);

                if (type == 1 || type == 3) { // hall
                    document.getElementById("weinsertText").value = '';
                }

                document.getElementById("wename").value = '';
                if (type == 1) {
                    document.getElementById("weimg1").value = '';
                    document.getElementById("weimg2").value = '';
                } else {
                    document.getElementById("weimg").value = '';
                }
                document.getElementById("weimgtag").classList.add("d-none");

                loadManageWedding();

            }
        }

        request.open("POST", "addNewWeddingContent.php", true);
        request.send(form);
    }

}

function deleteWeddingHall(id) {

    var f = new FormData();
    f.append("id", id);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var txt = r.responseText;
            if (txt == 1) {
                var msg = "Delete Successful";
                var color = "bg-success";
                toast(msg, color);
            }

            loadManageWedding();

        }
    }
    r.open("POST", "deleteWeddingHall.php", true);
    r.send(f);
}

function deleteWeddingFeature(id) {

    var f = new FormData();
    f.append("id", id);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var txt = r.responseText;
            if (txt == 1) {
                var msg = "Delete Successful";
                var color = "bg-success";
                toast(msg, color);
            }

            loadManageWedding();

        }
    }
    r.open("POST", "deleteWeddingFeature.php", true);
    r.send(f);
}

function deleteWeddingFoodMenu(id) {

    var f = new FormData();
    f.append("id", id);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var txt = r.responseText;
            if (txt == 1) {
                var msg = "Delete Successful";
                var color = "bg-success";
                toast(msg, color);
            }

            loadManageWedding();

        }
    }
    r.open("POST", "deleteWeddingFoodMenu.php", true);
    r.send(f);
}

function updateWeddingHallImage(id, img_id) {

    var img = document.getElementById("whAFile" + id + img_id).files[0];
    var url = URL.createObjectURL(img);
    document.getElementById("whAFileImg" + id + img_id).src = url;

}

function updateWeddingFoodMenuImage(id) {

    var img = document.getElementById("wfmAFile" + id).files[0];
    var url = URL.createObjectURL(img);
    document.getElementById("wfmAFileImg" + id).src = url;

}


function updateWeddingHall(id, img_id) {

    var img = document.getElementById("whAFile" + id + img_id);
    var name = document.getElementById("whname" + id).value;
    var textArea = document.getElementById("whTextArea" + id).value;

    if (name.trim() == "") {

        document.getElementById("whname" + id).classList.add("border-danger");
        var msg = "Please Insert The Name";
        var color = "bg-warning";

        toast(msg, color);

    } else if (textArea.trim() == "") {

        document.getElementById("whTextArea" + id).classList.add("border-danger");
        var msg = "Please Insert The Description";
        var color = "bg-warning";

        toast(msg, color);

    } else {

        var msg = "Update Started";
        var color = "bg-info";
        toast(msg, color);

        var form = new FormData();
        form.append("id", id);
        form.append("img_id", img_id);

        var imgUp = "2";
        if (img.files.length == 0) {
            imgUp = "2";
            form.append("imgUp", imgUp);
        } else {
            imgUp = "1";
            form.append("file", img.files[0]);
            form.append("imgUp", imgUp);
        }

        form.append("name", name);
        form.append("description", textArea);

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = request.responseText;
                if (response == 1) {
                    var msg = "Please Provide Necessary Details";
                    var color = "bg-warning";
                    toast(msg, color);
                } else if (response == "2") {
                    var msg = "Image Uploading Faild";
                    var color = "bg-danger";
                    toast(msg, color);
                } else if (response == "3") {
                    var msg = "Image Uploading Compleated";
                    var color = "bg-danger";
                    toast(msg, color);
                } else if (response == "3") {
                    var msg = "Image Uploading Compleated... Update in Progress";
                    var color = "bg-black";
                    toast(msg, color);
                } else if (response == "4" || response == "34") {
                    loadManageWedding();

                    var msg = "Update Success";
                    var color = "bg-success";
                    toast(msg, color);
                } else {
                    alert(response);
                }
            }
        }
        request.open("POST", "updateWeddingHall.php", true);
        request.send(form);

    }

}

function updateWeddingFoodMenu(id) {

    var img = document.getElementById("wfmAFile" + id);
    var name = document.getElementById("wfmname" + id).value;
    var textArea = document.getElementById("wfmTextArea" + id).value;

    if (name.trim() == "") {

        document.getElementById("wfmname" + id).classList.add("border-danger");
        var msg = "Please Insert The Menu Name";
        var color = "bg-warning";

        toast(msg, color);

    } else if (textArea.trim() == "") {

        document.getElementById("wfmTextArea" + id).classList.add("border-danger");
        var msg = "Please Insert The Description";
        var color = "bg-warning";

        toast(msg, color);

    } else {

        var msg = "Update Started";
        var color = "bg-info";
        toast(msg, color);

        var form = new FormData();
        form.append("id", id);

        var imgUp = "2";
        if (img.files.length == 0) {
            imgUp = "2";
            form.append("imgUp", imgUp);
        } else {
            imgUp = "1";
            form.append("file", img.files[0]);
            form.append("imgUp", imgUp);
        }

        form.append("name", name);
        form.append("description", textArea);

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = request.responseText;
                if (response == 1) {
                    var msg = "Please Provide Necessary Details";
                    var color = "bg-warning";
                    toast(msg, color);
                } else if (response == "2") {
                    var msg = "Image Uploading Faild";
                    var color = "bg-danger";
                    toast(msg, color);
                } else if (response == "3") {
                    var msg = "Image Uploading Compleated";
                    var color = "bg-danger";
                    toast(msg, color);
                } else if (response == "3") {
                    var msg = "Image Uploading Compleated... Update in Progress";
                    var color = "bg-black";
                    toast(msg, color);
                } else if (response == "4" || response == "34") {
                    loadManageWedding();

                    var msg = "Update Success";
                    var color = "bg-success";
                    toast(msg, color);
                } else {
                    alert(response);
                }
            }
        }
        request.open("POST", "updateWeddingFoodMenu.php", true);
        request.send(form);

    }

}

function showSelectImageModel() {
    if (document.getElementById("type").value == 1) {
        new bootstrap.Modal(document.getElementById("weddingHallModel")).show();
    } else if (document.getElementById("type").value == 3) {
        document.getElementById("weimg").click();
    } else {
        alert("Select Type First");
    }
}

var hallimg1 = null;
function weimgloadtmp1() {
    hallimg1 = document.getElementById("weimg1").files[0];
    var url = URL.createObjectURL(hallimg1);
    document.getElementById("weimgtag1").classList.remove("d-none");
    document.getElementById("weimgtag1").src = url;
    document.getElementById("weimglabel1").innerHTML = "Change Image";
}

var hallimg2 = null;
function weimgloadtmp2() {
    hallimg2 = document.getElementById("weimg2").files[0];
    var url = URL.createObjectURL(hallimg2);
    document.getElementById("weimgtag2").classList.remove("d-none");
    document.getElementById("weimgtag2").src = url;
    document.getElementById("weimglabel2").innerHTML = "Change Image";
}

var arr = [];
function hallImageSelected() {
    arr = [];

    if (hallimg1 != null && hallimg2 != null) {
        arr.push(hallimg1);
        arr.push(hallimg2);

        document.getElementById("closebtn").click();
        document.getElementById("weimglabel").innerHTML = "Change Images";
    } else {
        var body = document.getElementById("hallimgbody").innerHTML;
        document.getElementById("hallimgbody").innerHTML = "<span class='text-danger fw-bold'>Please Select 2 Images</span>";
        setTimeout(() => {
            document.getElementById("hallimgbody").innerHTML = body;
        }, 1000);
    }
}