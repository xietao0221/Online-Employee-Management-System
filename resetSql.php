<?php
require 'connect.php';

// Drop TABLE "user"
$sql = "DROP TABLE user";
$res = mysql_query($sql, $con);
if(!$res) {
    die('Could not delete TABLE "user": ' . mysql_error());
}

// Drop TABLE "employee"
$sql = "DROP TABLE employee";
$res = mysql_query($sql, $con);
if(!$res) {
    die('Could not delete TABLE "employee": ' . mysql_error());
}

// Drop TABLE "product"
$sql = "DROP TABLE product";
$res = mysql_query($sql, $con);
if(!$res) {
    die('Could not delete TABLE "product": ' . mysql_error());
}

// Drop TABLE "sales"
$sql = "DROP TABLE sales";
$res = mysql_query($sql, $con);
if(!$res) {
    die('Could not delete TABLE "sales": ' . mysql_error());
}
echo 'All previous TABLES are deleted successfully<br>';

// Create TABLE "user"
$sql = "CREATE TABLE user(" .
    "userIndex INT NOT NULL AUTO_INCREMENT, " .
    "userID VARCHAR(5) NOT NULL," .
    "userType VARCHAR(20) NOT NULL, " .
    "userName VARCHAR(10) NOT NULL, " .
    "passWord VARCHAR(100) NOT NULL," .
    "PRIMARY KEY (userIndex));";
$res = mysql_query($sql, $con);
if(!$res) {
    die('Could not create TABLE "user": ' . mysql_error());
}

// Create TABLE "employee"
$sql = "CREATE TABLE employee(" .
    "employeeIndex INT NOT NULL AUTO_INCREMENT, " .
    "userID VARCHAR(5) NOT NULL," .
    "userType VARCHAR(20) NOT NULL, " .
    "employeeFirstName VARCHAR(10) NOT NULL, " .
    "employeeLastName VARCHAR(10) NOT NULL, " .
    "employeeGender VARCHAR(10) NOT NULL, " .
    "employeeAge INT NOT NULL, " .
    "employeeSalary INT NOT NULL, " .
    "PRIMARY KEY (employeeIndex));";
$res = mysql_query($sql, $con);
if(!$res) {
    die('Could not create TABLE "employee": ' . mysql_error());
}

// Create TABLE "product"
$sql = "CREATE TABLE product(" .
    "productIndex INT NOT NULL AUTO_INCREMENT, " .
    "productID VARCHAR(10) NOT NULL," .
    "productName VARCHAR(20) NOT NULL, " .
    "productOriginalPrice INT NOT NULL, " .
    "salesType BOOLEAN NOT NULL, " .
    "productCategory VARCHAR(20) NOT NULL, " .
    "productQuantity INT NOT NULL, " .
    "productDescription VARCHAR(500) NOT NULL, " .
    "productImage VARCHAR(500) NOT NULL, " .
    "PRIMARY KEY (productIndex));";
$res = mysql_query($sql, $con);
if(!$res) {
    die('Could not create TABLE "product": ' . mysql_error());
}

// Create TABLE "sales"
$sql = "CREATE TABLE sales(" .
    "salesIndex INT NOT NULL AUTO_INCREMENT, " .
    "productID VARCHAR(10) NOT NULL," .
    "productName VARCHAR(20) NOT NULL, " .
    "productOriginalPrice INT NOT NULL, " .
    "salesDiscount FLOAT NOT NULL, " .
    "salesPrice FLOAT NOT NULL," .
    "salesStartDate DATE NOT NULL," .
    "salesEndDate DATE NOT NULL," .
    "PRIMARY KEY (salesIndex));";
$res = mysql_query($sql, $con);
if(!$res) {
    die('Could not create TABLE "sales": ' . mysql_error());
}
echo 'All new TABLES are created successfully<br>';

// Enter data into TABLE "user"
$sql = "INSERT INTO user".
    "(userID, userType, userName, passWord) ".
    "VALUES ".
    "('M001', 'manager', 'tao', MD5('tao'))," .
    "('M002', 'manager', 'john', MD5('john'))," .
    "('A001', 'administrator', 'rose', MD5('rose'))," .
    "('A002', 'administrator', 'papa', MD5('papa'))," .
    "('A003', 'administrator', 'mike', MD5('mike'))," .
    "('A004', 'administrator', 'jack', MD5('jack'))," .
    "('S001', 'salesManager', 'lee', MD5('lee'))," .
    "('S002', 'salesManager', 'joe', MD5('joe'))," .
    "('S003', 'salesManager', 'alice', MD5('alice'))," .
    "('S004', 'salesManager', 'michael', MD5('michael'))," .
    "('S005', 'salesManager', 'peter', MD5('peter'))," .
    "('S006', 'salesManager', 'christ', MD5('christ'))," .
    "('S007', 'salesManager', 'carter', MD5('carter'))," .
    "('S008', 'salesManager', 'bruce', MD5('bruce'))," .
    "('S009', 'salesManager', 'kevin', MD5('kevin'));";
$res = mysql_query($sql, $con);
if(!$res) {
    die('Could not enter data into TABLE "user": ' . mysql_error());
}


// Enter data into TABLE "employee"
$sql = "INSERT INTO employee".
    "(userID, userType, employeeFirstName, employeeLastName, employeeGender, employeeAge, employeeSalary) ".
    "VALUES ".
    "('M001', 'manager', 'Tao', 'Xie', 'Male', '26', '100000')," .
    "('M002', 'manager', 'John', 'Smith', 'Male', '30', '90000')," .
    "('A001', 'administrator', 'Rose', 'Swift', 'Female', '25', '85000')," .
    "('A002', 'administrator', 'Papa', 'Jones', 'Male', '24', '83000')," .
    "('A003', 'administrator', 'Mike', 'Adams', 'Male', '25', '87000')," .
    "('A004', 'administrator', 'Jack', 'Wills', 'Male', '23', '81000')," .
    "('S001', 'salesManager', 'Lee', 'Green', 'Female', '23', '68000')," .
    "('S002', 'salesManager', 'Joe', 'Blake', 'Male', '22', '69000')," .
    "('S003', 'salesManager', 'Alice', 'White', 'Female', '21', '65000')," .
    "('S004', 'salesManager', 'Michael', 'Nelson', 'Male', '24', '60000')," .
    "('S005', 'salesManager', 'Peter', 'Parker', 'Male', '22', '59000')," .
    "('S006', 'salesManager', 'Christ', 'Evans', 'Female', '23', '70000')," .
    "('S007', 'salesManager', 'Carter', 'Collins', 'Male', '20', '55000')," .
    "('S008', 'salesManager', 'Bruce', 'Morris', 'Male', '23', '58000')," .
    "('S009', 'salesManager', 'Kevin', 'Bell', 'Female', '25', '55000');";
$res = mysql_query($sql, $con);
if(!$res) {
    die('Could not enter data into TABLE "employee": ' . mysql_error());
}

// Enter data into TABLE "product"
$sql = "INSERT INTO product".
    "(productID, productName, productOriginalPrice, salesType, productCategory, productQuantity, productDescription, productImage) ".
    "VALUES ".
    "('W001', 'Flute', '5000', 0, 'Woodwind', '24', 'This is Flute', 'picture/sql_flute.jpg')," .
    "('W002', 'Piccolo', '7000', 1, 'Woodwind', '5', 'This is Piccolo', 'picture/sql_piccolo.jpg')," .
    "('W003', 'Oboe', '10000', 1, 'Woodwind', '2', 'This is Clarinet', 'picture/sql_oboe.jpg')," .
    "('W004', 'Bassoon', '10000', 0, 'Woodwind', '1', 'This is Bassoon', 'picture/sql_bassoon.jpg')," .
    "('W005', 'Sax', '5000', 0, 'Woodwind', '30', 'This is Sax', 'picture/sql_sax.jpg')," .
    "('W006', 'Clarinet', '5000', 0, 'Woodwind', '26', 'This is Clarinet', 'picture/sql_clarinet.jpg')," .
    "('B001', 'Horn', '8000', 1, 'Brass', '8', 'This is Brass', 'picture/sql_horn.jpg')," .
    "('B002', 'Trumpet', '4000', 0, 'Brass', '20', 'This is Trumpet', 'picture/sql_trumpet.jpg')," .
    "('B003', 'Trombone', '4000', 1, 'Brass', '23', 'This is Trombone', 'picture/sql_trombone.jpg')," .
    "('B004', 'Tuba', '6000', 0, 'Brass', '5', 'This is Tuba', 'picture/sql_tuba.jpg')," .
    "('P001', 'Snare Drum', '2000', 1, 'Percussion', '19', 'This is Snare Drum', 'picture/sql_snaredrum.jpg')," .
    "('P002', 'Cymbals', '2500', 0, 'Percussion', '15', 'This is Cymbals', 'picture/sql_cymbals.jpg')," .
    "('P003', 'Bass Drum', '4000', 0, 'Percussion', '4', 'This is Bass Drum', 'picture/sql_bassdrum.jpg')," .
    "('K001', 'Piano', '10000', 1, 'Keyboard', '8', 'This is Piano', 'picture/sql_piano.jpg')," .
    "('S001', 'Harp', '20000', 0, 'String', '1', 'This is Harp', 'picture/sql_harp.jpg')," .
    "('S002', 'Violin', '4000', 0, 'String', '30', 'This is Violin', 'picture/sql_violin.jpg')," .
    "('S003', 'Cello', '5000', 1, 'String', '30', 'This is Cello', 'picture/sql_cello.jpg');";
$res = mysql_query($sql, $con);
if(!$res) {
    die('Could not enter data into TABLE "product": ' . mysql_error());
}

// Enter data into TABLE "sales"
$sql = "INSERT INTO sales".
    "(productID, productName, productOriginalPrice, salesDiscount, salesPrice, salesStartDate, salesEndDate) ".
    "VALUES ".
    "('W002', 'Piccolo', '7000', 0.9, 6300, '2015-06-17', '2017-06-20')," .
    "('W003', 'Oboe', '10000', 0.95, 9500, '2015-06-18', '2017-06-21')," .
    "('B001', 'Horn', '8000', 0.8, 6400, '2015-06-16', '2017-06-23')," .
    "('B003', 'Trombone', '4000', 0.85, 3400, '2015-06-15', '2017-06-22')," .
    "('P001', 'Snare Drum', '2000', 0.95, 1900, '2015-06-16', '2017-06-20')," .
    "('K001', 'Piano', '10000', 0.6, 6000, '2015-06-17', '2017-06-24')," .
    "('S003', 'Cello', '5000', 0.8, 4000, '2015-06-18', '2017-06-25');";
$res = mysql_query($sql, $con);
if(!$res) {
    die('Could not enter data into TABLE "product": ' . mysql_error());
}
echo 'All data are entered successfully<br>';

mysql_close($con);
?>