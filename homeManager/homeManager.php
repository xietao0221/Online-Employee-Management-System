<?php
require 'loginValidationManager.php';
?>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../css/homepage.css">
    <link rel="stylesheet" type="text/css" href="../css/showEmployee.css">
    <link rel="stylesheet" type="text/css" href="../css/showProduct.css">
    <link rel="stylesheet" type="text/css" href="../css/showSales.css">
    <link rel="stylesheet" href="../css/font-awesome/css/font-awesome.min.css">
    <script type="text/javascript" src="../js/homeManager.js"></script>
    <script type="text/javascript" src="../js/showEmployee.js"></script>
    <script type="text/javascript" src="../js/showProduct.js"></script>
    <script type="text/javascript" src="../js/showSales.js"></script>
    <title>Homepage | Manager</title>
</head>
<body>

<div class="home_container">
    <div class="home_header">
        <div class="home_header_left">Manager</div>

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
                <button type="button" onclick="showProduct()">
                    <i class="fa fa-book"></i>
                    Show Product
                </button>
            </li>

            <li>
                <button type="button" onclick="showSales()">
                    <i class="fa fa-usd"></i>
                    Show Sales
                </button>
            </li>
        </ul>
    </div>



    <div id="homeContent" name="homeContent" class="home_content">
        <p>
            <?php
            require 'showNameForManager.php';
            ?>
        </p>
    </div>
</div>

</body>
</html>