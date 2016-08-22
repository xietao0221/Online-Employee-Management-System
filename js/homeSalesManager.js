function showHome() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("homeContent").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "showNameForSalesManager.php", true);
    xmlhttp.send();
}

function showProduct() {
    document.getElementById('homeContent').innerHTML =
        '<iframe src="../homeSalesManager/showProductForSalesManager.php" width="100%" height="100%" style="border:none"></iframe>';
}

function addProduct() {
    document.getElementById('homeContent').innerHTML =
        '<iframe src="../homeSalesManager/addProduct.php" width="100%" height="100%" style="border:none"></iframe>';
}

function deleteProduct() {
    document.getElementById('homeContent').innerHTML =
        '<iframe src="../homeSalesManager/deleteProduct.php" width="100%" height="100%" style="border:none"></iframe>';
}

function modifyProduct() {
    document.getElementById('homeContent').innerHTML =
        '<iframe src="../homeSalesManager/modifyProduct.php" width="100%" height="100%" style="border:none"></iframe>';
}

function showSales() {
    document.getElementById('homeContent').innerHTML =
        '<iframe src="../homeSalesManager/showSalesForSalesManager.php" width="100%" height="100%" style="border:none"></iframe>';
}

function buttonLogOut() {
    var retVal = confirm("Do you want to Log out ?");
    if( retVal == true ){
        window.location = "../logout.php";
    } else {
        return false;
    }
}