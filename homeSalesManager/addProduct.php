<?php
require 'loginValidationSalesManager.php';
?>
<html>
<head lang="en">
    <link type="text/css" rel="stylesheet" href="../css/addProduct.css">
    <script type="text/javascript" src="../js/addProduct.js"></script>
</head>
<body>

<div id="addProductInput" class="add_product_input">
    <p>Please input product information: <span style="font-size:13px;"><i>You can only input letters and numbers</i></p>
    <form id="addProductInputForm" name="addProductInputForm" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" autocomplete="off" enctype="multipart/form-data">
        <table>
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Original Price</th>
            </tr>
            <tr>
                <td><input type="text" name="addProductInputProductID" class="add_product_input_text" placeholder="Product ID"/></td>
                <td><input type="text" name="addProductInputProductName" class="add_product_input_text" placeholder="Product Name"/></td>
                <td><input type="number" name="addProductInputProductOriginalPrice" class="add_product_input_text" placeholder="Original Price"/></td>
            </tr>
        </table>

        <table>
            <tr>
                <th>Product Quantity</th>
                <th>Product Category</th>
                <th>Sales Type</th>
            </tr>
            <tr>
                <td><input type="number" name="addProductInputProductQuantity" class="add_product_input_text" placeholder="Product Quantity"/></td>
                <td>
                    <select id="addProductInputProductCategory" name="addProductInputProductCategory" size="0">
                        <option value="WoodWind">WoodWind</option>
                        <option value="Brass">Brass</option>
                        <option value="Percussion">Percussion</option>
                        <option value="Keyboard">Keyboard</option>
                        <option value="String">String</option>
                    </select>
                    <p style="font-size:12px;">Fill out the following blank to add an category:</p>
                    <p><input type="text" id="addProductInputProductCategoryExtra" name="addProductInputProductCategoryExtra" onchange="return addOption('addProductInputProductCategoryExtra', 'addProductInputProductCategory')"></p>
                </td>
                <td>
                    <select id="addProductInputSalesType" name="addProductInputSalesType" size="0" onchange="displaySalesExtraInput()">
                        <option value="0">Original Price</option>
                        <option value="1">Sales</option>
                    </select>
                </td>
            </tr>
        </table>

        <table id="displaySalesExtraInput" style="display:none">
            <tr>
                <th>Sales Discount</th>
                <th>Sales Start Date</th>
                <th>Sales End Date</th>
            </tr>
            <tr>
                <td><input type="number" step="0.01" id="addProductInputSalesDiscount" name="addProductInputSalesDiscount" class="add_product_input_text" placeholder="Sales Discount"/></td>
                <td><input type="date" id="addProductInputSalesStartDate" name="addProductInputSalesStartDate" class="add_product_input_text" placeholder="Sales Start Date"/></td>
                <td><input type="date" id="addProductInputSalesEndDate" name="addProductInputSalesEndDate" class="add_product_input_text" placeholder="Sales End Date"/></td>
            </tr>


        </table>

        <table>
            <tr>
                <th>Product Image</th>
                <th>Product Description</th>
            </tr>
            <tr>
                <td>
                    <input type="file" id="addProductInputImage" name="addProductInputImage" required/>
                </td>

                <td>
                    <textarea id="addProductInputProductDescription" name="addProductInputProductDescription" rows="10" cols="50" placeholder="Product Description"></textarea>
                </td>
            </tr>
        </table>
        <button type="submit" id="addProductSubmit" name="addProductSubmit" class="add_product_submit" onclick="return checkForm()">Add it</button>
    </form>


</div>

<div id="addProductResult" class="add_product_result">
    <?php
    require '../connect.php';

    if ($_POST['addProductInputProductID']) {

        $errProduct = "";
        $errProductID = "";

        $sql = 'SELECT productID FROM product WHERE productID="' . $_POST['addProductInputProductID'] .
            '" AND productName="' . $_POST['addProductInputProductName'] . '";';
        $res = mysql_query($sql, $con);
        if(!$res) {
            die('Could not get data from "product": ' . mysql_error());
        }
        if ($row = mysql_fetch_array($res, MYSQL_ASSOC)) {
            $errProduct = true;
        }

        $sql = 'SELECT productID FROM product WHERE productID="' . $_POST['addProductInputProductID'] . '";';
        $res = mysql_query($sql, $con);
        if(!$res) {
            die('Could not get data from "product": ' . mysql_error());
        }
        if ($row = mysql_fetch_array($res, MYSQL_ASSOC)) {
            $errProductID = true;
        }


        if ($errProduct) {
            echo '<script>alert("You cannot add an existed product, please try again.");</script>';
        } else {
            if ($errProductID) {
                echo '<script>alert("You cannot use an existed product ID, please try again.");</script>';
            } else {


                require '../imageUpload.php';
                $fileDirectory = 'picture/' . basename($_FILES["addProductInputImage"]["name"]);

                $sqlAdd = 'INSERT INTO product ' .
                    '(productID, productName, productOriginalPrice, salesType, productCategory, productQuantity, productDescription, productImage) VALUES ("' .
                    $_POST['addProductInputProductID'] . '", "' . $_POST['addProductInputProductName'] . '", "' .
                    $_POST['addProductInputProductOriginalPrice'] . '", "' . $_POST['addProductInputSalesType'] . '", "' .
                    $_POST['addProductInputProductCategory'] . '", "' . $_POST['addProductInputProductQuantity'] . '", "' .
                    $_POST['addProductInputProductDescription'] . '", "' . $fileDirectory .
                    '");';

                $res = mysql_query($sqlAdd, $con);
                if(!$res) {
                    die('Could not insert data to "product": ' . mysql_error());
                }

                if ($_POST['addProductInputSalesDiscount']) {
                    $sqlAdd = 'INSERT INTO sales ' .
                        '(productID, productName, productOriginalPrice, salesDiscount, salesPrice, salesStartDate, salesEndDate)' .
                        'VALUES ("' .
                        $_POST['addProductInputProductID'] . '", "' . $_POST['addProductInputProductName'] . '", "' .
                        $_POST['addProductInputProductOriginalPrice'] . '", "' . $_POST['addProductInputSalesDiscount'] . '", "' .
                        ($_POST['addProductInputProductOriginalPrice'] * $_POST['addProductInputSalesDiscount']) . '", "' . $_POST['addProductInputSalesStartDate'] . '", "' .
                        $_POST['addProductInputSalesEndDate'] . '");';

                    $res = mysql_query($sqlAdd, $con);
                    if(!$res) {
                        die('Could not insert data to "employee": ' . mysql_error());
                    }
                }
            }
        }
    }

    $sql = 'SELECT * FROM product;';
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