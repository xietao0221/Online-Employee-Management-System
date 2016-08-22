function checkForm() {
    var userID = document.forms['addEmployeeInputForm']['addEmployeeInputUserID'].value;
    var userName = document.forms['addEmployeeInputForm']['addEmployeeInputUsername'].value;
    var password = document.forms['addEmployeeInputForm']['addEmployeeInputPassword'].value;
    var firstName = document.forms['addEmployeeInputForm']['addEmployeeInputFirstName'].value;
    var lastName = document.forms['addEmployeeInputForm']['addEmployeeInputLastName'].value;
    var age = document.forms['addEmployeeInputForm']['addEmployeeInputAge'].value;
    var salary = document.forms['addEmployeeInputForm']['addEmployeeInputSalary'].value;

    var regexLetterNumber = /^\w+$/;
    var regexLetter = /^[a-zA-Z]+$/;
    var regexNumber = /^[0-9]*[1-9][0-9]*$/;
    var errMsg = '';

    //UserID
    if (userID == '') {
        errMsg += 'User ID: You should input User ID.\n';
    } else if (!userID.match(regexLetterNumber)) {
        errMsg += 'User ID: You can only input letters and numbers(no space).\n';
    }

    //Username
    if (userName == '') {
        errMsg += 'Username: You should input Username.\n';
    } else if (!userName.match(regexLetterNumber)) {
        errMsg += 'Username: You can only input letters and numbers(no space).\n';
    }

    //password
    if (password == '') {
        errMsg += 'Password: You should input Password.\n';
    } else if (!password.match(regexLetterNumber)) {
        errMsg += 'Password: You can only input letters and numbers(no space).\n';
    }

    //First Name
    if (firstName == '') {
        errMsg += 'First Name: You should input First Name.\n';
    } else if (!firstName.match(regexLetter)) {
        errMsg += 'First Name: You can only input letters(no space).\n';
    }

    //Last Name
    if (lastName == '') {
        errMsg += 'Last Name: You should input Last Name.\n';
    } else if (!lastName.match(regexLetter)) {
        errMsg += 'Last Name: You can only input letters(no space).\n';
    }

    //Age
    if (age == '') {
        errMsg += 'Age: You should input Age(must be number).\n';
    } else if (!age.match(regexNumber) || age <= 0 || age >= 100) {
        errMsg += 'Age: You can only input positive integer which is more than 0 and smaller than 100.\n';
    }

    //Salary
    if (salary == '') {
        errMsg += 'Salary: You should input Age(must be number).\n';
    } else if (!salary.match(regexNumber) || salary <= 0 || salary >= 100000) {
        errMsg += 'Salary: You can only input positive integer which is more than 0 and smaller than 100K.\n';
    }

    if (errMsg == '') {
        return true;
    } else {
        alert(errMsg);
        return false;
    }
}