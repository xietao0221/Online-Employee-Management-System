function showHome() {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            document.getElementById("homeContent").innerHTML = xmlhttp.responseText;
        }
    }
    xmlhttp.open("GET", "showNameForAdministrator.php", true);
    xmlhttp.send();
}

function showEmployee() {
    document.getElementById('homeContent').innerHTML =
        '<iframe src="../homeAdministrator/showEmployeeForAdministrator.php" width="100%" height="100%" style="border:none"></iframe>';
}

function addEmployee() {
    document.getElementById('homeContent').innerHTML =
        '<iframe src="../homeAdministrator/addEmployee.php" width="100%" height="100%" style="border:none"></iframe>';
}

function deleteEmployee() {
    document.getElementById('homeContent').innerHTML =
        '<iframe src="../homeAdministrator/deleteEmployee.php" width="100%" height="100%" style="border:none"></iframe>';
}

function modifyEmployee() {
    document.getElementById('homeContent').innerHTML =
        '<iframe src="../homeAdministrator/modifyEmployee.php" width="100%" height="100%" style="border:none"></iframe>';
}

function buttonLogOut() {
    var retVal = confirm("Do you want to Log out ?");
    if (retVal == true) {
        window.location = "../logout.php";
    } else {
        return false;
    }
}

