<?php
require 'loginValidationAdministrator.php';
?>
<html>
<head lang="en">
    <link type="text/css" rel="stylesheet" href="../css/addEmployee.css">
    <script type="text/javascript" src="../js/addEmployee.js"></script>
</head>
<body>

<div id="addEmployeeInput" class="add_employee_input">
    <p>Please input personal information: <span style="font-size:13px;"><i>You can only input letters and numbers</i></span></p>
    <form id="addEmployeeInputForm" name="addEmployeeInputForm" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" autocomplete="off">
        <table>
            <tr>
                <th>UserID</th>
                <th>Username</th>
                <th>Password</th>
            </tr>
            <tr>
                <td><input type="text" name="addEmployeeInputUserID" class="add_employee_input_text" placeholder="User ID"/></td>
                <td><input type="text" name="addEmployeeInputUsername" class="add_employee_input_text" placeholder="Username"/></td>
                <td><input type="text" name="addEmployeeInputPassword" class="add_employee_input_text" placeholder="Password"/></td>
            </tr>
        </table>

        <table>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Age</th>
            </tr>
            <tr>
                <td><input type="text" name="addEmployeeInputFirstName" class="add_employee_input_text" placeholder="First Name"/></td>
                <td><input type="text" name="addEmployeeInputLastName" class="add_employee_input_text" placeholder="Last Name"/></td>
                <td><input type="number" name="addEmployeeInputAge" class="add_employee_input_text" placeholder="Age"/></td>
            </tr>
        </table>

        <table>
            <tr>
                <th>Salary</th>
                <th>User Type</th>
                <th>Gender</th>
            </tr>
            <tr>
                <td><input type="number" name="addEmployeeInputSalary" class="add_employee_input_text" placeholder="Salary"/></td>

                <td>
                    <select id="addEmployeeInputUserType" name="addEmployeeInputUserType" size="0">
                        <option value="manager">Manager</option>
                        <option value="administrator">Administrator</option>
                        <option value="salesManager">Sales Manager</option>
                    </select>
                </td>
                <td>
                    <select id="addEmployeeInputGender" name="addEmployeeInputGender" size="0">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </td>
            </tr>
        </table>
        <button type="submit" id="addEmployeeSubmit" name="addEmployeeSubmit" class="add_employee_submit" onclick="return checkForm()">Add it</button>
    </form>


</div>

<div id="addEmployeeResult" class="add_employee_result">
    <?php
    require '../connect.php';


    if ($_POST['addEmployeeInputUserID']) {

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
                $sqlAdd = 'INSERT INTO user (userID, userType, userName, passWord) VALUES ("' .
                    $_POST['addEmployeeInputUserID'] . '", "' . $_POST['addEmployeeInputUserType'] . '", "' .
                    $_POST['addEmployeeInputUsername'] . '", "' . MD5($_POST['addEmployeeInputPassword']) . '");';
                $res = mysql_query($sqlAdd, $con);
                if(!$res) {
                    die('Could not insert data to "user": ' . mysql_error());
                }

                $sqlAdd = 'INSERT INTO employee ' .
                    '(userID, userType, employeeFirstName, employeeLastName, employeeGender, employeeAge, employeeSalary)' .
                    'VALUES ("' .
                    $_POST['addEmployeeInputUserID'] . '", "' . $_POST['addEmployeeInputUserType'] . '", "' .
                    $_POST['addEmployeeInputFirstName'] . '", "' . $_POST['addEmployeeInputLastName'] . '", "' .
                    $_POST['addEmployeeInputGender'] . '", "' . $_POST['addEmployeeInputAge'] . '", "' .
                    $_POST['addEmployeeInputSalary'] . '");';
                $res = mysql_query($sqlAdd, $con);
                if(!$res) {
                    die('Could not insert data to "employee": ' . mysql_error());
                }
            }
        }
    }
    $sql = 'SELECT user.userIndex, user.userID, user.userType, user.userName, employee.employeeFirstName, employee.employeeLastName, employee.employeeGender, employee.employeeAge, employee.employeeSalary FROM user, employee WHERE user.userID=employee.userID;';
    $res = mysql_query($sql, $con);
    if(!$res) {
        die('Could not get TABLE "user" and "employee": ' . mysql_error());
    }

    echo
        "<table>" .
        "<tr>" .
        "<th>Index</th>" .
        "<th>User ID</th>" .
        "<th>User Type</th>" .
        "<th>User Name</th>" .
        "<th>Name</th>" .
        "<th>Gender</th>" .
        "<th>Age</th>" .
        "<th>Salary</th>" .
        "</tr>";

    while($row = mysql_fetch_array($res, MYSQL_ASSOC)) {
        echo
            "<tr>" .
            "<td>{$row['userIndex']}</td>" .
            "<td>{$row['userID']}</td>" .
            "<td>{$row['userType']}</td>" .
            "<td>{$row['userName']}</td>" .
            "<td>{$row['employeeFirstName']}" . " {$row['employeeLastName']}</td>" .
            "<td>{$row['employeeGender']}</td>" .
            "<td>{$row['employeeAge']}</td>" .
            "<td>{$row['employeeSalary']}</td>" .
            "</tr>";
    }
    echo "</table>";
    mysql_close($con);
    ?>
</div>
</body>
</html>