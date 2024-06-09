function UpdateSpecialMomentImage(id) {
    var file = document.getElementById("File" + id);


    var f = new FormData();
    f.append("id", id);
    f.append("file", file.files[0]);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var txt = r.responseText;
            alert(txt);
            window.location.reload();
        }
    }
    r.open("POST", "specialMomentUpdatePictures.php", true);
    r.send(f);

}


function UplocadSpeceialMoment(id) {

    var textArea = document.getElementById("TextArea" + id).value;
    alert(id);
    var f = new FormData();
    f.append("id", id);
    f.append("textArea", textArea);


    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var txt = r.responseText;
            alert(txt);
        }
    }
    r.open("POST", "SpecialMomentsDescriptionUpdatge.php", true);
    r.send(f);
}

function AddNewSpecialMoment() {
    var file = document.getElementById("AddSpecialMomentImage");
    var TextArea = document.getElementById("SpecialMomentAddTextArea").value;



    var f = new FormData();
    f.append("TextArea", TextArea);

    f.append("file", file.files[0]);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var txt = r.responseText;
            alert(txt);
            window.location.reload();
        }
    }
    r.open("POST", "AddNewSpecialMoment.php", true);
    r.send(f);
}

function DeleteSpecialMoment(id) {

    var f = new FormData();
    f.append("id", id);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var txt = r.responseText;
            alert(txt);
            window.location.reload();
        }
    }
    r.open("POST", "DeleteSpecialMoments.php", true);
    r.send(f);
}



function changeAddImagePicSpecial() {
    var file = document.getElementById("AddSpecialMomentImage1");
    var file1 = file.files[0]
    var url = window.URL.createObjectURL(file1);

    document.getElementById("AddImageTag1").src = url;

}




















///////////////////////////////////////////////////////////////////Accemndations Start



















///////////////////////////////////////////////////////////////////EVENTs


function UpdateEventsImage(id) {
    alert(id);

    var file = document.getElementById("File" + id);


    var f = new FormData();
    f.append("id", id);
    f.append("file", file.files[0]);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var txt = r.responseText;
            alert(txt);
            window.location.reload();
        }
    }
    r.open("POST", "EventUpdatePictures.php", true);
    r.send(f);

}


function Uplocadevent(id) {
    var textArea = document.getElementById("TextArea" + id).value;
    var f = new FormData();
    f.append("id", id);
    f.append("textArea", textArea);


    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var txt = r.responseText;
            alert(txt);
        }
    }
    r.open("POST", "EventDiscriptionUpdatge.php", true);
    r.send(f);
}


function DeleteEvent(id) {
    var f = new FormData();
    f.append("id", id);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var txt = r.responseText;
            alert(txt);
            window.location.reload();
        }
    }
    r.open("POST", "DeleteEvent.php", true);
    r.send(f);
}





function AddNewEvents() {
    var file = document.getElementById("AddSpecialMomentImage");
    var TextArea = document.getElementById("SpecialMomentAddTextArea").value;

    var f = new FormData();
    f.append("TextArea", TextArea);

    f.append("file", file.files[0]);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var txt = r.responseText;
            alert(txt);
            window.location.reload();
        }
    }
    r.open("POST", "AddNewEvents.php", true);
    r.send(f);
}




















///////////////////////////////////////////////////////////////////exploration

function UpdateExplorationImage(id) {

    var file = document.getElementById("File" + id);


    var f = new FormData();
    f.append("id", id);
    f.append("file", file.files[0]);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var txt = r.responseText;
            alert(txt);
            window.location.reload();
        }
    }
    r.open("POST", "ExplorationUpdatePictures.php", true);
    r.send(f);

}


function UplocadExploration(id) {
    var textArea = document.getElementById("TextArea" + id).value;
    var f = new FormData();
    f.append("id", id);
    f.append("textArea", textArea);


    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var txt = r.responseText;
            alert(txt);
        }
    }
    r.open("POST", "ExplorationDiscriptionUpdatge.php", true);
    r.send(f);
}


function DeleteExploration(id) {
    var f = new FormData();
    f.append("id", id);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var txt = r.responseText;
            alert(txt);
            window.location.reload();
        }
    }
    r.open("POST", "DeleteExploration.php", true);
    r.send(f);
}





function AddNewExploration() {
    var file = document.getElementById("AddSpecialMomentImage");
    var TextArea = document.getElementById("SpecialMomentAddTextArea").value;

    var f = new FormData();
    f.append("TextArea", TextArea);

    f.append("file", file.files[0]);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var txt = r.responseText;
            alert(txt);
            window.location.reload();
        }
    }
    r.open("POST", "AddNewExploration.php", true);
    r.send(f);
}

function changeAddImagePicexplorations() {
  
    var file = document.getElementById("AddexplorationsImage");
    var file1 = file.files[0]
    var url = window.URL.createObjectURL(file1);
    document.getElementById("AddImageTagExploration").src = url;
}













///////////////////////////////////////////////////////////////////Gallery

function UpdateGalleryImage(id) {

    var file = document.getElementById("File" + id);


    var f = new FormData();
    f.append("id", id);
    f.append("file", file.files[0]);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var txt = r.responseText;
            alert(txt);
            window.location.reload();
        }
    }
    r.open("POST", "GalleryUpdatePictures.php", true);
    r.send(f);

}


function UploadGallery(id) {
    var textArea = document.getElementById("TextArea" + id).value;
    var f = new FormData();
    f.append("id", id);
    f.append("textArea", textArea);


    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var txt = r.responseText;
            alert(txt);
        }
    }
    r.open("POST", "GalleryDiscriptionUpdatge.php", true);
    r.send(f);
}


function DeleteGallery(id) {
    var f = new FormData();
    f.append("id", id);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var txt = r.responseText;
            alert(txt);
            window.location.reload();
        }
    }
    r.open("POST", "DeleteGallery.php", true);
    r.send(f);
}




function AddNewGallery() {
    var file = document.getElementById("AddSpecialMomentImage");
    var TextArea = document.getElementById("SpecialMomentAddTextArea").value;

    var f = new FormData();
    f.append("TextArea", TextArea);

    f.append("file", file.files[0]);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var txt = r.responseText;
            alert(txt);
            window.location.reload();
        }
    }
    r.open("POST", "AddNewGallery.php", true);
    r.send(f);
}

function changeAddImageGalery() {
   
    var file = document.getElementById("AddGalleryImage");
    var file1 = file.files[0]
    var url = window.URL.createObjectURL(file1);
    document.getElementById("AddImageTagGallery").src = url;
} 


















///////////////////////////////////////////////////////////////////Growth 
function UpdateGrowthImage(id) {

    var file = document.getElementById("File" + id);


    var f = new FormData();
    f.append("id", id);
    f.append("file", file.files[0]);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var txt = r.responseText;
            alert(txt);
            window.location.reload();
        }
    }
    r.open("POST", "GrowthUpdatePictures.php", true);
    r.send(f);

}



function Uploadgrowth(id) {
    var textArea = document.getElementById("TextArea" + id).value;
    var f = new FormData();
    f.append("id", id);
    f.append("textArea", textArea);


    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var txt = r.responseText;
            alert(txt);
        }
    }
    r.open("POST", "GrowthDiscriptionUpdatge.php", true);
    r.send(f);
}



function DeleteGallery(id) {
    var f = new FormData();
    f.append("id", id);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var txt = r.responseText;
            alert(txt);
            window.location.reload();
        }
    }
    r.open("POST", "DeleteGallery.php", true);
    r.send(f);
}


function AddNewGrowth() {
    var AddSpecialMomentImage = document.getElementById("AddSpecialMomentImage");
    var AboutUsText = document.getElementById("AboutUsText").value;
    var AboutName = document.getElementById("AboutName").value;
    var vission = document.getElementById("vission").value;
    var mission = document.getElementById("mission").value;


    var f = new FormData();
    f.append("file", AddSpecialMomentImage.files[0]);
    f.append("AboutUsText", AboutUsText);
    f.append("AboutName", AboutName);
    f.append("vission", vission);
    f.append("mission", mission);


    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var txt = r.responseText;
            alert(txt);
        }
    }
    r.open("POST", "AddNewGrowth.php", true);
    r.send(f);

}

function changeAddImageAboutUs() {
   
    var file = document.getElementById("AddSpecialAboutUs");
    var file1 = file.files[0]
    var url = window.URL.createObjectURL(file1);
    document.getElementById("AddImageTagAboutUs").src = url;
} 




/////////////////////////////////////////////Offers
function UpdateOffersImage(id) {

    var file = document.getElementById("File" + id);


    var f = new FormData();
    f.append("id", id);
    f.append("file", file.files[0]);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var txt = r.responseText;
            alert(txt);
            window.location.reload();
        }
    }
    r.open("POST", "OffersUpdatePictures.php", true);
    r.send(f);

}


function UploadOffers(id) {
    var textArea = document.getElementById("TextArea" + id).value;
    var StartDate = document.getElementById("StartDate").value;
    var EndDate = document.getElementById("EndDate").value;

    var f = new FormData();
    f.append("id", id);
    f.append("textArea", textArea);
    f.append("StartDate", StartDate);
    f.append("EndDate", EndDate);


    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var txt = r.responseText;
            alert(txt);
        }
    }
    r.open("POST", "OffersDiscriptionUpdatge.php", true);
    r.send(f);
}


function DeleteOffers(id) {
    var f = new FormData();
    f.append("id", id);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var txt = r.responseText;
            alert(txt);
            window.location.reload();
        }
    }
    r.open("POST", "DeleteOffers.php", true);
    r.send(f);
}



function AddNewOffers() {
    var file = document.getElementById("AddSpecialMomentImage");
    var TextArea = document.getElementById("TextArea").value;
    var StartDate = document.getElementById("StartDate").value;
    var EndDate = document.getElementById("EndDate").value;

    var f = new FormData();
    f.append("TextArea", TextArea);
    f.append("StartDate", StartDate);
    f.append("EndDate", EndDate);
    f.append("file", file.files[0]);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var txt = r.responseText;
            alert(txt);
            window.location.reload();
        }
    }
    r.open("POST", "AddNewOffers.php", true);
    r.send(f);

}

function changeAddImageoffer() {
   
    var file = document.getElementById("AddOfferImage");
    var file1 = file.files[0]
    var url = window.URL.createObjectURL(file1);
    document.getElementById("AddImageTagOffers").src = url;
} 


























////////////////////////////////////////Wedding
function UpdateWeddingImage(id) {
    var file = document.getElementById("File" + id);
    var f = new FormData();
    f.append("id", id);
    f.append("file", file.files[0]);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var txt = r.responseText;
            alert(txt);
            window.location.reload();
        }
    }
    r.open("POST", "WeddingUpdatePictures.php", true);
    r.send(f);
}



function DeleteWedding(id) {
    var f = new FormData();
    f.append("id", id);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var txt = r.responseText;
            alert(txt);
            window.location.reload();
        }
    }
    r.open("POST", "DeleteWedding.php", true);
    r.send(f);
}

function AddNewWeddingFeutures() {

    var WedingFeutures = document.getElementById("WedingFeutures").value;

    var f = new FormData();
    f.append("WedingFeutures", WedingFeutures);


    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var txt = r.responseText;
            alert(txt);
            window.location.reload();
        }
    }
    r.open("POST", "AddNewWeddingFeuture.php", true);
    r.send(f);
}

function AddNewWeddingMenu() {

    var AddWeddingMenuImage = document.getElementById("AddWeddingMenuImages");
    var TextAreamenu = document.getElementById("TextAreamenu").value;
    var MenuName = document.getElementById("MenuName").value;


    var f = new FormData();
    f.append("file", AddWeddingMenuImage.files[0]);
    f.append("TextAreamenu", TextAreamenu);
    f.append("MenuName", MenuName);


    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var txt = r.responseText;
            alert(txt);
            window.location.reload();
        }
    }
    r.open("POST", "AddNewWeddingMenu.php", true);
    r.send(f);

}

function AddNewWeddingHallDetails() {

    var file = document.getElementById("AddWeddingHallImages");
    var Description = document.getElementById("TextAreaHall").value;
    var name = document.getElementById("NameHall").value;

    var f = new FormData();
    f.append("file", file.files[0]);
    f.append("Description", Description);
    f.append("name", name);
     
    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            alert(r.responseText);
        }
    }
    r.open("POST", "AddnewWeddingHall.php", true);
    r.send(f);
}


function changefeatureText(id) {
    var feutureText = document.getElementById("feutureText").value;

    var f = new FormData();
    f.append("id", id);
    f.append("feutureText", feutureText);


    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            alert(r.responseText);
        }
    }
    r.open("POST", "UpdatenFeutreText.php", true);
    r.send(f);
}

function updateWeddingFoodMenu(id) {
    var file = document.getElementById("FFile" + id);

    var f = new FormData();
    f.append("id", id);
    f.append("FFile", file.files[0]);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            alert(r.responseText);
        }
    }
    r.open("POST", "UpdatenFoodImage.php", true);
    r.send(f);
}

function DeleteWeddignFoodMenu(id) {
    var f = new FormData();
    f.append("id", id);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            alert(r.responseText);
        }
    }
    r.open("POST", "DeleteWeddignFoodMenu.php", true);
    r.send(f);
}


function UpdateweddingHallImage(id) {
    var file = document.getElementById("FHFile" + id);

    var f = new FormData();
    f.append("id", id);
    f.append("FHFile", file.files[0]);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            alert(r.responseText);
        }
    }
    r.open("POST", "UpdatenWeddingHallImage.php", true);
    r.send(f);
}

function DeleteWeddignHall(id) {
    var f = new FormData();
    f.append("id", id);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            alert(r.responseText);
        }
    }
    r.open("POST", "DeleteWeddignHall.php", true);
    r.send(f);
}




function changeAddImageWedingMenu() {
    var file = document.getElementById("AddWeddingMenuImages");
    var file1 = file.files[0]
    var url = window.URL.createObjectURL(file1);
    document.getElementById("AddImageTagWedding").src = url;
} 


function changeAddHallImage() {
    var file = document.getElementById("AddWeddingHallImages");
    var file1 = file.files[0]
    var url = window.URL.createObjectURL(file1);
    document.getElementById("AddImageTagWeddinghall").src = url;
} 










// //////////////////////////////////////////////////Home

function ChangeHomeText(id) {
    var text = document.getElementById("welcomeText").value;

    var f = new FormData();
    f.append("id", id);
    f.append("text", text);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            alert(r.responseText);

            var msg = "Provide Nessasary Details";
            var color = "bg-success";
            toast(r.responseText, color);
        }
    }
    r.open("POST", "UpdateHomeWelcomeText.php", true);
    r.send(f);

}



function changeViedo() {

    var Video = document.getElementById("Video");

    var f = new FormData();
    f.append("Video", Video.files[0]);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4 && r.status == 200) {
            var txt = r.responseText;
            alert(txt);
            if (txt = "success") {
                var msg = r.responseText;
                var color = "bg-success";
                toast(msg, color);
            }
        }
    }
    r.open("POST", "changeVideo.php", true);
    r.send(f);


}


function toast(msg, color) {

    var toastLiveExample = document.getElementById('updateToast');
    var toast = new bootstrap.Toast(toastLiveExample);

    var now = new Date();
    var time = now.getHours() + " " + now.getMinutes();

    document.getElementById("time").innerHTML = "At " + time;
    document.getElementById("msg").innerHTML = msg;
    document.getElementById("headerColor").classList.add(color);

    toast.show();

    msg = null;
    color = null;

}



