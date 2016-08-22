<?php
require 'loginValidationSalesManager.php';
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/showProduct.css">
    <script type="text/javascript" src="../js/showProduct.js"></script>
</head>
<body>

<div id="showProductSort" class="show_product_sort">
    <p style="font-size:20px;">Sort by:</p>
    <form id="sortForm" name="sortForm" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
        <div class="show_product_sort_1">
            <select id="sortProduct1" name="sortProduct1" size="0" onchange="changeSelectList()">
                <option value="sortProductIndex">Index</option>
                <option value="sortProductID">Product ID</option>
                <option value="sortProductName">Product Name</option>
                <option value="sortProductOriginalPrice">Product Original Price</option>
                <option value="sortProductCategory">Product Category</option>
                <option value="sortProductQuantity">Product Quantity</option>
            </select>
        </div>

        <div id="showProductSort2" class="show_product_sort_2">
            <select id="sortProduct2" name="sortProduct2" size="0">
                <option value="ascending">Ascending</option>
                <option value="descending">Descending</option>
            </select>
        </div>

        <div id="showProductSort3" class="show_product_sort_3">
            <input type="submit" onclick="return submitSortForm('sortForm', 'sortProduct1')" value="Sort It"/>
        </div>
    </form>
</div>

<div id="showProductSearch" class="show_product_search">
    <p>Search by: <span style="font-size:13px;"><i>You can only input lowercase letters</i></span></p>
    <form id="searchForm" name="searchForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
        <div id="showProductSearch1" class="show_product_search_1">
            <select id="searchProduct1" name="searchProduct1" size="0">
                <option value="searchProductName">productName</option>
                <option value="searchProductDescription">productDescription</option>
            </select>
        </div>

        <div id="showProductSearch2" class="show_product_search_2">
            <input type="text" id="searchProductKeyword" name="searchProductKeyword" placeholder="Keyword" required/>
        </div>

        <div id="showProductSearch3" class="show_product_search_3">
            <input type="submit" onclick="return submitSearchForm('searchForm', 'searchProductKeyword')" value="Search It"/>
        </div>
    </form>
</div>

<div id="showProductResult" class="show_product_result">
    <?php
    $selectList1 = $_POST['sortProduct1'];
    $selectList2 = $_POST['sortProduct2'];
    $selectList3 = $_POST['sortProduct2From'];
    $selectList4 = $_POST['sortProduct2To'];

    $search1 = $_POST['searchProduct1'];
    $search2 = $_POST['searchProductKeyword'];

    if ($selectList1 == "" && $selectList2 == "" && $selectList3 == "" && $selectList4 == "" && $search1 == "" && $search2 == "") {
        $sql = 'SELECT productIndex, productID, productName, productOriginalPrice, productCategory, productQuantity, productDescription, productImage FROM product;';
    } else if ($selectList1 == "sortProductIndex") {
        if ($selectList2 == "ascending") {
            $sql = 'SELECT productIndex, productID, productName, productOriginalPrice, productCategory, productQuantity, productDescription, productImage FROM product ORDER BY productIndex;';
        } else {
            $sql = 'SELECT productIndex, productID, productName, productOriginalPrice, productCategory, productQuantity, productDescription, productImage FROM product ORDER BY productIndex DESC;';
        }
    } else if ($selectList1 == "sortProductID") {
        if ($selectList2 == "ascending") {
            $sql = 'SELECT productIndex, productID, productName, productOriginalPrice, productCategory, productQuantity, productDescription, productImage FROM product ORDER BY productID;';
        } else {
            $sql = 'SELECT productIndex, productID, productName, productOriginalPrice, productCategory, productQuantity, productDescription, productImage FROM product ORDER BY productID DESC;';
        }
    } else if ($selectList1 == "sortProductName") {
        if ($selectList2 == "ascending") {
            $sql = 'SELECT productIndex, productID, productName, productOriginalPrice, productCategory, productQuantity, productDescription, productImage FROM product ORDER BY productName;';
        } else {
            //echo 'Sort by Name and Descending<br>';
            $sql = 'SELECT productIndex, productID, productName, productOriginalPrice, productCategory, productQuantity, productDescription, productImage FROM product ORDER BY productName DESC;';
        }
    } else if ($selectList1 == "sortProductCategory") {
        if ($selectList2 == "onlyWoodwind") {
            $sql = 'SELECT productIndex, productID, productName, productOriginalPrice, productCategory, productQuantity, productDescription, productImage FROM product WHERE productCategory="Woodwind";';
        } else if ($selectList2 == "onlyBrass") {
            $sql = 'SELECT productIndex, productID, productName, productOriginalPrice, productCategory, productQuantity, productDescription, productImage FROM product WHERE productCategory="Brass";';
        } else if ($selectList2 == "onlyPercussion") {
            $sql = 'SELECT productIndex, productID, productName, productOriginalPrice, productCategory, productQuantity, productDescription, productImage FROM product WHERE productCategory="Percussion";';
        } else if ($selectList2 == "onlyKeyboard") {
            $sql = 'SELECT productIndex, productID, productName, productOriginalPrice, productCategory, productQuantity, productDescription, productImage FROM product WHERE productCategory="Keyboard";';
        } else if ($selectList2 == "onlyString") {
            $sql = 'SELECT productIndex, productID, productName, productOriginalPrice, productCategory, productQuantity, productDescription, productImage FROM product WHERE productCategory="String";';
        }
    } else if ($selectList1 == "sortProductQuantity") {
        if ($selectList2 == "ascending") {
            $sql = 'SELECT productIndex, productID, productName, productOriginalPrice, productCategory, productQuantity, productDescription, productImage FROM product ORDER BY productQuantity;';
        } else {
            $sql = 'SELECT productIndex, productID, productName, productOriginalPrice, productCategory, productQuantity, productDescription, productImage FROM product ORDER BY productQuantity DESC;';
        }
    } else if ($selectList1 == 'sortProductOriginalPrice') {
        $sql = 'SELECT productIndex, productID, productName, productOriginalPrice, productCategory, productQuantity, productDescription, productImage FROM product WHERE productOriginalPrice BETWEEN ' . $selectList3 . ' AND ' . $selectList4 . ';';
    } else if ($search1 == "searchProductName") {
        $sql = 'SELECT productIndex, productID, productName, productOriginalPrice, productCategory, productQuantity, productDescription, productImage FROM product WHERE productName LIKE "%' . $search2 . '%";';
    } else if ($search1 == "searchProductDescription") {
        $sql = 'SELECT productIndex, productID, productName, productOriginalPrice, productCategory, productQuantity, productDescription, productImage FROM product WHERE productDescription LIKE "%' . $search2 . '%";';
    }

    require '../connect.php';
    $res = mysql_query($sql, $con);
    if(!$res) {
        die('Could not get TABLE "product": ' . mysql_error());
    }

    echo
        "<table>" .
        "<tr>" .
        "<th>Index</th>" .
        "<th>Product ID</th>" .
        "<th>Name</th>" .
        "<th>Original Price</th>" .
        "<th>Category</th>" .
        "<th>Quantity</th>" .
        "<th>Description</th>" .
        "<th>Image</th>" .
        "</tr>";

    while($row = mysql_fetch_array($res, MYSQL_ASSOC)) {
        echo
            "<tr>" .
            "<td>{$row['productIndex']}</td>" .
            "<td>{$row['productID']}</td>" .
            "<td>{$row['productName']}</td>" .
            "<td>{$row['productOriginalPrice']}" . " {$row['employeeLastName']}</td>" .
            "<td>{$row['productCategory']}</td>" .
            "<td>{$row['productQuantity']}</td>" .
            "<td>{$row['productDescription']}</td>" .
            "<td><img src='../" . $row['productImage'] . "' style='width:150px;height:150px;border:1px solid black;'/></td>" .
            "</tr>";
    }
    echo "</table>";
    mysql_close($con);
    ?>
</div>
</body>
</html>