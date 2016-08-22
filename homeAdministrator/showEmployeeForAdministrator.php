<?php
require 'loginValidationAdministrator.php';
?>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/showEmployee.css">
    <script type="text/javascript" src="../js/showEmployee.js"></script>
</head>
<body>

<div id="showEmployeeSort" class="show_employee_sort">
    <p style="font-size:20px;">Sort by:</p>
    <form id="sortForm" name="sortForm" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" autocomplete="off">
        <div class="show_employee_sort_1">
            <select id="sortEmployee1" name="sortEmployee1" size="0" onchange="changeSelectList()">
                <option value="sortEmployeeIndex">Index</option>
                <option value="sortUserID">User ID</option>
                <option value="sortUserType">User Type</option>
                <option value="sortName">Name</option>
                <option value="sortGender">Gender</option>
                <option value="sortAge">Age</option>
                <option value="sortSalary">Salary</option>
            </select>
        </div>

        <div id="showEmployeeSort2" class="show_employee_sort_2">
            <select id="sortEmployee2" name="sortEmployee2" size="0">
                <option value="ascending">Ascending</option>
                <option value="descending">Descending</option>
            </select>
        </div>

        <div id="showEmployeeSort3" class="show_employee_sort_3">
            <input type="submit" onclick="return submitSortForm('sortForm', 'sortEmployee1')" value="Sort It"/>
        </div>
    </form>
</div>


<div id="showEmployeeSearch" class="show_employee_search">
    <p>Search by: <span style="font-size:13px;"><i>You can only input lowercase letters</i></span></p>
    <form id="searchForm" name="searchForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
        <div id="showEmployeeSearch1" class="show_employee_search_1">
            <select id="searchEmployee1" name="searchEmployee1" size="0">
                <option value="searchEmployeeFirstName">First Name</option>
                <option value="searchEmployeeLastName">Last Name</option>
            </select>
        </div>

        <div id="showEmployeeSearch2" class="show_employee_search_2">
            <input type="text" id="searchEmployeeKeyword" name="searchEmployeeKeyword" placeholder="Keyword" required/>
        </div>

        <div id="showEmployeeSearch3" class="show_employee_search_3">
            <input type="submit" onclick="return submitSearchForm('searchForm', 'searchEmployeeKeyword')" value="Search It"/>
        </div>
    </form>
</div>


<div id="showEmployeeResult" class="show_employee_result">
    <?php
    $selectList1 = $_POST['sortEmployee1'];
    $selectList2 = $_POST['sortEmployee2'];
    $selectList3 = $_POST['sortEmployee2From'];
    $selectList4 = $_POST['sortEmployee2To'];

    $search1 = $_POST['searchEmployee1'];
    $search2 = $_POST['searchEmployeeKeyword'];

    if ($selectList1 == "" && $selectList2 == "" && $selectList3 == ""
        && $selectList4 == "" && $search1 == "" && $search2 == "") {
        //echo 'First time to get this page<br>';
        $sql = 'SELECT * FROM employee;';
    } else if ($selectList1 == "sortEmployeeIndex") {
        if ($selectList2 == "ascending") {
            $sql = 'SELECT * FROM employee ORDER BY employeeIndex;';
        } else {
            $sql = 'SELECT * FROM employee ORDER BY employeeIndex DESC;';
        }
    } else if ($selectList1 == "sortUserID") {
        if ($selectList2 == "ascending") {
            $sql = 'SELECT * FROM employee ORDER BY userID;';
        } else {
            $sql = 'SELECT * FROM employee ORDER BY userID DESC;';
        }
    } else if ($selectList1 == "sortUserType") {
        if ($selectList2 == "onlyManager") {
            $sql = 'SELECT * FROM employee WHERE userType="manager";';
        } else if ($selectList2 == "onlyAdministrator") {
            $sql = 'SELECT * FROM employee WHERE userType="administrator";';
        } else if ($selectList2 == "onlySalesManager") {
            $sql = 'SELECT * FROM employee WHERE userType="salesManager";';
        }
    } else if ($selectList1 == "sortName") {
        if ($selectList2 == "ascending") {
            $sql = 'SELECT * FROM employee ORDER BY employeeFirstName;';
        } else {
            $sql = 'SELECT * FROM employee ORDER BY employeeFirstName DESC;';
        }
    } else if ($selectList1 == "sortGender") {
        if ($selectList2 == "onlyMale") {
            $sql = 'SELECT * FROM employee WHERE employeeGender="male";';
        } else if ($selectList2 == "onlyFemale") {
            $sql = 'SELECT * FROM employee WHERE employeeGender="female";';
        }
    } else if ($selectList1 == "sortAge") {
        if ($selectList2 == "ascending") {
            $sql = 'SELECT * FROM employee ORDER BY employeeAge;';
        } else {
            $sql = 'SELECT * FROM employee ORDER BY employeeAge DESC;';
        }
    } else if ($selectList1 == "sortSalary") {
        $sql = 'SELECT * FROM employee WHERE employeeSalary BETWEEN ' . $selectList3 . ' AND ' . $selectList4 . ';';
    } else if ($search1 == "searchEmployeeFirstName") {
        $sql = 'SELECT * FROM employee WHERE employeeFirstName LIKE "%' . $search2 . '%";';
    } else if ($search1 == "searchEmployeeLastName") {
        $sql = 'SELECT * FROM employee WHERE employeeLastName LIKE "%' . $search2 . '%";';
    }

    require '../connect.php';
    $res = mysql_query($sql, $con);
    if(!$res) {
        die('Could not get TABLE "employee": ' . mysql_error());
    }

    echo
        "<table>" .
        "<tr>" .
        "<th>Index</th>" .
        "<th>User ID</th>" .
        "<th>User Type</th>" .
        "<th>Name</th>" .
        "<th>Gender</th>" .
        "<th>Age</th>" .
        "<th>Salary</th>" .
        "</tr>";

    while($row = mysql_fetch_array($res, MYSQL_ASSOC)) {
        echo
            "<tr>" .
            "<td>{$row['employeeIndex']}</td>" .
            "<td>{$row['userID']}</td>" .
            "<td>{$row['userType']}</td>" .
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