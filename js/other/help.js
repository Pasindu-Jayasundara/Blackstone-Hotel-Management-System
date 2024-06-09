function HelpSendEmail() {

    var from = document.getElementById("from").value;
    var Topic = document.getElementById("topic").value;
    var Text = document.getElementById("Text").value;

    if (from.trim() == "") {

        var msg = "Please Insert Your Email Address";
        var color = "bg-warning";
        toast(msg, color);

    } else if (Topic.trim() == "") {

        var msg = "Please Insert Your Topic";
        var color = "bg-warning";
        toast(msg, color);

    } else if (Text.trim() == "") {

        var msg = "Please Insert Your Message";
        var color = "bg-warning";
        toast(msg, color);

    } else {

        var msg = "Email Sending Started ...";
        var color = "bg-info";
        toast(msg, color);

        var f = new FormData();
        f.append("from", from);
        f.append("topic", Topic);
        f.append("text", Text);


        var r = new XMLHttpRequest();

        r.onreadystatechange = function () {
            if (r.readyState == 4 && r.status == 200) {
                var txt = r.responseText;

                if(txt == 1){
                    var msg = "Provide Necessary Details ...";
                    var color = "bg-danger";
                    toast(msg, color);
                }else if(txt == 2){
                    var msg = "Invalid Email Address ...";
                    var color = "bg-danger";
                    toast(msg, color);
                }else if(txt == 3){
                    var msg = "Email Sending Success ...";
                    var color2 = "bg-success";
                    toast(msg, color2);

                    setTimeout(() => {
                        window.location.reload();
                    }, 850);
                }else if(txt == 4){
                    var msg = "Email Sending Faild ...";
                    var color = "bg-danger";
                    toast(msg, color);
                }else {
                    alert(txt);
                }
                
            }
        }

        r.open("POST", "GetHelpFromGladius.php", true);
        r.send(f);

    }

}