window.addEventListener("load",()=>{
    loadManageExploration();
});

function loadManageExploration(){
    var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = request.responseText;

                document.getElementById("manageExplorationDiv").innerHTML="";
                document.getElementById("manageExplorationDiv").innerHTML=response;

            }
        }

        request.open("POST", "loadAvailableExplorations.php", true);
        request.send();
}

function expimgloadtmp() {
    var img = document.getElementById("expimg").files[0];
    var url = URL.createObjectURL(img);
    document.getElementById("expimgtag").classList.remove("d-none");
    document.getElementById("expimgtag").src = url;
    document.getElementById("expimglabel").innerHTML = "Change Image";
}

function exp_add_new() {
    var img = document.getElementById("expimg");
    var insertText = document.getElementById("expinsertText").value;
    var name = document.getElementById("expname").value;

    if (name.trim() == '') {
        var msg = "Insert Exploration Place Name";
        var color = "bg-warning";
        toast(msg, color);
    } else if (name.length > 44) {
        var msg = "Name Too Long";
        var color = "bg-warning";
        toast(msg, color);
    } else if (img.files.length == 0) {
        var msg = "Select Exploration Image";
        var color = "bg-warning";
        toast(msg, color);
    } else if (insertText.trim() == '') {
        var msg = "Insert Exploration Description";
        var color = "bg-warning";
        toast(msg, color);
    } else if (insertText.length > 44) {
        var msg = "Exploration Description Too Long";
        var color = "bg-warning";
        toast(msg, color);
    } else {
        var form = new FormData();
        form.append("txt", insertText);
        form.append("img", img.files[0]);
        form.append("name", name);

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = JSON.parse(request.responseText);

                var msg = response.txt;
                var color = response.status;

                toast(msg, color);

                document.getElementById("expinsertText").value = '';
                document.getElementById("expname").value = '';
                document.getElementById("expimg").value = '';
                document.getElementById("expimgtag").classList.add("d-none");

                loadManageExploration();

            }
        }

        request.open("POST", "addNewExploration.php", true);
        request.send(form);
    }

}

function deleteExploration(id) {

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

            loadManageExploration();
            
        }
    }
    r.open("POST", "DeleteExploration.php", true);
    r.send(f);
}

function updateExplorationImage(id) {

    var img = document.getElementById("expAFile" + id).files[0];
    var url = URL.createObjectURL(img);
    document.getElementById("expAFileImg" + id).src = url;

}


function updateExploration(id) {

    var img = document.getElementById("expAFile" + id);
    var name = document.getElementById("expName" + id).value;
    var textArea = document.getElementById("expTextArea" + id).value;

    if (name.trim() == "") {

        document.getElementById("expName" + id).classList.add("border-danger");
        var msg = "Please Insert The Name";
        var color = "bg-warning";

        toast(msg, color);

    }  else if (textArea.trim() == "") {

        document.getElementById("expTextArea" + id).classList.add("border-danger");
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
                    loadManageExploration();

                    var msg = "Update Success";
                    var color = "bg-success";
                    toast(msg, color);
                } else {
                    alert(response);
                }
            }
        }
        request.open("POST", "updateExploration.php", true);
        request.send(form);

    }

}