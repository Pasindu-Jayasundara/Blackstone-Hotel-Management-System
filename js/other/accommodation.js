// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}


var status1 = 1;
function onload2() {


    var f = new FormData();
    f.append("status", status1);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var txt = r.responseText;
            if (txt == "reset") {
                status1 = 1;
            } else {
                status1 = status1 + 1;
                document.getElementById("WelcomeImage1").src = txt;
            }
        }
    }

    r.open("POST", "ChangeDinginWelcomeImages.php", true);
    r.send(f);

}