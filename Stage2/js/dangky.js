function check() {
    var formStatus = true;
    var message = "";

    // check student id
    var studentID = document.getElementById("student-id");
    if (studentID.value == "") {
        message += "Bạn phải nhập mã số sinh viên!<br>";
        studentID.classList.add("error");
        formStatus = false;
    }
    else {
        studentID.classList.remove("error");
    }

    // check fullname
    var fullname = document.getElementById("fullname");
    if (fullname.value === "") {
        message += "Bạn phải nhập họ và tên!<br>";
        fullname.classList.add("error");
        formStatus = false;
    } else if (!validateFullname(fullname.value)) {
        message += "Họ và tên không được có số hoặc chứa ký tự đặc biệt!<br>";
        fullname.classList.add("error");
        formStatus = false;
    } else {
        fullname.classList.remove("error");
    }

    //check email
    var email = document.getElementById("email");
    if (email.value == "") {
        message += "Bạn phải nhập email!<br>";
        email.classList.add("error");
        formStatus = false;
    }
    else {
        email.classList.remove("error");
    }
    //check gender
    var gender = document.getElementsByName("gender");
    var genderChecked = false;

    for (var i = 0; i < gender.length; i++) {
        if (gender[i].checked) {
            genderChecked = true;
            break;
        }
    }

    if (genderChecked == false) {
        message += "Bạn phải chọn giới tính!<br>";
        for (var i = 0; i < gender.length; i++) {
            gender[i].parentNode.classList.add("error");
        }
        formStatus = false;
    }
    else {
        for (var i = 0; i < gender.length; i++) {
            gender[i].parentNode.classList.remove("error");
        }
    }

    // check hobby
    var hobby = document.getElementsByName("hobby");
    var hobbyChecked = false;

    for (var i = 0; i < hobby.length; i++) {
        if (hobby[i].checked) {
            hobbyChecked = true;
            break;
        }
    }

    if (hobbyChecked == false) {
        message += "Bạn phải chọn sở thích!<br>";
        for (var i = 0; i < hobby.length; i++) {
            hobby[i].parentNode.classList.add("error");
        }
        formStatus = false;
    } 
    else {
        for (var i = 0; i < hobby.length; i++) {
            hobby[i].parentNode.classList.remove("error");
        }
    }

    // check nationality
    var nationality = document.getElementById("nationality");
    if (nationality.value == "") {
        message += "Bạn phải chọn quốc tịch!<br>";
        nationality.classList.add("error");
        formStatus = false;
    }
    else {
        nationality.classList.remove("error");
    }

    // check note
    var note = document.getElementById("note");
    if (note.value.length >= 200) {
        message += "Nội dung của ghi chú phải nhỏ hơn 200 ký tự!";
        note.classList.add("error");
        formStatus = false;
    }
    else {
        note.classList.remove("error");
    }

    if (message == "")
        message += "Đăng kí thành công";

    document.getElementById("message").innerHTML = message;
    return formStatus;
}

function validateFullname(fullname) {
    var regex = /^[a-zA-Z\s]*$/;
    return regex.test(fullname);
}

