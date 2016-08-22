<?php
require 'loginValidationSalesManager.php';
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/modifyProduct.css">
    <script type="text/javascript" src="../js/modifyProduct.js"></script>
</head>
<body>

<div id="modifyProductInformation" class="modify_product_information">
    <p>Please choose what you want to modify</p>
</div>

<div id="modifyProductChoice" class="modify_product_choice">
    <form name="modifyProductInputForm" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off" enctype="multipart/form-data">
        <?php
        require '../connect.php';

        if(isset($_POST['modifyIndex'])) {
            $sqlSalesType = 'SELECT * FROM product WHERE productID="' . $_POST['modifyIndex'] . '";';
            $res = mysql_query($sqlSalesType, $con);
            if(!$res) {
                die('Could not delete data from TABLE "product": ' . mysql_error());
            }
            $row = mysql_fetch_assoc($res);

            if ($row['salesType'] == true && $_POST['modifyProductInputSalesType'] == true ) {
                //echo 'update both product and sales';
                $sqlModifySales = 'UPDATE sales SET productID="' . $_POST['modifyProductInputProductID'] .
                    '", productName="' . $_POST['modifyProductInputProductName'] .
                    '", productOriginalPrice="' . $_POST['modifyProductInputProductOriginalPrice'] .
                    '", salesDiscount="' . $_POST['modifyProductInputSalesDiscount'] .
                    '", salesPrice="' . ($_POST['modifyProductInputProductOriginalPrice'] * $_POST['modifyProductInputSalesDiscount']) .
                    '", salesStartDate="' . $_POST['modifyProductInputSalesStartDate'] .
                    '", salesEndDate="' . $_POST['modifyProductInputSalesEndDate'] .
                    '" WHERE productID="' . $_POST['modifyIndex'] .
                    '";';
                $res = mysql_query($sqlModifySales, $con);
                if (!$res) {
                    die('Could not update TABLE "sales": ' . mysql_error());
                }
            } else if ($row['salesType'] == true && $_POST['modifyProductInputSalesType'] == false) {
                //echo 'update product, delete sales';
                $sqlModifySales = "DELETE FROM sales WHERE productID='" . $_POST['modifyIndex'] . "';";
                $res = mysql_query($sqlModifySales, $con);
                if(!$res) {
                    die('Could not delete data from TABLE "sales": ' . mysql_error());
                }
            } else if ($row['salesType'] == false && $_POST['modifyProductInputSalesType'] == true) {
                //echo 'update product, add sales';
                $sqlModifySales = 'INSERT INTO sales ' .
                    '(productID, productName, productOriginalPrice, salesDiscount, salesPrice, salesStartDate, salesEndDate)' .
                    'VALUES ("' .
                    $_POST['modifyProductInputProductID'] . '", "' . $_POST['modifyProductInputProductName'] . '", "' .
                    $_POST['modifyProductInputProductOriginalPrice'] . '", "' . $_POST['modifyProductInputSalesDiscount'] . '", "' .
                    ($_POST['modifyProductInputProductOriginalPrice'] * $_POST['modifyProductInputSalesDiscount']) . '", "' . $_POST['modifyProductInputSalesStartDate'] . '", "' .
                    $_POST['modifyProductInputSalesEndDate'] . '");';
                $res = mysql_query($sqlModifySales, $con);
                if(!$res) {
                    die('Could not insert data to "sales": ' . mysql_error());
                }
            }

            $imageDelete = '../' . $row['productImage'];
            if (!unlink($imageDelete)) {
                echo 'Image deleted unsuccessfully.';
            }

            require '../imageUpload.php';
            $fileDirectory = 'picture/' . basename($_FILES["addProductInputImage"]["name"]);
//            echo $fileDirectory;


            $sqlModifyProduct = 'UPDATE product SET productID="' . $_POST['modifyProductInputProductID'] .
                '", productName="' . $_POST['modifyProductInputProductName'] .
                '", productOriginalPrice="' . $_POST['modifyProductInputProductOriginalPrice'] .
                '", salesType="' . $_POST['modifyProductInputSalesType'] .
                '", productCategory="' . $_POST['modifyProductInputProductCategory'] .
                '", productQuantity="' . $_POST['modifyProductInputProductQuantity'] .
                '", productDescription="' . $_POST['modifyProductInputProductDescription'] .
                '", productImage="' . $fileDirectory .
                '" WHERE productID="' . $_POST['modifyIndex'] .
                '";';
            $res = mysql_query($sqlModifyProduct, $con);
            if (!$res) {
                die('Could not update TABLE "sales": ' . mysql_error());
            }
        }


        $sql = 'SELECT * FROM product;';
        $res = mysql_query($sql, $con);
        if(!$res) {
            die('Could not get TABLE "user" and "product": ' . mysql_error());
        }

        echo
            "<table>" .
            "<tr>" .
            "<th>Choose</th>" .
            "<th>Index</th>" .
            "<th>Product ID</th>" .
            "<th>Name</th>" .
            "<th>Original Price</th>" .
            "<th>Sales Type</th>" .
            "<th>Category</th>" .
            "<th>Quantity</th>" .
            "<th>Description</th>" .
            "<th>Image</th>" .
            "</tr>";

        while($row = mysql_fetch_array($res, MYSQL_ASSOC)) {
            echo
                "<tr>" .
                "<td><input type='radio' name='modifyIndex' value=" . $row['productID'] . " onchange='displayInput()'></td>" .
                "<td>{$row['productIndex']}</td>" .
                "<td>{$row['productID']}</td>" .
                "<td>{$row['productName']}</td>" .
                "<td>{$row['productOriginalPrice']}</td>" .
                "<td>{$row['salesType']}" .
                "<td>{$row['productCategory']}</td>" .
                "<td>{$row['productQuantity']}</td>" .
                "<td>{$row['productDescription']}</td>" .
                "<td><img src='../" . $row['productImage'] . "' style='width:150px;height:150px;border:1px solid black;'/></td>" .
                "</tr>";
        }
        echo "</table>";
        mysql_close($con);
        ?>

        <div id="modifyProductInput" class="modify_product_input" style="display:none;">
            <p>Please input personal information: <span style="font-size:13px;"><i>You can only input letters and numbers</i></p>

            <table>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Original Price</th>
                </tr>
                <tr>
                    <td><input type="text" name="modifyProductInputProductID" class="modify_product_input_text" placeholder="Product ID"/></td>
                    <td><input type="text" name="modifyProductInputProductName" class="modify_product_input_text" placeholder="Product Name"/></td>
                    <td><input type="number" name="modifyProductInputProductOriginalPrice" class="modify_product_input_text" placeholder="Original Price"/></td>
                </tr>
            </table>

            <table>
                <tr>
                    <th>Product Quantity</th>
                    <th>Product Category</th>
                    <th>Sales Type</th>
                </tr>
                <tr>
                    <td><input type="number" name="modifyProductInputProductQuantity" class="modify_product_input_text" placeholder="Product Quantity"/></td>
                    <td>
                        <select id="modifyProductInputProductCategory" name="modifyProductInputProductCategory" size="0">
                            <option value="WoodWind">WoodWind</option>
                            <option value="Brass">Brass</option>
                            <option value="Percussion">Percussion</option>
                            <option value="Keyboard">Keyboard</option>
                            <option value="String">String</option>
                        </select>
                        <p style="font-size:12px;">Fill out the following blank to add an category:</p>
                        <p><input type="text" id="modifyProductInputProductCategoryExtra" name="modifyProductInputProductCategoryExtra" onchange="return addOption('modifyProductInputProductCategoryExtra', 'modifyProductInputProductCategory')"></p>
                    </td>
                    <td>
                        <select id="modifyProductInputSalesType" name="modifyProductInputSalesType" size="0" onchange="displaySalesExtraInput()">
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
                    <td><input type="number" step="0.01" id="modifyProductInputSalesDiscount" name="modifyProductInputSalesDiscount" class="modify_product_input_text" placeholder="Sales Discount"/></td>
                    <td><input type="date" id="modifyProductInputSalesStartDate" name="modifyProductInputSalesStartDate" class="modify_product_input_text" placeholder="Sales Start Date"/></td>
                    <td><input type="date" id="modifyProductInputSalesEndDate" name="modifyProductInputSalesEndDate" class="modify_product_input_text" placeholder="Sales End Date"/></td>
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
                        <textarea id="modifyProductInputProductDescription" name="modifyProductInputProductDescription" rows="10" cols="50" placeholder="Product Description"></textarea>
                    </td>
                </tr>
            </table>
        </div>
        <button type="submit" class="modify_product_submit" onclick="checkForm()">Modify it</button>
    </form>
</div>
</body>
</html>