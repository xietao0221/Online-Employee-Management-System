# Online Employee Management System

### Author: Tao Xie (USC ID: 5951684215)
### Date: 2015/06/23
### URL: http://taoxieusc.com/project/usc/webTech/hw2/login.php
### username and password:
    manager:        tao / tao
    administrator:  rose / rose
    sales manager:  kevin / kevin
I test my page on Chrome, and the page is perfectly displayed on 13-inch screen.


## 1. Overview
My company's website is about managing musical instruments and employees. There are 5 kinds of instruments we sell: woodwind, brass, string, keyboard and percussion, and there are 3 types of employee we have: manager, administrator and sales manager. There are one database called 'mycompany', and there are 4 tables: user, employee, product, and sales.

Table user: only contains userID, user type, username, and password. Table employee: contains detailed personal information, for example, first name, last name, age, salary and so on. These two tables are linked by userID, and administrator will manage and update them simultaneously.

Table product: contains detailed product information, for example, product name, original price, sales type, image, description and so on. Table sales: only contains special product and only contains some sales information, for example, discount, sales start date, sales end date, and so on. These two tables are linked by productID, and sales manager will manage and update them simultaneously.

Through the login page, you can type in the username and password, and according to the user type, people can log in their own page and do their own job. On their homepage, the left side are menu bars, showing what you can do, and the center part is the operating area.

This system use SESSION to assign people their own authority. For example, even though a manager know the URL of homepage of administrator, he do not have right to do anything on it, because every page has a validation from database. And between two active operation, there is only 5 minutes, in other words, if you do nothing in 5 minutes, you have to login again. If you want to logout, you can hit the right-top button 'Logout', and the system will return to login page.


## 2. Instruction about main documents
### 2.1 login.php
This is the first page, you need to type in the username and password, and all inputs will be validated by php and javascript. Passwords are stored after MD5 encryption, even though administrator will no nothing about the password.

### 2.2 manager folder
Manager can only read the report, and do some searching and sorting function. He can read employee, product and sales report, and input keyword to search items. Manager can also sort employee by index, pay range, age, gender and so on, and he can sort product and sales by index, price, sales price, discount, date, and so on.

### 2.3 administrator folder
Administrator can add, delete, and modify employees.
Add employee: after he input all personal information, a person can be added into database, and user and employee table will be updated. You cannot add an existed person, nor an existed username, nor an existed userID, all of them are validated by javascript.
Delete employee: use checkbox button to choose one or more employee to delete.
Modify employee: use radio button to choose the person you want to modify, and them input the updated personal information.
Notice, you cannot delete nor modify yourself, so that their should be at least one administrator in the database to manage employee.
All data you put in are validated by PHP and Javascript, in order to keep database concise and clean.

### 2.4 Sales manager folder
Sales manager can add, delete, and modify product and sales.
Add product, this function is similar to "add employee". If the product you add is a special sales, you need to add more information about sales, and update Table sales and product simultaneously. You cannot add an existed product, nor an existed productID, both of them are validated by javascript.
Delete product, this function is similar to "delete employee".
Modify product, you can update product's information, or make a original price product to be a sales, or make a sales to be an original price product.
Notice, all data are validated by PHP and Javascript.

### 2.5 js folder
Contains all javascript functions.

### 2.6 css folder
Contains all css files and one icon library.(I just use some icon to make my page beautiful, I do not use any plug-in nor framework)

### 2.7 picture folder
Contains all images.

## 3. Special features
I do not use any plug-in nor framework, all css, php, javascript are composed by myself.
Everyone has their own authority, and they do not have right to do other people's work even though they know URL.
All data input are validated by PHP and Javascript and some error message pop up when you do something wrong. And window alert are use scarcely to improve user experience.
Inactive timeout is 5 minutes. You can change this parameter on loginValidationAdministrator.php/loginValidationManager.php/loginValidationSalesManager.php if you want to test it using shorter timeout.
Images are not stored in database, but in other folder, and their URL are stored in the database. If sales manager delete or modify a product, its image are changed or deleted then, so that your hard disk will be always concise.
I compose a 'resetSql.php' to reset my database, that is easy to set all data. If you want to reset my database, just refresh that page. All database information can be checked in this file.
