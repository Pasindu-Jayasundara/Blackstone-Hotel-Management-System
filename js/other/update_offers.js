window.addEventListener("load",()=>{
    loadManageOffer();
});

function loadManageOffer(){
    var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = request.responseText;

                document.getElementById("manageOfferDiv").innerHTML="";
                document.getElementById("manageOfferDiv").innerHTML=response;

            }
        }

        request.open("POST", "loadAvailableOffers.php", true);
        request.send();
}

function ofimgloadtmp() {
    var img = document.getElementById("ofimg").files[0];
    var url = URL.createObjectURL(img);
    document.getElementById("ofimgtag").classList.remove("d-none");
    document.getElementById("ofimgtag").src = url;
    document.getElementById("ofimglabel").innerHTML = "Change Image";
}

function of_add_new() {
    var img = document.getElementById("ofimg");
    var insertText = document.getElementById("ofinsertText").value;
    var ofSdt = document.getElementById("ofSdt").value;
    var ofedt = document.getElementById("ofedt").value;

    if (ofSdt == 0) {
        var msg = "Select Offer Start Date";
        var color = "bg-warning";
        toast(msg, color);
    }else if (ofedt == 0) {
        var msg = "Select Offer End Date";
        var color = "bg-warning";
        toast(msg, color);
    } else if (img.files.length == 0) {
        var msg = "Select Offer Image";
        var color = "bg-warning";
        toast(msg, color);
    } else if (insertText.trim() == '') {
        var msg = "Insert Offer Description";
        var color = "bg-warning";
        toast(msg, color);
    } else if (insertText.length > 44) {
        var msg = "Offer Description Too Long";
        var color = "bg-warning";
        toast(msg, color);
    } else {
        var form = new FormData();
        form.append("txt", insertText);
        form.append("img", img.files[0]);
        form.append("ofedt", ofedt);
        form.append("ofSdt", ofSdt);

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = JSON.parse(request.responseText);

                var msg = response.txt;
                var color = response.status;

                toast(msg, color);

                document.getElementById("ofinsertText").value = '';
                document.getElementById("ofSdt").value = '';
                document.getElementById("ofedt").value = '';
                document.getElementById("ofimg").value = '';
                document.getElementById("ofimgtag").classList.add("d-none");

                loadManageOffer();

            }
        }

        request.open("POST", "addNewOffer.php", true);
        request.send(form);
    }

}

function deleteOffer(id) {

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

            loadManageOffer();

        }
    }
    r.open("POST", "DeleteOffers.php", true);
    r.send(f);
}

function updateOfferImage(id) {

    var img = document.getElementById("ofAFile" + id).files[0];
    var url = URL.createObjectURL(img);
    document.getElementById("ofAFileImg" + id).src = url;

}


function updateOffer(id) {

    var img = document.getElementById("ofAFile" + id);
    var ofsdt = document.getElementById("ofsdt" + id).value;
    var ofedt = document.getElementById("ofedt" + id).value;
    var textArea = document.getElementById("ofTextArea" + id).value;

    if (textArea.trim() == "") {

        document.getElementById("ofTextArea" + id).classList.add("border-danger");
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

        form.append("ofsdt", ofsdt);
        form.append("ofedt", ofedt);
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
                    loadManageOffer();

                    var msg = "Update Success";
                    var color = "bg-success";
                    toast(msg, color);
                } else {
                    alert(response);
                }
            }
        }
        request.open("POST", "updateOffer.php", true);
        request.send(form);

    }

}