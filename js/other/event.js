window.addEventListener("load",()=>{
loadEventCarousel();
eventDescriptions();
eventContent();
});

function loadEventCarousel(){
    var request = new XMLHttpRequest();
    request.onreadystatechange=function(){
        if(request.readyState==4&&request.status==200){
            document.getElementById("eventCarousel").innerHTML=request.responseText;
            document.getElementById("eventCarousel").firstElementChild.classList.add("active");
        }
    };
    request.open("POST","loadEventCarousel.php",true);
    request.send();
}

function eventDescriptions(){
    var request = new XMLHttpRequest();
    request.onreadystatechange=function(){
        if(request.readyState==4&&request.status==200){
            document.getElementById("eventDescriptions").innerHTML=request.responseText;

            setTimeout(() => {
                eventDescriptions();
            }, 8000);
        }
    };
    request.open("POST","loadEventDescription.php",true);
    request.send();
}

function eventContent(){
    var request = new XMLHttpRequest();
    request.onreadystatechange=function(){
        if(request.readyState==4&&request.status==200){
            document.getElementById("eventContent").innerHTML=request.responseText;

            setTimeout(() => {
                eventContent();
            }, 100000);
        }
    };
    request.open("POST","loadEventContent.php",true);
    request.send();
}