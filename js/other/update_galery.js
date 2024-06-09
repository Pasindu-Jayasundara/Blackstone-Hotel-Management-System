window.addEventListener("load", () => {
    loadManageGallery();
});

function loadManageGallery() {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = request.responseText;

            document.getElementById("manageGalleryDiv").innerHTML = "";
            document.getElementById("manageGalleryDiv").innerHTML = response;

        }
    }

    request.open("POST", "loadAvailableGallery.php", true);
    request.send();
}

function glimgloadtmp() {
    var img = document.getElementById("glimg").files[0];
    var url = URL.createObjectURL(img);
    document.getElementById("glimgtag").classList.remove("d-none");
    document.getElementById("glimgtag").src = url;
    document.getElementById("glimglabel").innerHTML = "Change Image";
}

function gl_add_new() {
    var img = document.getElementById("glimg");
    var package = document.getElementById("gltype").value;

    if (package == 0) {
        var msg = "Select Gallery Type";
        var color = "bg-warning";
        toast(msg, color);
    } else if (img.files.length == 0) {
        var msg = "Select Gallery Image";
        var color = "bg-warning";
        toast(msg, color);
    } else {
        var form = new FormData();
        form.append("img", img.files[0]);
        form.append("package", package);

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = JSON.parse(request.responseText);

                var msg = response.txt;
                var color = response.status;

                toast(msg, color);

                document.getElementById("gltype").selectedIndex = 0;
                document.getElementById("glimg").value = '';
                document.getElementById("glimgtag").classList.add("d-none");

                loadManageGallery();

            }
        }

        request.open("POST", "addNewGallery.php", true);
        request.send(form);
    }

}

function deleteGallery(id) {

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

            loadManageGallery();

        }
    }
    r.open("POST", "DeleteGallery.php", true);
    r.send(f);
}

function updateGalleryImage(id) {

    var img = document.getElementById("glAFile" + id).files[0];
    var url = URL.createObjectURL(img);
    document.getElementById("glAFileImg" + id).src = url;

}


function updateGallery(id) {

    var img = document.getElementById("glAFile" + id);
    var package = document.getElementById("gltype" + id).value;

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

    form.append("package", package);

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
                loadManageGallery();

                var msg = "Update Success";
                var color = "bg-success";
                toast(msg, color);
            } else {
                alert(response);
            }
        }
    }
    request.open("POST", "updateGallery.php", true);
    request.send(form);

}