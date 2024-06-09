window.addEventListener("load", () => {
    loadGrowthImage();
    loadManageManagement();
});


function updateVission() {

    var txt = document.getElementById("vission").innerText;

    if (txt.trim() == "") {

        var color = "bg-warning";
        var msg = "Provide Necessary Details";
        toast(msg, color);

        color = "";
        msg = "";

    } else {

        var color = "bg-info";
        var msg = "Vission Update Started";
        toast(msg, color);

        var form = new FormData();
        form.append("txt", txt);

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var txt = request.responseText;

                if (txt == "1") {
                    var color = "bg-warning";
                    var msg = "Provide Necessary Details";
                    toast(msg, color);
                } else if (txt == "2") {
                    var color = "bg-success";
                    var msg = "Vission Update Completed";
                    toast(msg, color);
                } else {
                    alert(txt);
                }
            }
        }

        request.open("POST", "updateVission.php", true);
        request.send(form);
    }

}


function updateMission() {

    var txt = document.getElementById("mission").innerText;

    if (txt.trim() == "") {

        var color = "bg-warning";
        var msg = "Provide Necessary Details";
        toast(msg, color);

        color = "";
        msg = "";

    } else {

        var color = "bg-info";
        var msg = "Mission Update Started";
        toast(msg, color);

        var form = new FormData();
        form.append("txt", txt);

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var txt = request.responseText;

                if (txt == "1") {
                    var color = "bg-warning";
                    var msg = "Provide Necessary Details";
                    toast(msg, color);
                } else if (txt == "2") {
                    var color = "bg-success";
                    var msg = "Mission Update Completed";
                    toast(msg, color);
                } else {
                    alert(txt);
                }
            }
        }

        request.open("POST", "updateMission.php", true);
        request.send(form);
    }

}


function updateGrowth() {

    var txt = document.getElementById("growth").innerText;

    if (txt.trim() == "") {

        var color = "bg-warning";
        var msg = "Provide Necessary Details";
        toast(msg, color);

        color = "";
        msg = "";

    } else {

        var color = "bg-info";
        var msg = "Growth Text Update Started";
        toast(msg, color);

        var form = new FormData();
        form.append("txt", txt);

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var txt = request.responseText;

                if (txt == "1") {
                    var color = "bg-warning";
                    var msg = "Provide Necessary Details";
                    toast(msg, color);
                } else if (txt == "2") {
                    var color = "bg-success";
                    var msg = "Growth Text Update Completed";
                    toast(msg, color);
                } else {
                    alert(txt);
                }
            }
        }

        request.open("POST", "updateGrowthText.php", true);
        request.send(form);
    }

}


function newGrowthImage() {

    var img = document.getElementById("ngi");

    if (img.files.length == 1) {

        var color = "bg-info";
        var msg = "New Image Adding Started";
        toast(msg, color);

        color = "";
        msg = "";

        var form = new FormData();
        form.append("img", img.files[0]);

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var txt = request.responseText;

                if (txt == "1") {
                    var color = "bg-warning";
                    var msg = "Select New Image";
                    toast(msg, color);
                } else if (txt == "2") {
                    var color = "bg-danger";
                    var msg = "File Uploading Faild";
                    toast(msg, color);
                } else if (txt == "3") {
                    var color = "bg-success";
                    var msg = "New Image Adding Completed";
                    loadGrowthImage();

                    toast(msg, color);
                } else if (txt == "4") {
                    var color = "bg-danger";
                    var msg = "Unsupported Image Type";
                    toast(msg, color);
                } else {
                    alert(txt);
                }
            }
        }

        request.open("POST", "addNewGrowthImage.php", true);
        request.send(form);

    }

}

function loadGrowthImage() {

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var txt = request.responseText;
            document.getElementById("growthImageDiv").innerHTML = "";
            document.getElementById("growthImageDiv").innerHTML = txt;
        }
    }
    request.open("POST", "loadGrowthImages.php", true);
    request.send();

}

function deleteGrowthImage(img_id) {

    var form = new FormData();
    form.append("imgId", img_id);

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;

            if (response == "1") {
                var color = "bg-danger";
                var msg = "Something Went Wrong";
                toast(msg, color);
            } else if (response == "2") {
                var color = "bg-success";
                var msg = "Image Delete Completed";
                loadGrowthImage();

                toast(msg, color);
            } else {
                alert(response);
            }

        }
    }
    request.open("POST", "deleteGrowthImages.php", true);
    request.send(form);

}


function loadManageManagement(){
    var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = request.responseText;

                document.getElementById("manageManagementDiv").innerHTML="";
                document.getElementById("manageManagementDiv").innerHTML=response;

            }
        }

        request.open("POST", "loadAvailableManagements.php", true);
        request.send();
}

function grimgloadtmp() {
    var img = document.getElementById("grimg").files[0];
    var url = URL.createObjectURL(img);
    document.getElementById("grimgtag").classList.remove("d-none");
    document.getElementById("grimgtag").src = url;
    document.getElementById("grimglabel").innerHTML = "Change Image";
}

function gr_add_new() {
    var img = document.getElementById("grimg");
    var position = document.getElementById("grposition").value;
    var name = document.getElementById("grname").value;

    if (name.trim() == '') {
        var msg = "Insert Management Name";
        var color = "bg-warning";
        toast(msg, color);
    } else if (name.length > 44) {
        var msg = "Name Too Long";
        var color = "bg-warning";
        toast(msg, color);
    } else if (position.trim() == '') {
        var msg = "Insert Position";
        var color = "bg-warning";
        toast(msg, color);
    } else if (img.files.length == 0) {
        var msg = "Select Profile Image";
        var color = "bg-warning";
        toast(msg, color);
    } else {
        var form = new FormData();
        form.append("img", img.files[0]);
        form.append("name", name);
        form.append("position", position);

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = JSON.parse(request.responseText);

                var msg = response.txt;
                var color = response.status;

                toast(msg, color);

                document.getElementById("grname").value = '';
                document.getElementById("grposition").value = '';
                document.getElementById("grimg").value = '';
                document.getElementById("grimgtag").classList.add("d-none");

                loadManageManagement();

            }
        }

        request.open("POST", "addNewManagement.php", true);
        request.send(form);
    }

}

function deleteManagement(id) {

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

            loadManageManagement();

        }
    }
    r.open("POST", "deleteManagement.php", true);
    r.send(f);
}

function updateManagementImage(id) {

    var img = document.getElementById("maAFile" + id).files[0];
    var url = URL.createObjectURL(img);
    document.getElementById("maAFileImg" + id).src = url;

}


function updateManagement(id) {

    var img = document.getElementById("maAFile" + id);
    var name = document.getElementById("maName" + id).value;
    var position = document.getElementById("maPosition" + id).value;

    if (name.trim() == "") {

        document.getElementById("maName" + id).classList.add("border-danger");
        var msg = "Please Insert The Name";
        var color = "bg-warning";

        toast(msg, color);

    } else if (position.trim() == "") {

        document.getElementById("maName" + id).classList.add("border-danger");
        var msg = "Please Insert The Position";
        var color = "bg-warning";

        toast(msg, color);

    } else {

        var msg = "Update Started";
        var color = "bg-info";
        toast(msg, color);

        var form = new FormData();
        form.append("id", id);

        var imgUp  = "2";
        if (img.files.length == 0) {
            imgUp = "2";
            form.append("imgUp", imgUp);
        } else {
            imgUp = "1";
            form.append("file", img.files[0]);
            form.append("imgUp", imgUp);
        }

        form.append("name", name);
        form.append("position", position);

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
                    loadManageManagement();

                    var msg = "Update Success";
                    var color = "bg-success";
                    toast(msg, color);
                } else {
                    alert(response);
                }
            }
        }
        request.open("POST", "updateManagement.php", true);
        request.send(form);

    }

}