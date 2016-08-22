<?php
require 'loginValidationSalesManager.php';
?>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/homepage.css">
    <link type="text/css" rel="stylesheet" href="../css/showProduct.css">
    <link type="text/css" rel="stylesheet" href="../css/showSales.css">
    <link type="text/css" rel="stylesheet" href="../css/addProduct.css">
    <link rel="stylesheet" type="text/css" href="../css/deleteProduct.css">
    <link rel="stylesheet" type="text/css" href="../css/modifyProduct.css">

    <script type="text/javascript" src="../js/homeSalesManager.js"></script>
    <script type="text/javascript" src="../js/showProduct.js"></script>
    <script type="text/javascript" src="../js/showSales.js"></script>
    <script type="text/javascript" src="../js/addProduct.js"></script>
    <script type="text/javascript" src="../js/modifyProduct.js"></script>

    <title>Homepage | Sales Manager</title>
</head>
<body>

<div class="home_container">
    <div class="home_header">
        <div class="home_header_left" style="margin-left:-28px">Sales Manager</div>

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
                <button type="button" onclick="showProduct()">
                    <i class="fa fa-list-ul"></i>
                    Show Product
                </button>
            </li>

            <li>
                <button type="button" onclick="showSales()">
                    <i class="fa fa-list-ul"></i>
                    Show Sales
                </button>
            </li>

            <li>
                <button type="button" onclick="addProduct()">
                    <i class="fa fa-plus-square"></i>
                    Add Product
                </button>
            </li>

            <li>
                <button type="button" onclick="deleteProduct()">
                    <i class="fa fa-scissors"></i>
                    Delete Product
                </button>
            </li>

            <li>
                <button type="button" onclick="modifyProduct()">
                    <i class="fa fa-check-square"></i>
                    Modify Product
                </button>
            </li>

        </ul>
    </div>



    <div id="homeContent" name="homeContent" class="home_content">
        <p>
            <?php
            require 'showNameForSalesManager.php';
            ?>
        </p>
    </div>
</div>

</body>
</html>