function openNav() {
    document.getElementById("mySidebar").style.width = "13vw";
    document.getElementById("main").style.marginLeft = "13vw";
}

function closeNav() {
    document.getElementById("mySidebar").style.width = "0vw";
    document.getElementById("main").style.marginLeft = "0vw";
}

function toogleSubMenu() {
    var element = document.getElementById("subContentMenu");
    if (element.style.display === "none") {
        element.style.display = "block";
    } else {
        element.style.display = "none";
    }
}