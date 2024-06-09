window.addEventListener("load",()=>{
    loadManageEvent();
});

function loadManageEvent(){
    var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = request.responseText;

                document.getElementById("manageEventDiv").innerHTML="";
                document.getElementById("manageEventDiv").innerHTML=response;

            }
        }

        request.open("POST", "loadAvailableEvents.php", true);
        request.send();
}

function eventimgloadtmp() {
    var img = document.getElementById("evimg").files[0];
    var url = URL.createObjectURL(img);
    document.getElementById("evimgtag").classList.remove("d-none");
    document.getElementById("evimgtag").src = url;
    document.getElementById("evimglabel").innerHTML = "Change Image";
}

function ev_add_new() {
    var img = document.getElementById("evimg");
    var insertText = document.getElementById("evdescription").value;
    var name = document.getElementById("evfeature").value;

    if (name.trim() == '') {
        var msg = "Insert Feature Name";
        var color = "bg-warning";
        toast(msg, color);
    } else if (name.length > 44) {
        var msg = "Feature Too Long";
        var color = "bg-warning";
        toast(msg, color);
    } else if (img.files.length == 0) {
        var msg = "Select Event Image";
        var color = "bg-warning";
        toast(msg, color);
    } else if (insertText.trim() == '') {
        var msg = "Insert Event Description";
        var color = "bg-warning";
        toast(msg, color);
    } else if (insertText.length > 44) {
        var msg = "Event Description Too Long";
        var color = "bg-warning";
        toast(msg, color);
    } else {
        var form = new FormData();
        form.append("txt", insertText);
        form.append("img", img.files[0]);
        form.append("feature", name);

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = JSON.parse(request.responseText);

                var msg = response.txt;
                var color = response.status;

                toast(msg, color);

                document.getElementById("evdescription").value = '';
                document.getElementById("evfeature").value = '';
                document.getElementById("evimg").value = '';
                document.getElementById("evimgtag").classList.add("d-none");

                loadManageEvent();

            }
        }

        request.open("POST", "addNewEvent.php", true);
        request.send(form);
    }

}

function deleteEvent(id) {

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

            loadManageEvent();
        }
    }
    r.open("POST", "DeleteEvent.php", true);
    r.send(f);
}

function UpdateEventImage(id) {

    var img = document.getElementById("evAFile" + id).files[0];
    var url = URL.createObjectURL(img);
    document.getElementById("evAFileImg" + id).src = url;

}


function updateEvent(id) {

    var img = document.getElementById("evAFile" + id);
    var name = document.getElementById("eFeature" + id).value;
    var textArea = document.getElementById("evTextArea" + id).value;

    if (name.trim() == "") {

        document.getElementById("eFeature" + id).classList.add("border-danger");
        var msg = "Please Insert The Name";
        var color = "bg-warning";

        toast(msg, color);

    } else if (textArea.trim() == "") {

        document.getElementById("evTextArea" + id).classList.add("border-danger");
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
                    loadManageEvent();

                    var msg = "Update Success";
                    var color = "bg-success";
                    toast(msg, color);
                } else {
                    alert(response);
                }
            }
        }
        request.open("POST", "updateEvent.php", true);
        request.send(form);

    }

}