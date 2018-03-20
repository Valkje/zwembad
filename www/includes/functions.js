window.addEventListener("load", functions);

var limitOffset = 0,
    selected,
    header, imgs,
    ul, inhoud,
    zijkant, events,
    file = (location.pathname.split("/")[1] == "beheer") ? "../" : "";

function functions() {

    setMeta(file+"images/slide/IMG_6224b.jpg");

    var i = 0;
    setInterval(function() {
        header.style.backgroundImage = "url("+imgs[i].value+")";
        setMeta(imgs[i].value);

        i++;
        if(i == imgs.length-1){
            i = 0;
        }
    }, 8000);

    setVars();
    if (zijkant != null || location.pathname == "/activiteiten") laadActiviteiten();
}

function setVars() {
    header = document.querySelector("header");
    imgs = document.querySelectorAll("header input[type=hidden]");
    ul = document.querySelectorAll("nav#pc_tablet ul");
    inhoud = document.querySelector("div#inhoud");
    zijkant = document.querySelector("div#zijkant");
    events = document.querySelector("ul#events");
}

function setMeta(imgSrc) {
    var img = document.createElement("img");
    img.setAttribute("src", imgSrc);
    img.addEventListener("load", function() {
        var vibrant = new Vibrant(img);
        var swatches = vibrant.swatches();
        document.querySelector("meta[name=theme-color]").content = swatches["Vibrant"].getHex();
        document.querySelector("meta[name=msapplication-navbutton-color]").content = swatches["Vibrant"].getHex();
        document.querySelector("meta[name=apple-mobile-web-app-status-bar-style]").content = swatches["Vibrant"].getHex();
    });
}

function menuEnable(x) {
    if (window.innerWidth < 600) {
        x.children[1].style.transform = "translateY(6px) rotate(180deg)";
        x.nextElementSibling.style.display = "block";
        x.onclick = function() { menuDisable(this) };
    } else {
        ul[0].style.transform = "translateY(-72px)";
        ul[1].style.transform = "translateY(-72px)";
    }
}
function menuDisable(x) {
    if (window.innerWidth < 600) {
        x.children[1].style.transform = "translateY(7px) rotate(0deg)";
        x.nextElementSibling.style.display = "none";
        x.onclick = function() { menuEnable(this) };
    } else {
        ul[0].style.transform = "translateY(0px)";
        ul[1].style.transform = "translateY(0px)";
    }
}

function laadActiviteiten() {
    if (document.querySelector("ul#events button") != null) document.querySelector("ul#events button").innerHTML = "<div class='spinner'></div>Laden...";
    if (document.querySelector("ul#events button") != null) document.querySelector("ul#events button").disabled = true;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            if (document.querySelector("ul#events button") != null) events.removeChild(document.querySelector("ul#events button"));
            events.innerHTML += xmlhttp.responseText;
            if (document.querySelector("ul#events button") != null) document.querySelector("ul#events button").addEventListener("click", laadActiviteiten);
            limitOffset = limitOffset + 6;
        }
    };
    xmlhttp.open("GET", "includes/events.php?limitOffset=" + limitOffset, true);
    xmlhttp.send();
}

function activiteitMeer(x) {
    selected = x;
    x.style.display = "block";
}
window.onclick = function(e) {
    if(e.target != selected || e.target != selected.parentElement) {
        if (selected != null) selected.style.display = "none";
        console.log("?");
    }
}

// eventbeheer.php

function inputEnable(x) {
    x.parentElement.nextElementSibling.children[0].disabled = false;
    x.parentElement.nextElementSibling.children[0].required = true;
    x.onchange = function() { inputDisable(this) };
    x.checked = true;
}
function inputDisable(x) {
    x.parentElement.nextElementSibling.children[0].disabled = true;
    x.parentElement.nextElementSibling.children[0].required = false;
    x.onchange = function() { inputEnable(this) };
    x.checked = false;
}

function eventAanmaken() {
    return confirm("Weet u zeker dat een nieuwe activiteit wilt aanmaken?");
}
function eventAanpassen() {
    return confirm("Weet u zeker dat u deze activiteit wilt aanpassen?");
}
function eventVerwijderen(x) {
    var f = x.parentElement.parentElement.parentElement.parentElement.parentElement.previousElementSibling;
    if (confirm("Weet u zeker dat u deze activiteit wilt verwijderen?")) {
        f.submit();
    }
}
