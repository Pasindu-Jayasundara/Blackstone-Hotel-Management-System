window.addEventListener("load", () => {
    loadGalleryWedding();
    loadGalleryEvent();
    loadGalleryAccommodation();
    loadGalleryDining();
    loadGalleryExploration();
});

var gCount = 1;
function loadGalleryWedding() {

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = JSON.parse(request.responseText);

            var weddingDiv = document.getElementById("wedding");

            if (response.status == 1) {

                if (weddingDiv.classList.contains("d-none")) {
                    weddingDiv.classList.remove("d-none");
                }

                if (gCount == 1 ) {
                    weddingDiv.style.backgroundImage = "url('" + response.arr[0] + "')";

                    gCount = 2;
                }


                if (window.innerWidth >= 1520) {
                    document.getElementById("img1").setAttribute("xlink:href", response.arr[1]);
                    document.getElementById("img2").setAttribute("xlink:href", response.arr[2]);
                    document.getElementById("img3").setAttribute("xlink:href", response.arr[3]);
                    document.getElementById("img4").setAttribute("xlink:href", response.arr[4]);
                    document.getElementById("img5").setAttribute("xlink:href", response.arr[5]);
                    document.getElementById("img6").setAttribute("xlink:href", response.arr[6]);
                    document.getElementById("img7").setAttribute("xlink:href", response.arr[7]);
                } else {
                    document.getElementById("bu1Img").setAttribute("src", response.arr[1]);
                    document.getElementById("bu2Img").setAttribute("src", response.arr[2]);
                    document.getElementById("bu3Img").setAttribute("src", response.arr[3]);
                    document.getElementById("bu4Img").setAttribute("src", response.arr[4]);
                    document.getElementById("bu5Img").setAttribute("src", response.arr[5]);
                    document.getElementById("bu6Img").setAttribute("src", response.arr[6]);
                    document.getElementById("bu7Img").setAttribute("src", response.arr[7]);
                }

            } else if (response.status == 2) {
                if (!weddingDiv.classList.contains("d-none")) {
                    weddingDiv.classList.add("d-none");
                }
            }

            if (window.innerWidth >= 1520) {
                setTimeout(() => {
                    loadGalleryWedding();
                }, 10000);
            }

        }
    };
    request.open("POST", "loadGalleryWedding.php", true);
    request.send();

}

var eCount = 1;
function loadGalleryEvent() {

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = JSON.parse(request.responseText);

            var eventDiv = document.getElementById("event");

            if (response.status == 1) {

                if (eventDiv.classList.contains("d-none")) {
                    eventDiv.classList.remove("d-none");
                }

                if (eCount == 1) {
                    eventDiv.style.backgroundImage = "url('" + response.arr[0] + "')";
                    eCount = 2;
                }

                document.getElementById("eImg1").setAttribute("src", response.arr[1]);
                document.getElementById("eImg2").setAttribute("src", response.arr[2]);
                document.getElementById("eImg3").setAttribute("src", response.arr[3]);
                document.getElementById("eImg4").setAttribute("src", response.arr[4]);
                document.getElementById("eImg5").setAttribute("src", response.arr[5]);
                document.getElementById("eImg6").setAttribute("src", response.arr[6]);

            } else if (response.status == 2) {
                if (!eventDiv.classList.contains("d-none")) {
                    eventDiv.classList.add("d-none");
                }
            }

            setTimeout(() => {
                loadGalleryEvent();
            }, 10000);

        }
    };
    request.open("POST", "loadGalleryEvent.php", true);
    request.send();

}

var aCount = 1;
function loadGalleryAccommodation() {

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = JSON.parse(request.responseText);

            var accommodationDiv = document.getElementById("accommodation");

            if (response.status == 1) {

                if (accommodationDiv.classList.contains("d-none")) {
                    accommodationDiv.classList.remove("d-none");
                }

                if (aCount == 1) {
                    accommodationDiv.style.backgroundImage = "url('" + response.arr[0] + "')";
                    aCount = 2;
                }

                document.getElementById("aImg1").setAttribute("src", response.arr[1]);
                document.getElementById("aImg2").setAttribute("src", response.arr[2]);
                document.getElementById("aImg3").setAttribute("src", response.arr[3]);
                document.getElementById("aImg4").setAttribute("src", response.arr[4]);
                document.getElementById("aImg5").setAttribute("src", response.arr[5]);
                document.getElementById("aImg6").setAttribute("src", response.arr[6]);
                document.getElementById("aImg7").setAttribute("src", response.arr[7]);

            } else if (response.status == 2) {
                if (!accommodationDiv.classList.contains("d-none")) {
                    accommodationDiv.classList.add("d-none");
                }
            }

            setTimeout(() => {
                loadGalleryAccommodation();
            }, 10000);

        }
    };
    request.open("POST", "loadGalleryAccommodation.php", true);
    request.send();

}

var dCount = 1;
function loadGalleryDining() {

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = JSON.parse(request.responseText);

            var diningDiv = document.getElementById("dining");

            if (response.status == 1) {

                if (diningDiv.classList.contains("d-none")) {
                    diningDiv.classList.remove("d-none");
                }

                if (dCount == 1) {
                    diningDiv.style.backgroundImage = "url('" + response.arr[0] + "')";
                    dCount = 2;
                }

                document.getElementById("dImg1").setAttribute("src", response.arr[1]);
                document.getElementById("dImg2").setAttribute("src", response.arr[2]);
                document.getElementById("dImg3").setAttribute("src", response.arr[3]);
                document.getElementById("dImg4").setAttribute("src", response.arr[4]);
                document.getElementById("dImg5").setAttribute("src", response.arr[5]);
                document.getElementById("dImg6").setAttribute("src", response.arr[6]);
                document.getElementById("dImg7").setAttribute("src", response.arr[7]);
                document.getElementById("dImg8").setAttribute("src", response.arr[8]);

            } else if (response.status == 2) {
                if (!diningDiv.classList.contains("d-none")) {
                    diningDiv.classList.add("d-none");
                }
            }

            setTimeout(() => {
                loadGalleryDining();
            }, 10000);

        }
    };
    request.open("POST", "loadGalleryDining.php", true);
    request.send();

}

var eCount = 1;
function loadGalleryExploration() {

    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            var response = JSON.parse(request.responseText);

            var explorationDiv = document.getElementById("exploration");

            if (response.status == 1) {

                if (explorationDiv.classList.contains("d-none")) {
                    explorationDiv.classList.remove("d-none");
                }

                if (eCount == 1) {
                    explorationDiv.style.backgroundImage = "url('" + response.arr[0] + "')";
                    eCount = 2;
                }

                document.getElementById("eImg1").setAttribute("src", response.arr[1]);
                document.getElementById("eImg2").setAttribute("src", response.arr[2]);
                document.getElementById("eImg3").setAttribute("src", response.arr[3]);
                document.getElementById("eImg4").setAttribute("src", response.arr[4]);
                document.getElementById("eImg5").setAttribute("src", response.arr[5]);
                document.getElementById("eImg6").setAttribute("src", response.arr[6]);
                document.getElementById("eImg7").setAttribute("src", response.arr[7]);

            } else if (response.status == 2) {
                if (!explorationDiv.classList.contains("d-none")) {
                    explorationDiv.classList.add("d-none");
                }
            }

            setTimeout(() => {
                loadGalleryExploration();
            }, 10000);

        }
    };
    request.open("POST", "loadGalleryExploration.php", true);
    request.send();

}


