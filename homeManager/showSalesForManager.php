<?php
require 'loginValidationManager.php';
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/showSales.css">
    <script type="text/javascript" src="../js/showSales.js"></script>
</head>
<body>

<div id="showSalesSort" class="show_sales_sort">
    <p style="font-size:20px;">Sort by:</p>
    <form id="sortForm" name="sortForm" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
        <div class="show_sales_sort_1">
            <select id="sortSales1" name="sortSales1" size="0" onchange="changeSelectList()">
                <option value="sortSalesIndex">Index</option>
                <option value="sortProductID">Product ID</option>
                <option value="sortProductName">Product Name</option>
                <option value="sortSalesPrice">Sales Price</option>
                <option value="sortSalesStartDate">Sales Start Date</option>
                <option value="sortSalesEndDate">Sales End Date</option>
            </select>
        </div>

        <div id="showSalesSort2" class="show_sales_sort_2">
            <select id="sortSales2" name="sortSales2" size="0">
                <option value="ascending">Ascending</option>
                <option value="descending">Descending</option>
            </select>
        </div>

        <div id="showSalesSort3" class="show_sales_sort_3">
            <input type="submit" onclick="return submitSortForm('sortForm', 'sortSales1')" value="Sort It"/>
        </div>
    </form>
</div>

<div id="showSalesSearch" class="show_sales_search">
    <p>Search by: <span style="font-size:13px;"><i>You can only input lowercase letters</i></span></p>
    <form id="searchForm" name="searchForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
        <div id="showSalesSearch1" class="show_sales_search_1">
            <select id="searchSales1" name="searchSales1" size="0">
                <option value="searchProductName">Product Name</option>
                <option value="ProductID">Product ID</option>
            </select>
        </div>

        <div id="showSalesSearch2" class="show_sales_search_2">
            <input type="text" id="searchSalesKeyword" name="searchSalesKeyword" placeholder="Keyword" required/>
        </div>

        <div id="showSalesSearch3" class="show_sales_search_3">
            <input type="submit" onclick="return submitSearchForm('searchForm', 'searchSalesKeyword')" value="Search It"/>
        </div>
    </form>
</div>

<div id="showSalesResult" class="show_sales_result">

    <?php
    $selectList1 = $_POST['sortSales1'];
    $selectList2 = $_POST['sortSales2'];
    $selectList3 = $_POST['sortSales2From'];
    $selectList4 = $_POST['sortSales2To'];

    $search1 = $_POST['searchSales1'];
    $search2 = $_POST['searchSalesKeyword'];

    if ($selectList1 == "" && $selectList2 == "" && $selectList3 == "" && $selectList4 == "" && $search1 == "" && $search2 == "") {
        $sql = 'SELECT salesIndex, productID, productName, productOriginalPrice, salesDiscount, salesPrice, salesStartDate, salesEndDate FROM sales;';
    } else if ($selectList1 == "sortSalesIndex") {
        if ($selectList2 == "ascending") {
            $sql = 'SELECT salesIndex, productID, productName, productOriginalPrice, salesDiscount, salesPrice, salesStartDate, salesEndDate FROM sales ORDER BY salesIndex;';
        } else {
            $sql = 'SELECT salesIndex, productID, productName, productOriginalPrice, salesDiscount, salesPrice, salesStartDate, salesEndDate FROM sales ORDER BY salesIndex DESC;';
        }
    } else if ($selectList1 == "sortProductID") {
        if ($selectList2 == "ascending") {
            $sql = 'SELECT salesIndex, productID, productName, productOriginalPrice, salesDiscount, salesPrice, salesStartDate, salesEndDate FROM sales ORDER BY productID;';
        } else {
            $sql = 'SELECT salesIndex, productID, productName, productOriginalPrice, salesDiscount, salesPrice, salesStartDate, salesEndDate FROM sales ORDER BY productID DESC;';
        }
    } else if ($selectList1 == "sortProductName") {
        if ($selectList2 == "ascending") {
            $sql = 'SELECT salesIndex, productID, productName, productOriginalPrice, salesDiscount, salesPrice, salesStartDate, salesEndDate FROM sales ORDER BY productName;';
        } else {
            $sql = 'SELECT salesIndex, productID, productName, productOriginalPrice, salesDiscount, salesPrice, salesStartDate, salesEndDate FROM sales ORDER BY productName DESC;';
        }
    } else if ($selectList1 == "sortSalesPrice") {
        $sql = 'SELECT salesIndex, productID, productName, productOriginalPrice, salesDiscount, salesPrice, salesStartDate, salesEndDate FROM sales WHERE salesPrice BETWEEN ' . $selectList3 . ' AND ' . $selectList4 . ';';
    } else if ($selectList1 == "sortSalesStartDate") {
        if ($selectList2 == "ascending") {
            $sql = 'SELECT salesIndex, productID, productName, productOriginalPrice, salesDiscount, salesPrice, salesStartDate, salesEndDate FROM sales ORDER BY salesStartDate;';
        } else {
            $sql = 'SELECT salesIndex, productID, productName, productOriginalPrice, salesDiscount, salesPrice, salesStartDate, salesEndDate FROM sales ORDER BY salesStartDate DESC;';
        }
    } else if ($selectList1 == "sortSalesEndDate") {
        if ($selectList2 == "ascending") {
            $sql = 'SELECT salesIndex, productID, productName, productOriginalPrice, salesDiscount, salesPrice, salesStartDate, salesEndDate FROM sales ORDER BY salesEndDate;';
        } else {
            $sql = 'SELECT salesIndex, productID, productName, productOriginalPrice, salesDiscount, salesPrice, salesStartDate, salesEndDate FROM sales ORDER BY salesEndDate DESC;';
        }
    } else if ($search1 == "searchProductName") {
        $sql = 'SELECT salesIndex, productID, productName, productOriginalPrice, salesDiscount, salesPrice, salesStartDate, salesEndDate FROM sales WHERE productName LIKE "%' . $search2 . '%";';
    } else if ($search1 == "ProductID") {
        $sql = 'SELECT salesIndex, productID, productName, productOriginalPrice, salesDiscount, salesPrice, salesStartDate, salesEndDate FROM sales WHERE productID LIKE "%' . $search2 . '%";';
    }

    require '../connect.php';
    $res = mysql_query($sql, $con);
    if(!$res) {
        die('Could not get TABLE "sales": ' . mysql_error());
    }

    echo
        "<table>" .
        "<tr>" .
        "<th>Index</th>" .
        "<th>Product ID</th>" .
        "<th>Name</th>" .
        "<th>Original Price</th>" .
        "<th>Discount</th>" .
        "<th>Sales Price</th>" .
        "<th>Sales Start Date</th>" .
        "<th>Sales End Date</th>" .
        "</tr>";

    while($row = mysql_fetch_array($res, MYSQL_ASSOC)) {
        echo
            "<tr>" .
            "<td>{$row['salesIndex']}</td>" .
            "<td>{$row['productID']}</td>" .
            "<td>{$row['productName']}</td>" .
            "<td>{$row['productOriginalPrice']}".
            "<td>{$row['salesDiscount']}</td>" .
            "<td>{$row['salesPrice']}</td>" .
            "<td>{$row['salesStartDate']}</td>" .
            "<td>{$row['salesEndDate']}</td>" .
            "</tr>";
    }
    echo "</table>";
    mysql_close($con);
    ?>
</div>
</body>
</html>