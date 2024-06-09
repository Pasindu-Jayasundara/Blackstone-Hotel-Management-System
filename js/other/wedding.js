var small = 0;

window.addEventListener("load", () => {
    if (window.innerWidth >= 768 && window.innerWidth < 992) {//medium

        document.getElementById("introimg1").classList.replace("p1", "mediump1");
        document.getElementById("introimg2").classList.replace("p1", "mediump1");
        document.getElementById("introP").classList.remove("para1");
        document.getElementById("introP").classList.remove("fs-5");
        document.getElementById("introP").style.fontSize = "15px";

        document.getElementById("img").style.width = "17vw";
        document.getElementById("img2").style.width = "17vw";
        document.getElementById("img3").style.width = "17vw";
        document.getElementById("img4").style.width = "17vw";
        document.getElementById("foodcd").style.width = "95vw";

        document.getElementById("imgp").style.width = "20vw";
        document.getElementById("imgp2").style.width = "20vw";
        document.getElementById("imgp3").style.width = "20vw";
        document.getElementById("imgp4").style.width = "20vw";

        document.getElementById("foodimgdiv").classList.add("me-3");
        document.getElementById("foodimgdiv2").classList.add("me-3");
        document.getElementById("foodimgdiv3").classList.add("me-3");
        document.getElementById("foodimgdiv4").classList.add("me-3");

        document.getElementById("galdiv1").style.width = "170px";
        document.getElementById("galdiv1").style.height = "170px";
        document.getElementById("galdiv2").style.width = "170px";
        document.getElementById("galdiv2").style.height = "170px";
        document.getElementById("galdiv3").style.width = "170px";
        document.getElementById("galdiv3").style.height = "170px";
        document.getElementById("galdiv4").style.width = "170px";
        document.getElementById("galdiv4").style.height = "170px";

        document.getElementById("secsvgdiv1").style.width = "170px";
        document.getElementById("secsvgdiv1").style.height = "170px";
        document.getElementById("secsvgdiv2").style.width = "170px";
        document.getElementById("secsvgdiv2").style.height = "170px";
        document.getElementById("secsvgdiv3").style.width = "170px";
        document.getElementById("secsvgdiv3").style.height = "170px";

        document.getElementById("galscovediv").style.paddingLeft = "2.5%";
        document.getElementById("overflow").style.overflowX = "hidden";



        small = 0;

    } else if (window.innerWidth < 768) { // small

        document.getElementById("hallimg").classList.add("d-none");

        document.getElementById("introfDiv").style.paddingLeft = "0%";
        document.getElementById("introP").classList.add("d-flex");
        document.getElementById("introP").classList.add("justify-content-center");
        document.getElementById("introP").classList.replace("para1", "spara");
        document.getElementById("introP").classList.remove("fs-5");
        document.getElementById("cards").classList.add("d-none");
        document.getElementById("food").classList.add("flex-column");
        document.getElementById("fmt").classList.remove("ms-3");
        document.getElementById("fmt").classList.add("mt-4");
        document.getElementById("foodtext").classList.remove("ms-5");
        document.getElementById("foodtext").classList.replace("fs-5", "fs-6");
        document.getElementById("foodtext").classList.replace("text-center", "text-justify");
        document.getElementById("foodcd").classList.replace("flex-row", "flex-column");
        document.getElementById("foodcd").classList.remove("px-5");
        document.getElementById("foodcd").classList.replace("mx-5", "mx-4");

        document.getElementById("img").style.width = "67vw";
        document.getElementById("img").style.backgroundRepeat = "no-repeat";
        document.getElementById("imgp").style.width = "74vw";
        document.getElementById("imgp").style.marginLeft = "-4%";
        document.getElementById("foodimgdiv").classList.add("me-4");
        document.getElementById("foodimgdiv").classList.add("ms-2");

        document.getElementById("img2").style.width = "67vw";
        document.getElementById("img2").style.backgroundRepeat = "no-repeat";
        document.getElementById("imgp2").style.width = "74vw";
        document.getElementById("imgp2").style.marginLeft = "-4%";
        document.getElementById("foodimgdiv2").classList.add("me-4");
        document.getElementById("foodimgdiv2").classList.add("ms-2");

        document.getElementById("img3").style.width = "67vw";
        document.getElementById("img3").style.backgroundRepeat = "no-repeat";
        document.getElementById("imgp3").style.width = "74vw";
        document.getElementById("imgp3").style.marginLeft = "-4%";
        document.getElementById("foodimgdiv3").classList.add("me-4");
        document.getElementById("foodimgdiv3").classList.add("ms-2");

        document.getElementById("img4").style.width = "67vw";
        document.getElementById("img4").style.backgroundRepeat = "no-repeat";
        document.getElementById("imgp4").style.width = "74vw";
        document.getElementById("imgp4").style.marginLeft = "-4%";
        document.getElementById("foodimgdiv4").classList.add("me-4");
        document.getElementById("foodimgdiv4").classList.add("ms-2");

        document.getElementById("overflow").style.overflowX = "hidden";



        small = 1;

    }

    WhyUs();
    weddingHall();
    foods();
    gallery();
    wedingMainImg();


});




function wedingMainImg() {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {

        if (request.readyState == 4 && request.status == 200) {

            var response = JSON.parse(request.responseText);

            if (response.length == 1) {
                document.getElementById("img1").src = response[0];


                setTimeout(() => {
                    wedingMainImg();
                }, 6000);


            } else {
                wedingMainImg();
            }

        }

    }
    request.open("POST", "weddingMainImg.php", true);
    request.send();
}



function gallery() {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {

        if (request.readyState == 4 && request.status == 200) {

            var response = JSON.parse(request.responseText);

            if (response.length < 7) {

                document.getElementById("galeryContainer").classList.add("d-none");

            } else if (response.length == 7) {

                if (small == 1) {

                    document.getElementById("smallGallery").src = response[0];

                } else {

                    if (document.getElementById("galeryContainer").classList.contains("d-none")) {
                        document.getElementById("galeryContainer").classList.remove("d-none");
                    }

                    document.getElementById("svgImgF1").setAttribute("xlink:href", response[0]);
                    document.getElementById("svgImgF2").setAttribute("xlink:href", response[1]);
                    document.getElementById("svgImgF3").setAttribute("xlink:href", response[2]);
                    document.getElementById("svgImgF4").setAttribute("xlink:href", response[3]);

                    document.getElementById("svgImgS1").setAttribute("xlink:href", response[4]);
                    document.getElementById("svgImgS2").setAttribute("xlink:href", response[5]);
                    document.getElementById("svgImgS3").setAttribute("xlink:href", response[6]);

                }

                setTimeout(() => {
                    gallery();
                }, 5000);


            } else {
                document.getElementById("galeryContainer").classList.add("d-none");
                gallery();
            }

        }

    }
    request.open("POST", "weddingGalery.php", true);
    request.send();
}


function foods() {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {

        if (request.readyState == 4 && request.status == 200) {

            var response = JSON.parse(request.responseText);

            if (response.length > 0 && response.length <= 4) {

                for (var x = 1; x <= response.length; x++) {
                    if (x == 1) {
                        document.getElementById("foodimgdiv").classList.remove("d-none");
                        document.getElementById("img").src = response[x - 1].img;
                        document.getElementById("imgp").innerHTML = response[x - 1].food_name;
                    } else {
                        document.getElementById("foodimgdiv" + x).classList.remove("d-none");
                        document.getElementById("img" + x).src = response[x - 1].img;
                        document.getElementById("imgp" + x).innerHTML = response[x - 1].food_name;
                    }
                }

                foodDes(response);

                setTimeout(() => {
                    foodDes(response);
                }, 2000);

                setTimeout(() => {
                    foods();
                }, 8000);


            } else {
                foods();
            }

        }

    }
    request.open("POST", "weddingFoods.php", true);
    request.send();
}

var z = 0;
function foodDes(response) {

    if (response.length > z) {
        document.getElementById("foodtext").innerHTML = response[z].food_des;
        z = z + 1;
    } else {
        z = 0;
    }
}


function WhyUs() {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {

        if (request.readyState == 4 && request.status == 200) {

            var response = JSON.parse(request.responseText);

            if (response.length > 0) {

                if (small == 0) {

                    document.getElementById("card1p").innerHTML = response[0];
                    document.getElementById("card2p").innerHTML = response[1];
                    document.getElementById("card3p").innerHTML = response[3];
                    document.getElementById("card4p").innerHTML = response[4];
                    document.getElementById("card5p").innerHTML = response[5];
                    document.getElementById("card6p").innerHTML = response[6];

                    document.getElementById("whybgimg").src = response[7];

                } else if (small == 1) {

                    document.getElementById("scard1p").innerHTML = response[0];
                    document.getElementById("scard2p").innerHTML = response[1];
                    document.getElementById("scard3p").innerHTML = response[3];
                    document.getElementById("scard4p").innerHTML = response[4];
                    document.getElementById("scard5p").innerHTML = response[5];
                    document.getElementById("scard6p").innerHTML = response[6];

                }

                setTimeout(() => {
                    WhyUs();
                }, 8000);


            } else {
                WhyUs();
            }

        }

    }
    request.open("POST", "weddingWhyUs.php", true);
    request.send();
}





var weding_id;

function weddingHall() {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {

        if (request.readyState == 4 && request.status == 200) {

            var response = request.responseText;

            if (response.length > 0) {

                document.getElementById("hallName").classList.remove("d-none");
                document.getElementById("introfDiv").classList.remove("d-none");


                displayHall(response);


            } else {
                weddingHall();
            }

        }

    }
    request.open("POST", "weddinhHallLoad.php", true);
    request.send();
}


var x = 0;

function displayHall(json_response) {
    var response = JSON.parse(json_response);

    if (response.length > x) {

        document.getElementById("hallName").innerHTML = response[x].hall_name;
        document.getElementById("introP").innerHTML = response[x].hall_des;

        var y = 0;
        document.getElementById("introimg1").src = response[x].hall_img[y];
        document.getElementById("introimg2").src = response[x].hall_img[y + 1];

        x = x + 1;

        setTimeout(() => {
            displayHall(json_response)
        }, 5000);

    } else {
        x = 0;

        weddingHall();
    }

}