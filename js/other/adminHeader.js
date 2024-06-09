window.addEventListener("load",()=>{

    var location = document.getElementById("location");

    var page = window.location.href.split("/").pop();
    if(page == "dashboard.php"){
        location.innerHTML="Dashboard";
    }

});

