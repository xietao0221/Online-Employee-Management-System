<?php
require 'loginValidationSalesManager.php';
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/deleteProduct.css">
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
                $sqlSalesType = 'SELECT * FROM product WHERE productID="' . $deleteIndex . '";';
                $res = mysql_query($sqlSalesType, $con);
                if(!$res) {
                    die('Could not delete data from TABLE "product": ' . mysql_error());
                }
                $row = mysql_fetch_assoc($res);
                if ($row['salesType'] == true ) {
                    $sqlDelete = "DELETE FROM sales WHERE productID='" . $deleteIndex . "';";
                    $res = mysql_query($sqlDelete, $con);
                    if (!$res) {
                        die('Could not delete data from TABLE "employee": ' . mysql_error());
                    }
                }
                $sqlDelete = "DELETE FROM product WHERE productID='" . $deleteIndex . "';";
                $res = mysql_query($sqlDelete, $con);
                if(!$res) {
                    die('Could not delete data from TABLE "user": ' . mysql_error());
                }

                $imageDelete = '../' . $row['productImage'];
                if (!unlink($imageDelete)) {
                    echo 'Image deleted unsuccessfully.';
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
                "<td><input type='checkbox' name='deleteIndex[]' value=" . $row['productID'] . "></td>" .
                "<td>{$row['productIndex']}</td>" .
                "<td>{$row['productID']}</td>" .
                "<td>{$row['productName']}</td>" .
                "<td>{$row['productOriginalPrice']}" .
                "<td>{$row['salesType']}</td>" .
                "<td>{$row['productCategory']}</td>" .
                "<td>{$row['productQuantity']}</td>" .
                "<td>{$row['productDescription']}</td>" .
                "<td><img src='../" . $row['productImage'] . "' style='width:150px;height:150px;border:1px solid black;'/></td>" .
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