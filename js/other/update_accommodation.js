window.addEventListener("load",()=>{
    loadManageAccommodation();
});

function loadManageAccommodation(){
    var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = request.responseText;

                document.getElementById("manageAccommodationDiv").innerHTML="";
                document.getElementById("manageAccommodationDiv").innerHTML=response;

            }
        }

        request.open("POST", "loadAvailableAccommodations.php", true);
        request.send();
}

function accimgloadtmp() {
    var img = document.getElementById("img").files[0];
    var url = URL.createObjectURL(img);
    document.getElementById("imgtag").classList.remove("d-none");
    document.getElementById("imgtag").src = url;
    document.getElementById("imglabel").innerHTML = "Change Image";
}

function add_new() {
    var img = document.getElementById("img");
    var insertText = document.getElementById("insertText").value;
    var package = document.getElementById("package").value;
    var size = document.getElementById("size").value;
    var name = document.getElementById("name").value;

    if (name.trim() == '') {
        var msg = "Insert Accommodation Name";
        var color = "bg-warning";
        toast(msg, color);
    } else if (name.length > 44) {
        var msg = "Name Too Long";
        var color = "bg-warning";
        toast(msg, color);
    } else if (size.trim() == '') {
        var msg = "Insert Accommodation Size";
        var color = "bg-warning";
        toast(msg, color);
    } else if (package == 0) {
        var msg = "Select Accommodation Package";
        var color = "bg-warning";
        toast(msg, color);
    } else if (img.files.length == 0) {
        var msg = "Select Accommodation Image";
        var color = "bg-warning";
        toast(msg, color);
    } else if (insertText.trim() == '') {
        var msg = "Insert Accommodation Description";
        var color = "bg-warning";
        toast(msg, color);
    } else if (insertText.length > 44) {
        var msg = "Accommodation Description Too Long";
        var color = "bg-warning";
        toast(msg, color);
    } else {
        var form = new FormData();
        form.append("txt", insertText);
        form.append("img", img.files[0]);
        form.append("name", name);
        form.append("size", size);
        form.append("package", package);

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = JSON.parse(request.responseText);

                var msg = response.txt;
                var color = response.status;

                toast(msg, color);

                document.getElementById("insertText").value = '';
                document.getElementById("name").value = '';
                document.getElementById("size").value = '';
                document.getElementById("package").selectedIndex = 0;
                document.getElementById("img").value = '';
                document.getElementById("imgtag").classList.add("d-none");

                loadManageAccommodation();

            }
        }

        request.open("POST", "addNewAccommodation.php", true);
        request.send(form);
    }

}

function Deleteaccommodation(id) {

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

            loadManageAccommodation();

        }
    }
    r.open("POST", "Deleteaccommodation.php", true);
    r.send(f);
}

function UpdateaccommodationImage(id) {

    var img = document.getElementById("AFile" + id).files[0];
    var url = URL.createObjectURL(img);
    document.getElementById("AFileImg" + id).src = url;

}


function Uplocadaccommodation(id) {

    var img = document.getElementById("AFile" + id);
    var name = document.getElementById("mName" + id).value;
    var size = document.getElementById("mSize" + id).value;
    var package = document.getElementById("mPackage" + id).value;
    var textArea = document.getElementById("TextArea" + id).value;

    if (name.trim() == "") {

        document.getElementById("mName" + id).classList.add("border-danger");
        var msg = "Please Insert The Name";
        var color = "bg-warning";

        toast(msg, color);

    } else if (size.trim() == "") {

        document.getElementById("mSize" + id).classList.add("border-danger");
        var msg = "Please Insert The Size";
        var color = "bg-warning";

        toast(msg, color);

    } else if (textArea.trim() == "") {

        document.getElementById("TextArea" + id).classList.add("border-danger");
        var msg = "Please Insert The Description";
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
        form.append("size", size);
        form.append("package", package);
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
                    loadManageAccommodation();

                    var msg = "Update Success";
                    var color = "bg-success";
                    toast(msg, color);
                } else {
                    alert(response);
                }
            }
        }
        request.open("POST", "updateAccommodation.php", true);
        request.send(form);

    }

}