<?php
require 'loginValidationAdministrator.php';
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/modifyEmployee.css">
    <script type="text/javascript" src="../js/modifyEmployee.js"></script>
</head>
<body>

<div id="modifyEmployeeInformation" class="modify_employee_information">
    <p>Please choose what you want to modify</p>
</div>

<div id="modifyEmployeeChoice" class="modify_employee_choice">
    <form name="modifyEmployeeInputForm" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
        <?php
        require '../connect.php';
        if(isset($_POST['modifyIndex'])) {
            require '../connect.php';
            $sql = 'SELECT userID FROM user WHERE userName="' .
                $_SESSION['userNameLogin'] . '"';
            $res = mysql_query($sql, $con);
            $row = mysql_fetch_assoc($res);
            if ($row['userID'] !== $_POST['modifyIndex']) {
                $sqlModifyUser = 'UPDATE user SET userID="' . $_POST['modifyEmployeeInputUserID'] .
                    '", userType="' . $_POST['modifyEmployeeInputUserType'] .
                    '", userName="' . $_POST['modifyEmployeeInputUsername'] .
                    '", passWord="' . MD5($_POST['modifyEmployeeInputPassword']) .
                    '" WHERE userID="' . $_POST['modifyIndex'] .
                    '";';
                $res = mysql_query($sqlModifyUser, $con);
                if (!$res) {
                    die('Could not update TABLE "user": ' . mysql_error());
                }

                $sqlModifyEmployee = 'UPDATE employee SET userID="' . $_POST['modifyEmployeeInputUserID'] .
                    '", userType="' . $_POST['modifyEmployeeInputUserType'] .
                    '", employeeFirstName="' . $_POST['modifyEmployeeInputFirstName'] .
                    '", employeeLastName="' . $_POST['modifyEmployeeInputLastName'] .
                    '", employeeGender="' . $_POST['modifyEmployeeInputGender'] .
                    '", employeeAge="' . $_POST['modifyEmployeeInputAge'] .
                    '", employeeSalary="' . $_POST['modifyEmployeeInputSalary'] .
                    '" WHERE userID="' . $_POST['modifyIndex'] .
                    '";';
                $res = mysql_query($sqlModifyEmployee, $con);
                if (!$res) {
                    die('Could not update TABLE "employee": ' . mysql_error());
                }

                $sql = 'SELECT * FROM employee;';
                $res = mysql_query($sql, $con);
                if (!$res) {
                    die('Could not get TABLE "employee": ' . mysql_error());
                }
            } else {
                echo "<script type='text/javascript'>alert('You cannot modify yourself, please choose again.');</script>";
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
            "<th>Choose</th>" .
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
                "<td><input type='radio' name='modifyIndex' value=" . $row['userID'] . " onchange='displayInput()'></td>" .
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


        <div id="modifyEmployeeInput" class="modify_employee_input" style="display:none;">
            <p>Please input personal information: <span style="font-size:13px;"><i>You can only input letters and numbers</i></p>
            <table>
                <tr>
                    <th>UserID</th>
                    <th>Username</th>
                    <th>Password</th>
                </tr>
                <tr>
                    <td><input type="text" name="modifyEmployeeInputUserID" class="modify_employee_input_text" placeholder="User ID"/></td>
                    <td><input type="text" name="modifyEmployeeInputUsername" class="modify_employee_input_text" placeholder="Username"/></td>
                    <td><input type="text" name="modifyEmployeeInputPassword" class="modify_employee_input_text" placeholder="Password"/></td>
                </tr>
            </table>

            <table>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Age</th>
                </tr>
                <tr>
                    <td><input type="text" name="modifyEmployeeInputFirstName" class="modify_employee_input_text" placeholder="First Name"/></td>
                    <td><input type="text" name="modifyEmployeeInputLastName" class="modify_employee_input_text" placeholder="Last Name"/></td>
                    <td><input type="number" name="modifyEmployeeInputAge" class="modify_employee_input_text" placeholder="Age"/></td>
                </tr>
            </table>

            <table>
                <tr>
                    <th>Salary</th>
                    <th>User Type</th>
                    <th>Gender</th>
                </tr>
                <tr>
                    <td><input type="number" name="modifyEmployeeInputSalary" class="modify_employee_input_text" placeholder="Salary"/></td>

                    <td>
                        <select id="modifyEmployeeInputUserType" name="modifyEmployeeInputUserType" size="0">
                            <option value="manager">Manager</option>
                            <option value="administrator">Administrator</option>
                            <option value="salesManager">Sales Manager</option>
                        </select>
                    </td>
                    <td>
                        <select id="modifyEmployeeInputGender" name="modifyEmployeeInputGender" size="0">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </td>
                </tr>
            </table>
        </div>
        <button type="submit" class="modify_employee_submit" onclick="return checkForm()">Modify it</button>
    </form>
</div>
</body>
</html>