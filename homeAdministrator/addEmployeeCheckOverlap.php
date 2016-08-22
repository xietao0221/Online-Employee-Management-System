<?php
$errPerson = "";
$errUserName = "";
$errUserID = "";

$sql = 'SELECT userID FROM employee WHERE employeeFirstName="' . $_POST['addEmployeeInputFirstName'] .
    '" AND employeeLastName="' . $_POST['addEmployeeInputLastName'] .
    '" AND userID="' . $_POST['addEmployeeInputUserID'] . '";';
$res = mysql_query($sql, $con);
if(!$res) {
    die('Could not get data from "employee": ' . mysql_error());
}
if ($row = mysql_fetch_array($res, MYSQL_ASSOC)) {
    $errPerson = true;
}

$sql = 'SELECT userID FROM user WHERE userName="' . $_POST['addEmployeeInputUsername'] . '";';
$res = mysql_query($sql, $con);
if(!$res) {
    die('Could not get data from "user": ' . mysql_error());
}
if ($row = mysql_fetch_array($res, MYSQL_ASSOC)) {
    $errUserName = true;
}


$sql = 'SELECT userID FROM user WHERE userID="' . $_POST['addEmployeeInputUserID'] . '";';
$res = mysql_query($sql, $con);
if(!$res) {
    die('Could not get data from "user": ' . mysql_error());
}
if ($row = mysql_fetch_array($res, MYSQL_ASSOC)) {
    $errUserID = true;
}

if ($errPerson) {
    echo '<script>alert("You cannot add an existed person, please try again.");</script>';
} else {
    if ($errUserName) {
        echo '<script>alert("You cannot user an existed Username, please try again.");</script>';
    } else if ($errUserID) {
        echo '<script>alert("You cannot user an existed User ID, please try again.");</script>';
    } else {
        echo '<script>alert("OK");</script>';
    }
}



?>