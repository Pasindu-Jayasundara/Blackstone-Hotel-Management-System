window.addEventListener("load",()=>{
    loadManageDining();
});

function loadManageDining(){
    var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = request.responseText;

                document.getElementById("manageDiningDiv").innerHTML="";
                document.getElementById("manageDiningDiv").innerHTML=response;

            }
        }

        request.open("POST", "loadAvailableDinings.php", true);
        request.send();
}

function diimgloadtmp() {
    var img = document.getElementById("diimg").files[0];
    var url = URL.createObjectURL(img);
    document.getElementById("diimgtag").classList.remove("d-none");
    document.getElementById("diimgtag").src = url;
    document.getElementById("diimglabel").innerHTML = "Change Image";
}

function di_add_new() {
    var img = document.getElementById("diimg");
    var type = document.getElementById("ditype").value;
    var category = document.getElementById("dicategory").value;
    var name = document.getElementById("diname").value;
    var prize = document.getElementById("diprize").value;

    if (name.trim() == '') {
        var msg = "Insert Dining Name";
        var color = "bg-warning";
        toast(msg, color);
    } else if (name.length > 44) {
        var msg = "Name Too Long";
        var color = "bg-warning";
        toast(msg, color);
    } else if (type <= 0) {
        var msg = "Select Dining Type";
        var color = "bg-warning";
        toast(msg, color);
    } else if (category <= 0) {
        var msg = "Select Dining Type";
        var color = "bg-warning";
        toast(msg, color);
    } else if (img.files.length == 0) {
        var msg = "Select Dining Image";
        var color = "bg-warning";
        toast(msg, color);
    } else if (prize <= 0) {
        var msg = "Insert The Dining Price";
        var color = "bg-warning";
        toast(msg, color);
    }else {
        var form = new FormData();
        form.append("img", img.files[0]);
        form.append("name", name);
        form.append("type", type);
        form.append("category", category);
        form.append("prize", prize);

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                var response = JSON.parse(request.responseText);

                var msg = response.txt;
                var color = response.status;

                toast(msg, color);

                document.getElementById("diname").value = '';
                document.getElementById("diprize").value = '';
                document.getElementById("ditype").selectedIndex = 0;
                document.getElementById("dicategory").selectedIndex = 0;
                document.getElementById("diimg").value = '';
                document.getElementById("diimgtag").classList.add("d-none");

                loadManageDining();

            }
        }

        request.open("POST", "addNewDining.php", true);
        request.send(form);
    }

}

function deleteDining(id) {

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

            loadManageDining();

        }
    }
    r.open("POST", "deleteDining.php", true);
    r.send(f);
}

function updateDiningImage(id) {

    var img = document.getElementById("diUAFile" + id).files[0];
    var url = URL.createObjectURL(img);
    document.getElementById("diUAFileImg" + id).src = url;

}


function updateDining(id) {

    var img = document.getElementById("diUAFile" + id);
    var name = document.getElementById("diUName" + id).value;
    var u_price = document.getElementById("diUPrize" + id).value;
    var u_type = document.getElementById("diUType" + id).value;
    var u_category = document.getElementById("diUCategory" + id).value;

    if (name.trim() == "") {

        document.getElementById("diUName" + id).classList.add("border-danger");
        var msg = "Please Insert The Name";
        var color = "bg-warning";

        toast(msg, color);

    }else if (u_price <= 0) {

        document.getElementById("diUPrize" + id).classList.add("border-danger");
        var msg = "Please Insert The Prize";
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
        form.append("price", u_price);
        form.append("category", u_category);
        form.append("type", u_type);

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
                    loadManageDining();

                    var msg = "Update Success";
                    var color = "bg-success";
                    toast(msg, color);
                } else {
                    alert(response);
                }
            }
        }
        request.open("POST", "updateDining.php", true);
        request.send(form);

    }

}