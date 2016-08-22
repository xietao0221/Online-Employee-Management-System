<?php
require 'loginValidationSalesManager.php';
require '../connect.php';
$sql = 'SELECT userID FROM user WHERE userName="' .
    $_SESSION['userNameLogin'] . '"';
$res = mysql_query($sql, $con);
$row = mysql_fetch_assoc($res);

$sql = 'SELECT * FROM employee WHERE userID="' .
    $row['userID'] . '";';
$res = mysql_query($sql, $con);
$row = mysql_fetch_assoc($res);

echo '<div style="font-size:30px;margin-left:30px;margin-top:40px;">Hello, ' . $row['employeeFirstName'] . ' ' . $row['employeeLastName'] . '</div>';
mysql_close($con);
?>