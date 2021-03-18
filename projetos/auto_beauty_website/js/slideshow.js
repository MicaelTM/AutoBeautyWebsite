var count = -1;
var timer = 3000;

function slide() {
    ban = new Array(4);
    ban[0] = "../images/slideshow/slide0.png";
    ban[1] = "../images/slideshow/slide1.png";
    ban[2] = "../images/slideshow/slide2.png";
    ban[3] = "../images/slideshow/slide3.png";
    count++;
    count = count%4;
    document.slide.src = ban[count];
    setTimeout("slide()", timer);
}