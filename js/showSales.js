function changeSelectList() {
    var sortCategory = document.forms['sortForm'].elements['sortSales1'];
    var text = "";
    var i = 0;
    for (i=0; i<sortCategory.length; i++) {
        if (sortCategory[i].selected == true) {
            text = sortCategory[i].value;
        }
    }

    switch(text) {
        case 'sortSalesIndex':
        case 'sortProductID':
        case 'sortProductName':
        case 'sortSalesStartDate':
        case 'sortSalesEndDate':
            document.getElementById('showSalesSort2').innerHTML =
                "<select id='sortSales2' name='sortSales2' size='0'>" +
                "<option value='ascending'>Ascending</option>" +
                "<option value='descending'>Descending</option>" +
                "</select>";
            break;
        case 'sortSalesPrice':
            document.getElementById('showSalesSort2').innerHTML =
                "<span style='font-size:13px;'>Price Range: </span>" +
                "<input type='int' id='sortSales2From' name='sortSales2From' required/>" +
                "<span style='font-size:13px;'> ~ </span>" +
                "<input type='int' id='sortSales2To' name='sortSales2To' required/>";
            break;
    }
}

function submitSortForm(formName, inputName) {
    var regex = /^[0-9]+$/;
    var x = document.forms[formName][inputName].value;
    if (x == 'sortSalesPrice') {
        var num1 = document.forms['sortForm']['sortSales2From'].value;
        var num2 = document.forms['sortForm']['sortSales2To'].value;

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