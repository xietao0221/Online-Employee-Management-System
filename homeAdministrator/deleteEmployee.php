<?php
require 'loginValidationAdministrator.php';
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/deleteEmployee.css">
</head>
<body>

<div id="deleteEmployeeSort" class="delete_employee_sort">
    <p>Please choose what you want to delete</p>
</div>

<div id="deleteEmployeeResult" class="delete_employee_result">
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
    <?php
    require '../connect.php';
    if(isset($_POST['deleteIndex'])) {
        foreach ($_POST['deleteIndex'] as $deleteIndex) {

            require '../connect.php';
            $sql = 'SELECT userID FROM user WHERE userName="' .
                $_SESSION['userNameLogin'] . '"';
            $res = mysql_query($sql, $con);
            $row = mysql_fetch_assoc($res);
            if ($row['userID'] !== $deleteIndex) {
                $sqlDelete = "DELETE FROM user WHERE userID='" . $deleteIndex . "';";
                $res = mysql_query($sqlDelete, $con);
                if(!$res) {
                    die('Could not delete data from TABLE "user": ' . mysql_error());
                }

                $sqlDelete = "DELETE FROM employee WHERE userID='" . $deleteIndex . "';";
                $res = mysql_query($sqlDelete, $con);
                if(!$res) {
                    die('Could not delete data from TABLE "employee": ' . mysql_error());
                }
            } else {
                echo "<script type='text/javascript'>alert('You cannot delete yourself, please choose again.');</script>";
            }
        }
    }

    $sql = 'SELECT * FROM employee;';
    $res = mysql_query($sql, $con);
    if(!$res) {
        die('Could not get TABLE "employee": ' . mysql_error());
    }

    echo
        "<table>" .
        "<tr>" .
        "<th>Choose</th>" .
        "<th>Index</th>" .
        "<th>User ID</th>" .
        "<th>User Type</th>" .
        "<th>Name</th>" .
        "<th>Gender</th>" .
        "<th>Age</th>" .
        "<th>Salary</th>" .
        "</tr>";

    while($row = mysql_fetch_array($res, MYSQL_ASSOC)) {
        echo
            "<tr>" .
            "<td><input type='checkbox' name='deleteIndex[]' value=" . $row['userID'] . "></td>" .
            "<td>{$row['employeeIndex']}</td>" .
            "<td>{$row['userID']}</td>" .
            "<td>{$row['userType']}</td>" .
            "<td>{$row['employeeFirstName']}" . " {$row['employeeLastName']}</td>" .
            "<td>{$row['employeeGender']}</td>" .
            "<td>{$row['employeeAge']}</td>" .
            "<td>{$row['employeeSalary']}</td>" .
            "</tr>";
    }
    echo "</table>";
    mysql_close($con);
    ?>
        <button type="submit" class="delete_employee_submit">Delete it</button>
    </form>
</div>
</body>
</html>