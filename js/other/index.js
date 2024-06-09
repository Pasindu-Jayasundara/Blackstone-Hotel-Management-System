window.addEventListener("load", () => {

    if (window.innerWidth >= 992) {//large

        document.getElementById("carousel").style.marginTop = "-49%";
        document.getElementById("offertag").style.marginTop = "-25%";
        document.getElementById("line").style.marginTop = "-6%";
        document.getElementById("bookNowBtn").classList.add("d-flex");
        document.getElementById("bookNowBtn").classList.add("align-items-center");

        document.getElementById("whitebg").classList.remove("d-none");

    } else if (window.innerWidth >= 768 && window.innerWidth < 992) { //medium

        document.getElementById("carousel").style.marginTop = "-48.5%";
        document.getElementById("offertag").style.marginTop = "-33%";
        document.getElementById("line").style.marginTop = "-9.5%";
        document.getElementById("leftImg").style.width = "30%";
        document.getElementById("rightImg").style.width = "30%";
        document.getElementById("imgAcc").style.marginTop = "33%";
        document.getElementById("bookNowBtn").classList.add("d-flex");
        document.getElementById("bookNowBtn").classList.add("align-items-center");

        document.getElementById("whitebg3").classList.remove("d-none");


    } else if (window.innerWidth < 768) { //small

        document.getElementById("bookNowBtn").classList.replace("fs-3", "fs-6");
        document.getElementById("bookNowBtn").classList.add("position-absolute");
        document.getElementById("bookNowBtn").style.marginTop = "-50.5%";
        document.getElementById("bookNowBtn").classList.add("col-6");
        document.getElementById("bookNowBtn").classList.add("d-grid");
        document.getElementById("bookNowBtn").classList.add("offset-3");
        document.getElementById("infoDisplay").classList.remove("position-absolute");
        document.getElementById("offercoursel").style.marginTop = "-28%";
        document.getElementById("line").style.marginTop = "-30%";
        document.getElementById("offertag2").style.marginLeft = "-2%";
        document.getElementById("welcometext").style.marginTop = "15%";
        document.getElementById("middleImgWelcome").style.width = "80%";
        document.getElementById("middleImgAcco").style.width = "90%";
        document.getElementById("explorationDiv").style.marginTop = "80.5%";
        document.getElementById("explorationP").style.height = "35vh";
        document.getElementById("explorationP").style.overflowY = "scroll";
        document.getElementById("explorationpDiv").style.width = "100vh";
        
        document.getElementById("whitebg2").classList.remove("d-none");

    }

    document.getElementById("offeractive").firstElementChild.classList.add("active");


    // load
    repeat();
    accomodation();
    exploration();


});



function repeat() {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            
            var response = JSON.parse(request.responseText);

            if (response.acc_status == 1) {
                document.getElementById("wel1").style.transitionDuration = "0.5";
                document.getElementById("wel1").src = response.acc.url;
            }
            if (response.dining_status == 1) {
                document.getElementById("middleImgWelcome").style.transitionDuration = "0.5";
                document.getElementById("middleImgWelcome").src = response.dining.path;
            }
            if (response.exp_status == 1) {
                document.getElementById("wel2").style.transitionDuration = "0.5";
                document.getElementById("wel2").src = response.exp.url;
            }

            setTimeout(() => {
                repeat();
            }, 5000);

        }
    }
    request.open("POST", "loadIndexWelcome.php", true);
    request.send();
}

function accomodation() {

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {

            var response = JSON.parse(request.responseText);

            if (response.acc_status == 1) {

                document.getElementById("leftImg").style.transitionDuration = "0.5";
                document.getElementById("leftImg").src = response.acc[0];

                document.getElementById("middleImgAcco").style.transitionDuration = "0.5";
                document.getElementById("middleImgAcco").src = response.acc[1];

                document.getElementById("rightImg").style.transitionDuration = "0.5";
                document.getElementById("rightImg").src = response.acc[2];

            }

            setTimeout(() => {
                accomodation();
            }, 5000);

        }
    }
    request.open("POST", "welcomeAccCard.php", true);
    request.send();

}


function exploration(){

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {

            var response = JSON.parse(request.responseText);

            if (response.exp_status == 1) {

                document.getElementById("expbgimg").style.transitionDuration = "0.5";
                document.getElementById("expbgimg").src = response.exp.url;

                document.getElementById("explorationP").innerHTML = response.exp.description;

            }

            setTimeout(() => {
                exploration();
            }, 9000);

        }
    }
    request.open("POST", "welcomeExp.php", true);
    request.send();

}