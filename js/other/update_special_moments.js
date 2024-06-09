window.addEventListener("load",()=>{
    loadManageSpecialMoment();
});

function loadManageSpecialMoment(){
    var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = request.responseText;

                document.getElementById("manageSpecialMomentDiv").innerHTML="";
                document.getElementById("manageSpecialMomentDiv").innerHTML=response;

            }
        }

        request.open("POST", "loadAvailableSpecialMoments.php", true);
        request.send();
}

function smimgloadtmp() {
    var img = document.getElementById("smimg").files[0];
    var url = URL.createObjectURL(img);
    document.getElementById("smimgtag").classList.remove("d-none");
    document.getElementById("smimgtag").src = url;
    document.getElementById("smimglabel").innerHTML = "Change Image";
}

function sm_add_new() {
    var img = document.getElementById("smimg");
    var insertText = document.getElementById("sminsertText").value;

    if (img.files.length == 0) {
        var msg = "Select Special Moment Image";
        var color = "bg-warning";
        toast(msg, color);
    } else if (insertText.trim() == '') {
        var msg = "Insert Epecial Moment Description";
        var color = "bg-warning";
        toast(msg, color);
    } else if (insertText.length > 44) {
        var msg = "Special Moment Description Too Long";
        var color = "bg-warning";
        toast(msg, color);
    } else {
        var form = new FormData();
        form.append("txt", insertText);
        form.append("img", img.files[0]);

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = JSON.parse(request.responseText);

                var msg = response.txt;
                var color = response.status;

                toast(msg, color);

                document.getElementById("sminsertText").value = '';
                document.getElementById("smimg").value = '';
                document.getElementById("smimgtag").classList.add("d-none");

                loadManageSpecialMoment();

            }
        }

        request.open("POST", "addNewSpecialMoment.php", true);
        request.send(form);
    }

}

function deleteSpecialMoment(id) {

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

            loadManageSpecialMoment();

        }
    }
    r.open("POST", "DeleteSpecialMoments.php", true);
    r.send(f);
}

function updateSpecialMomentImage(id) {

    var img = document.getElementById("smAFile" + id).files[0];
    var url = URL.createObjectURL(img);
    document.getElementById("smAFileImg" + id).src = url;

}


function updateSpecialMoment(id) {

    var img = document.getElementById("smAFile" + id);
    var textArea = document.getElementById("smTextArea" + id).value;

    if (textArea.trim() == "") {

        document.getElementById("smTextArea" + id).classList.add("border-danger");
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
                    loadManageSpecialMoment();

                    var msg = "Update Success";
                    var color = "bg-success";
                    toast(msg, color);
                } else {
                    alert(response);
                }
            }
        }
        request.open("POST", "updateSpecialMoments.php", true);
        request.send(form);

    }

}