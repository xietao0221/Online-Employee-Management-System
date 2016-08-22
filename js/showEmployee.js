function changeSelectList() {
    var sortCategory = document.forms['sortForm'].elements['sortEmployee1'];
    var text = "";
    var i = 0;
    for (i=0; i<sortCategory.length; i++) {
        if (sortCategory[i].selected == true) {
            text = sortCategory[i].value;
        }
    }

    switch(text) {
        case 'sortEmployeeIndex':
        case 'sortUserID':
        case 'sortName':
        case 'sortAge':
            document.getElementById('showEmployeeSort2').innerHTML =
                "<select id='sortEmployee2' name='sortEmployee2' size='0'>" +
                    "<option value='ascending'>Ascending</option>" +
                    "<option value='descending'>Descending</option>" +
                "</select>";
            break;

        case 'sortUserType':
            document.getElementById('showEmployeeSort2').innerHTML =
                "<select id='sortEmployee2' name='sortEmployee2' size='0'>" +
                    "<option value='onlyManager'>Only Manager</option>" +
                    "<option value='onlyAdministrator'>Only Administrator</option>" +
                    "<option value='onlySalesManager'>Only Sales Manager</option>" +
                "</select>";
            break;

        case 'sortGender':
            document.getElementById('showEmployeeSort2').innerHTML =
                "<select id='sortEmployee2' name='sortEmployee2' size='0'>" +
                    "<option value='onlyMale'>Only Male</option>" +
                    "<option value='onlyFemale'>Only Female</option>" +
                "</select>";
            break;

        case 'sortSalary':
            document.getElementById('showEmployeeSort2').innerHTML =
                "<span style='font-size:13px;'>Pay Range: </span>" +
                "<input type='int' id='sortEmployee2From' name='sortEmployee2From' style='width:70px;' required/>" +
                "<span style='font-size:13px;'> ~ </span>" +
                "<input type='int' id='sortEmployee2To' name='sortEmployee2To' style='width:70px;' required/>";
            break;
    }
}

function submitSortForm(formName, inputName) {
    var regex = /^[0-9]+$/;
    var x = document.forms[formName][inputName].value;
    if (x == 'sortSalary') {
        var num1 = document.forms['sortForm']['sortEmployee2From'].value;
        var num2 = document.forms['sortForm']['sortEmployee2To'].value;

        if (num1 == "" || num2 == "") {
            alert("You need to fill out this blank.");
            return false;
        } else {
            if (!num1.match(regex) || !num2.match(regex)) {
                alert("You can only input NUMBERS.");
                return false;
            } else if (num1 >= num2) {
                alert("The second number must bigger than the first one.");
                return false;
            } else {
                return true;
            }
        }
    } else {
        return true;
    }
}

function submitSearchForm(formName, inputName) {
    var x = document.forms[formName][inputName].value;
    var regex = /^[a-zA-Z]+$/;
    if (x == '') {
        alert('You need to fill out this blank.')
        return false;
    } else if (!x.match(regex)) {
        alert("You can only input LOWERCASE LETTERS.");
        return false;
    } else {
        return true;
    }
}