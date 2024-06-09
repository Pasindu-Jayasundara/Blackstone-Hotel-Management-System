window.addEventListener("load", () => {
    loadPrivacy();
});

var av = 1;

function loadPrivacy() {

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {

            var obj = JSON.parse(request.responseText);
            document.getElementById("pt").innerHTML = "";
            document.getElementById("pt").innerHTML = obj.txt;

            if (obj.status == 1) {
                document.getElementById("addp").innerHTML = "Update";
                document.getElementById("addp").classList.replace("btn-success", "btn-warning");
                av = 2;
            } else if (obj.status == 2) {
                document.getElementById("addp").innerHTML = "Add New";
                document.getElementById("addp").classList.replace("btn-warning", "btn-success");
                av = 1;
            }
        }
    };
    request.open("POST", "loadPrivacy.php", true);
    request.send();

}

function pr() {

    var ptxt = document.getElementById("pt").value;

    if (ptxt.trim() == "") {

        var msg = "Insert Privacy Policy";
        var color = "bg-warning";
        toast(msg, color);

    } else {

        var msg = "Update Started";
        var color = "bg-info";
        toast(msg, color);

        var form = new FormData();
        form.append("txt",ptxt);
        form.append("s",av);

        var request = new XMLHttpRequest();
        request.onreadystatechange = function () {
            if (request.readyState == 4 && request.status == 200) {
                
                if(request.responseText == 1){
                    var msg = "Insert Privacy Policy";
                    var color = "bg-warning";
                    toast(msg, color);
                }else if(request.responseText==2){
                    var msg = "Privacy Policy Updation Success";
                    var color = "bg-success";
                    toast(msg, color);
                }else if(request.responseText==3){
                    var msg = "Privacy Policy Adding Success";
                    var color = "bg-success";
                    toast(msg, color);
                }else{
                    alert(request.responseText);
                }

                loadPrivacy();

            }
        };
        request.open("POST", "updatePrivacy.php", true);
        request.send(form);

    }

}