function showHome() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("homeContent").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "showNameForManager.php", true);
    xmlhttp.send();
}

function showEmployee() {
    document.getElementById('homeContent').innerHTML =
        '<iframe src="../homeManager/showEmployeeForManager.php" width="100%" height="100%" style="border:none"></iframe>';
}

function showProduct() {
    document.getElementById('homeContent').innerHTML =
        '<iframe src="../homeManager/showProductForManager.php" width="100%" height="100%" style="border:none"></iframe>';
}

function showSales() {
    document.getElementById('homeContent').innerHTML =
        '<iframe src="../homeManager/showSalesForManager.php" width="100%" height="100%" style="border:none"></iframe>';
}

function buttonLogOut() {
    var retVal = confirm("Do you want to Log out ?");
    if( retVal == true ){
        window.location = "../logout.php";
    } else {
        return false;
    }
}