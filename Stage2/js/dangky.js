function check() {
    var formStatus = true;
    var message = "";

    // check student id
    var studentID = document.getElementById("student-id");
    if (studentID.value == "") {
        message += "Bạn phải nhập mã số sinh viên!<br>";
        studentID.className = "error";
        formStatus = false;
    }

    // check fullname
    var fullname = document.getElementById("fullname");
    if (fullname.value == "") {
        message += "Bạn phải nhập họ và tên!<br>";
        fullname.className = "error";
        formStatus = false;
    }

    //check email
    var email = document.getElementById("email");
    if (email.value == "") {
        message += "Bạn phải nhập email!<br>";
        email.className = "error";
        formStatus = false;
    }
    //check gender
    var gender = document.getElementsByName("gender");
    if (gender[0].checked == false && gender[1].checked == false) {
        message += "Bạn phải chọn giới tính!<br>"
        formStatus = false;
    }

    // check hobby
    var hobby = document.getElementsByName("hobby");
    if ((hobby[0].checked || hobby[1].checked || hobby[2].checked || hobby[3].checked || hobby[4].checked) == false) {
        message += "Bạn phải chọn sở thích!<br>";
        formStatus = false;
    }

    // check nationality
    var nationality = document.getElementById("nationality");
    if (nationality.value == "") {
        message += "Bạn phải chọn quốc tịch!<br>";
        formStatus = false;
    }

    // check note
    var note = document.getElementById("note").value;
    if (note.length >= 200) {
        message += "Nội dung của ghi chú phải nhỏ hơn 200 ký tự!";
        formStatus = false;
    }

    if (message == "")
        message += "Thành công";
    document.getElementById("message").innerHTML = message;
    return formStatus;
}