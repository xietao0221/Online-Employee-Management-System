function changeSelectList() {
    var sortCategory = document.forms['sortForm'].elements['sortProduct1'];
    var text = "";
    var i = 0;
    for (i=0; i<sortCategory.length; i++) {
        if (sortCategory[i].selected == true) {
            text = sortCategory[i].value;
        }
    }

    switch(text) {
        case 'sortProductIndex':
        case 'sortProductID':
        case 'sortProductName':
        case 'sortProductQuantity':
            document.getElementById('showProductSort2').innerHTML =
                "<select id='sortProduct2' name='sortProduct2' size='0'>" +
                "<option value='ascending'>Ascending</option>" +
                "<option value='descending'>Descending</option>" +
                "</select>";
            break;

        case 'sortProductCategory':
            document.getElementById('showProductSort2').innerHTML =
                "<select id='sortProduct2' name='sortProduct2' size='0'>" +
                "<option value='onlyWoodwind'>Only Woodwind</option>" +
                "<option value='onlyBrass'>Only Brass</option>" +
                "<option value='onlyPercussion'>Only Percussion</option>" +
                "<option value='onlyKeyboard'>Only Keyboard</option>" +
                "<option value='onlyString'>Only String</option>" +
                "</select>";
            break;

        case 'sortProductOriginalPrice':
            document.getElementById('showProductSort2').innerHTML =
                "<span style='font-size:13px;'>Price Range: </span>" +
                "<input type='int' id='sortProduct2From' name='sortProduct2From' required/>" +
                "<span style='font-size:13px;'> ~ </span>" +
                "<input type='int' id='sortProduct2To' name='sortProduct2To' required/>";
            break;
    }
}

function submitSortForm(formName, inputName) {
    var regex = /^[0-9]+$/;
    var x = document.forms[formName][inputName].value;
    if (x == 'sortProductOriginalPrice') {
        var num1 = document.forms['sortForm']['sortProduct2From'].value;
        var num2 = document.forms['sortForm']['sortProduct2To'].value;

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