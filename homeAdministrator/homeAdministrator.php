<?php
require 'loginValidationAdministrator.php';
?>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/homepage.css">
    <link rel="stylesheet" type="text/css" href="../css/showEmployee.css">
    <link rel="stylesheet" type="text/css" href="../css/addEmployee.css">
    <link rel="stylesheet" type="text/css" href="../css/deleteEmployee.css">
    <link rel="stylesheet" type="text/css" href="../css/modifyEmployee.css">

    <link rel="stylesheet" href="../css/font-awesome/css/font-awesome.min.css">
    <script type="text/javascript" src="../js/homeAdministrator.js"></script>
    <script type="text/javascript" src="../js/showEmployee.js"></script>
    <script type="text/javascript" src="../js/modifyEmployee.js"></script>


    <title>Homepage | Administrator</title>
</head>
<body>

<div class="home_container">
    <div class="home_header">
        <div class="home_header_left" style="margin-left:-20px">Administrator</div>

        <div class="home_header_right">
            <button id="buttonLogOut" name="buttonLogOut" class="button_log_out" onclick="return buttonLogOut()">
                <i class="fa fa-power-off"></i>  Log out
            </button>

        </div>
    </div>

    <div class="home_navigation">
        <ul class="home_navigation_menu">
            <li>
                <button type="button" onclick="showHome()">
                    <i class="fa fa-home"></i>
                    Home
                </button>
            </li>

            <li>
                <button type="button" onclick="showEmployee()">
                    <i class="fa fa-user"></i>
                    Show Employee
                </button>
            </li>

            <li>
                <button type="button" onclick="addEmployee()">
                    <i class="fa fa-user-plus"></i>
                    Add Employee
                </button>
            </li>

            <li>
                <button type="button" onclick="deleteEmployee()">
                    <i class="fa fa-user-times"></i>
                    Delete Employee
                </button>
            </li>

            <li>
                <button type="button" onclick="modifyEmployee()">
                    <i class="fa fa-user-md"></i>
                    Modify Employee
                </button>
            </li>
        </ul>
    </div>



    <div id="homeContent" name="homeContent" class="home_content">
        <p>
            <?php
            require 'showNameForAdministrator.php';
            ?>
        </p>
    </div>
</div>

</body>
</html>