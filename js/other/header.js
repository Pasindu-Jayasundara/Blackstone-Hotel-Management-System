window.addEventListener("resize",()=>{

    window.location.reload();

});

window.addEventListener("scroll",()=>{

    var videoPosition = document.getElementById("video").getBoundingClientRect();
    if(videoPosition.top < -12){
        document.getElementById("bgcolor").style.backgroundColor="#002e3d9b";
        document.getElementById("bgcolor").style.transitionDuration="1s";
    }else if(videoPosition.top > -5){
        document.getElementById("bgcolor").style.backgroundColor="#002E3D";
        document.getElementById("bgcolor").style.transitionDuration=".2s";
    }

});


window.addEventListener("load",()=>{

    var accomodation = document.getElementById("page1");
    var dining = document.getElementById("page2");
    var wedding = document.getElementById("page3");
    var event = document.getElementById("page4");
    var offers = document.getElementById("page5");
    var gallery = document.getElementById("page6");


    var page = window.location.href.split("/").pop();
    
    if(page == "wedding.php"){
        wedding.classList.remove("d-none");
        
        accomodation.classList.add("d-none");
        dining.classList.add("d-none");
        event.classList.add("d-none");
        offers.classList.add("d-none");
        gallery.classList.add("d-none");
        
        document.getElementById("spage3").classList.remove("d-none");

        document.getElementById("spage1").classList.add("d-none");
        document.getElementById("spage2").classList.add("d-none");
        document.getElementById("spage4").classList.add("d-none");
        document.getElementById("spage5").classList.add("d-none");
        document.getElementById("spage6").classList.add("d-none");

    }else if(page == "" || page=="index.php"){

        wedding.classList.add("d-none");
        accomodation.classList.add("d-none");
        dining.classList.add("d-none");
        event.classList.add("d-none");
        offers.classList.add("d-none");
        gallery.classList.add("d-none");

        document.getElementById("spage3").classList.add("d-none");
        document.getElementById("spage1").classList.add("d-none");
        document.getElementById("spage2").classList.add("d-none");
        document.getElementById("spage4").classList.add("d-none");
        document.getElementById("spage5").classList.add("d-none");
        document.getElementById("spage6").classList.add("d-none");


    }else if(page == "accommodation.php"){
        accomodation.classList.remove("d-none");
        
        wedding.classList.add("d-none");
        dining.classList.add("d-none");
        event.classList.add("d-none");
        offers.classList.add("d-none");
        gallery.classList.add("d-none");
        
        document.getElementById("spage1").classList.remove("d-none");

        document.getElementById("spage3").classList.add("d-none");
        document.getElementById("spage2").classList.add("d-none");
        document.getElementById("spage4").classList.add("d-none");
        document.getElementById("spage5").classList.add("d-none");
        document.getElementById("spage6").classList.add("d-none");

    }else if(page == "dining.php"){
        dining.classList.remove("d-none");
        
        accomodation.classList.add("d-none");
        wedding.classList.add("d-none");
        event.classList.add("d-none");
        offers.classList.add("d-none");
        gallery.classList.add("d-none");
        
        document.getElementById("spage2").classList.remove("d-none");
        
        document.getElementById("spage1").classList.add("d-none");
        document.getElementById("spage3").classList.add("d-none");
        document.getElementById("spage4").classList.add("d-none");
        document.getElementById("spage5").classList.add("d-none");
        document.getElementById("spage6").classList.add("d-none");

    }else if(page == "offer.php"){
        offers.classList.remove("d-none");
        
        dining.classList.add("d-none");
        accomodation.classList.add("d-none");
        wedding.classList.add("d-none");
        event.classList.add("d-none");
        gallery.classList.add("d-none");
        
        document.getElementById("spage5").classList.remove("d-none");
        
        document.getElementById("spage2").classList.add("d-none");
        document.getElementById("spage1").classList.add("d-none");
        document.getElementById("spage3").classList.add("d-none");
        document.getElementById("spage4").classList.add("d-none");
        document.getElementById("spage6").classList.add("d-none");

    }else if(page == "event.php"){
        event.classList.remove("d-none");
        
        dining.classList.add("d-none");
        accomodation.classList.add("d-none");
        wedding.classList.add("d-none");
        offers.classList.add("d-none");
        gallery.classList.add("d-none");
        
        document.getElementById("spage4").classList.remove("d-none");
        
        document.getElementById("spage2").classList.add("d-none");
        document.getElementById("spage1").classList.add("d-none");
        document.getElementById("spage3").classList.add("d-none");
        document.getElementById("spage5").classList.add("d-none");
        document.getElementById("spage6").classList.add("d-none");

    }else if(page == "gallery.php"){
        gallery.classList.remove("d-none");
        
        dining.classList.add("d-none");
        accomodation.classList.add("d-none");
        wedding.classList.add("d-none");
        offers.classList.add("d-none");
        event.classList.add("d-none");
        
        document.getElementById("spage6").classList.remove("d-none");
        
        document.getElementById("spage2").classList.add("d-none");
        document.getElementById("spage1").classList.add("d-none");
        document.getElementById("spage3").classList.add("d-none");
        document.getElementById("spage5").classList.add("d-none");
        document.getElementById("spage4").classList.add("d-none");

    }


});

document.getElementById("smalllogo").addEventListener("click",()=>{
    window.location.href="../user/index.php";
});