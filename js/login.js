function validateForm() {
    var userName = document.getElementById("userNameLogin");
    var passWord = document.getElementById("passWordLogin");

    if (userName.value == "" && passWord.value == "") {
        alert("Please fill out your Username and Password.");
        return false;
    } else if (userName.value == "") {
        alert("Please fill out your Username.");
        return false;
    } else if (passWord.value == "") {
        alert("Please fill out your Password.");
        return false;
    }
    return true;
}

//function alertValidation(inputElement) {
//    var input = document.getElementById(inputElement);
//    if (input.checkValidity() == false) {
//        alert(input.validationMessage);
//       return false;
//    } else {
//        return true;
//    }
//}