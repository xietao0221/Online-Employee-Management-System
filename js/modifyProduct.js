function displayInput() {
    document.getElementById('modifyProductInput').style.display = "block";
}

function displaySalesExtraInput() {
    var display = document.forms[0].elements['modifyProductInputSalesType'];
    if (display[1].selected == true) {
        document.getElementById('displaySalesExtraInput').style.display = "block";
    } else {
        document.getElementById('displaySalesExtraInput').style.display = "none";
    }
}

function addOption(textName, selectlistName) {
    var regexLetter = /^[a-zA-Z]+$/;
    if (!document.getElementById(textName).value.match(regexLetter)) {
        alert('Product Category: You can only input letters(no space).');
        return false;
    }

    var selElement = document.getElementById(selectlistName);
    optElement = document.createElement("option");
    optElement.text = document.getElementById(textName).value;
    optElement.value = optElement.text;
    selElement.add(optElement);
    return true;
}

function checkForm() {
    var productID = document.forms['modifyProductInputForm']['modifyProductInputProductID'].value;
    var productName = document.forms['modifyProductInputForm']['modifyProductInputProductName'].value;
    var originalPrice = document.forms['modifyProductInputForm']['modifyProductInputProductOriginalPrice'].value;
    var quantity = document.forms['modifyProductInputForm']['modifyProductInputProductQuantity'].value;
    var description = document.forms['modifyProductInputForm']['modifyProductInputProductDescription'].value.replace(/\s+/g,' ').replace(/^\s+|\s+$/,'');
    document.forms['modifyProductInputForm']['modifyProductInputProductDescription'].value = description;

    var salesType = document.forms['modifyProductInputForm']['modifyProductInputSalesType'].value;

    var discount = document.forms['modifyProductInputForm']['modifyProductInputSalesDiscount'].value;
    var startDate = document.forms['modifyProductInputForm']['modifyProductInputSalesStartDate'].value;
    var endDate = document.forms['modifyProductInputForm']['modifyProductInputSalesEndDate'].value;

    var regexLetterNumber = /^\w+$/;
    var regexLetter = /^[a-zA-Z]+$/;
    var regexNumber = /^[0-9]*[1-9][0-9]*$/;
    var regexText = /[A-Za-z0-9 _.,!"'/$]*/;
    var regexFloat = /^(0(\.\d+)?|1(\.0+)?)$/;
    var errMsg = '';

    //ProductID
    if (productID == '') {
        errMsg += 'Product ID: You should input Product ID.\n';
    } else if (!productID.match(regexLetterNumber)) {
        errMsg += 'Product ID: You can only input letters and numbers(no space).\n';
    }

    //Product Name
    if (productName == '') {
        errMsg += 'Product Name: You should input Product Name.\n';
    } else if (!productName.match(regexLetter)) {
        errMsg += 'Product Name: You can only input letters(no space).\n';
    }

    //OriginalPrice
    if (originalPrice == '') {
        errMsg += 'Original Price: You should input Original Price(must be number).\n';
    } else if (!originalPrice.match(regexNumber) || originalPrice <= 0 || originalPrice >= 10000) {
        errMsg += 'Original Price: You can only input positive integer which is more than 0 and smaller than 10K.\n';
    }

    //Quantity
    if (quantity == '') {
        errMsg += 'Quantity: You should input Quantity(must be number).\n';
    } else if (!quantity.match(regexNumber) || quantity <= 0 || quantity >= 1000) {
        errMsg += 'Quantity: You can only input positive integer which is more than 0 and smaller than 1K.\n';
    }

    //Product Description
    if (description == '') {
        errMsg += 'Product Description: You should input Product Description.\n';
    } else if (!description.match(regexText)) {
        errMsg += 'Product Description: You can only input letters, numbers and some normal punctuations(like ,.!_$\'\").\n';
    } else if (description.length <= 5) {
        errMsg += 'Product Description: You need to input at least 6 letters.\n';
    }

    if (salesType == '1') {
        //Discount
        if (discount == '') {
            errMsg += 'Discount: You should input Discount(must be float).\n';
        } else if (!discount.match(regexFloat) || discount <= 0 || discount >= 1) {
            errMsg += 'Discount: You can only input positive float which is more than 0 and smaller than 1.\n';
        }

        //Start Date
        if (startDate == '') {
            errMsg += 'Start Date: You should input Start Date(valid date).\n';
        } else if (!isDate(startDate)) {
            errMsg += 'Start Date: You should input a valid date.\n';
        }

        //End Date
        if (endDate == '') {
            errMsg += 'End Date: You should input End Date.\n';
        } else if (!isDate(endDate)) {
            errMsg += 'End Date: You should input a valid date.\n';
        }

        if (startDate >= endDate) {
            errMsg += 'Start Date and End Date: End Date should greater than Start Date.\n';
        }
    }

    if (errMsg == '') {
        return true;
    } else {
        alert(errMsg);
        return false;
    }
}

function isDate(txtDate)
{
    var currVal = txtDate;
    if(currVal == '')
        return false;

    var rxDatePattern = /^(\d{4})(\/|-)(\d{1,2})(\/|-)(\d{1,2})$/; //Declare Regex
    var dtArray = currVal.match(rxDatePattern); // is format OK?

    if (dtArray == null)
        return false;

    //Checks for mm/dd/yyyy format.
    dtMonth = dtArray[3];
    dtDay= dtArray[5];
    dtYear = dtArray[1];

    if (dtMonth < 1 || dtMonth > 12)
        return false;
    else if (dtDay < 1 || dtDay> 31)
        return false;
    else if ((dtMonth==4 || dtMonth==6 || dtMonth==9 || dtMonth==11) && dtDay ==31)
        return false;
    else if (dtMonth == 2)
    {
        var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));
        if (dtDay> 29 || (dtDay ==29 && !isleap))
            return false;
    }
    return true;
}