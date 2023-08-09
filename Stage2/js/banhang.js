class SanPham {
    constructor(ten, dongia) {
        this.ten = ten;
        this.dongia = dongia;
    }
}
var n = 6;
var lst = [];
// list san pham
lst[0] = new SanPham("Nhà cho thuê quận 1", 3500000);
lst[1] = new SanPham("Trọ quận 2", 2000000);
lst[2] = new SanPham("Trọ quận 12", 800000);
lst[3] = new SanPham("Chung cư cho thuê quận 7", 35000000);
lst[4] = new SanPham("Trọ Bình Thành", 5000000);
lst[5] = new SanPham("Trọ Gò Vấp", 1500000);
console.log(lst[0].ten);

function onoff(checkboxElement) {
    console.log(checkboxElement);
    var parentElement = checkboxElement.parentElement.parentElement;
    var inputNumber = parentElement.getElementsByTagName("input")[1];
    var thanhtienElement = parentElement.getElementsByTagName("td")[4];
    var tongtienElement = document.getElementById("tongtien");

    if (checkboxElement.checked) {
        inputNumber.disabled = false;
        inputNumber.value = 0;
        //thanhtienElement.innerText = 0;
    } else {
        inputNumber.disabled = true;
        inputNumber.value = "";

        var thanhtien = parseInt(thanhtienElement.innerText);

        var tongtien = parseInt(tongtienElement.innerText);
        tongtienElement.innerText = tongtien - thanhtien;
        thanhtienElement.innerText = "";
        console.log(tongtienElement, tongtien);
    }
}

function tinhtien(inputElement) {
    var thanhtienElement = inputElement.parentElement.parentElement.getElementsByTagName("td")[4];

    var dongiaElement = inputElement.parentElement.parentElement.getElementsByTagName("td")[2];
    var tongtienElement = document.getElementById("tongtien");
    var tiencu = 0;
    if (thanhtienElement.innerText != "")
        tiencu = parseInt(thanhtienElement.innerText);
    var tienmoi = 0;
    if (inputElement.value != "")
        tienmoi = parseInt(inputElement.value) * parseInt(dongiaElement.innerText);
    var tongtien = 0;
    if (tongtienElement.innerText != "")
        tongtien = parseInt(tongtienElement.innerText);
    console.log(thanhtienElement.innerText);

    thanhtienElement.innerText = tienmoi;
    tongtienElement.innerText = tongtien - tiencu + tienmoi;
}
function loadByMinMax(minPrice, maxPrice) {
    var tablebody = document.getElementsByTagName("tbody")[0];
    tablebody.innerHTML = "";
    for (var i = 0; i < n; i++) {
        if ((minPrice == null || lst[i].dongia >= minPrice) && (maxPrice == null || lst[i].dongia < maxPrice)) {
            var tbrow = " <tr><td><input type='checkbox' onclick='onoff(this)'></td><td>" + lst[i].ten + "</td><td>" + lst[i].dongia + "</td><td><input type='number' disabled onchange='tinhtien(this)''></td><td></td></tr>";
            tablebody.innerHTML += tbrow;
        }
    }
    tablebody.innerHTML += "<tr><td colspan='4'>TỔNG</td><td id='tongtien'>0</td></tr>";
}

function filter(selectElement) {
    var selectedOption = selectElement.options[selectElement.selectedIndex];
    var dataMin = selectedOption.getAttribute('data-min');
    var dataMax = selectedOption.getAttribute('data-max');
    console.log(dataMin);
    console.log(dataMax);
    loadByMinMax(dataMin, dataMax);
}



