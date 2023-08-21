var images = [];
var index = 0;
var sohinh = 25;
for (var i = 0; i < sohinh; i++) {
    images[i] = new Image();
    images[i].src = "images/" + i + ".jpg";
}


function setimage() {
    var anh = document.getElementById("anh");

    anh.classList.remove("show");
    setTimeout(function () {
        anh.src = images[index].src;
        document.getElementById("index").innerHTML = "Ảnh " + (index + 1) + "/" + sohinh;
        anh.classList.add("show");
    }, 500);
}

function next() {
    index++;
    if (index == images.length)
        index = 0;
    setimage();
}

function prev() {
    index--;
    if (index < 0)
        index = images.length - 1;
    setimage();
}