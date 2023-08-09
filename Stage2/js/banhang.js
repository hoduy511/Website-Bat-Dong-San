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

        var thanhtien = 0;
        if (thanhtienElement.innerText.replaceAll(',', '') != '')
            thanhtien = parseInt(thanhtienElement.innerText.replaceAll(',', ''));

        var tongtien = parseInt(tongtienElement.innerText.replaceAll(',', ''));
        tongtienElement.innerText = (tongtien - thanhtien).toLocaleString();
        thanhtienElement.innerText = "";
        console.log(tongtienElement, tongtien);
    }
}

function tinhtien(inputElement) {
    var thanhtienElement = inputElement.parentElement.parentElement.getElementsByTagName("td")[4];

    var dongiaElement = inputElement.parentElement.parentElement.getElementsByTagName("td")[2];
    var tongtienElement = document.getElementById("tongtien");
    var tiencu = 0;
    if (thanhtienElement.innerText.replaceAll(',', '') != "")
        tiencu = parseInt(thanhtienElement.innerText.replaceAll(',', ''));
    var tienmoi = 0;
    if (inputElement.value != "")
        tienmoi = parseInt(inputElement.value) * parseInt(dongiaElement.innerText.replaceAll(',', ''));
    var tongtien = 0;
    if (tongtienElement.innerText.replaceAll(',', '') != "")
        tongtien = parseInt(tongtienElement.innerText.replaceAll(',', ''));

    thanhtienElement.innerText = tienmoi.toLocaleString();
    tongtienElement.innerText = (tongtien - tiencu + tienmoi).toLocaleString();
}
function loadByMinMax(minPrice, maxPrice) {
    var tablebody = document.getElementsByTagName("tbody")[0];
    tablebody.innerHTML = "";
    for (var i = 0; i < n; i++) {
        if ((minPrice == null || lst[i].dongia >= minPrice) && (maxPrice == null || lst[i].dongia < maxPrice)) {
            var tbrow = " <tr><td><input type='checkbox' onclick='onoff(this)'></td><td>" + lst[i].ten + "</td><td>" + lst[i].dongia.toLocaleString() + "</td><td><input type='number' disabled onchange='tinhtien(this)' min='0''></td><td></td></tr>";
            tablebody.innerHTML += tbrow;
        }
    }
    tablebody.innerHTML += "<tr><td colspan='4'><b>TỔNG</b></td><td id='tongtien'>0</td></tr>";
}

function filter(selectElement) {
    var selectedOption = selectElement.options[selectElement.selectedIndex];
    var dataMin = selectedOption.getAttribute('data-min');
    var dataMax = selectedOption.getAttribute('data-max');
    console.log(dataMin);
    console.log(dataMax);
    loadByMinMax(dataMin, dataMax);
}



