<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <script type="text/javascript" src="js/login.js"></script>
    <title>Login | Musical Instruments</title>
</head>
<body>

<?php
$userNameLogin = $_POST['userNameLogin'];
$passWordLogin = md5($_POST['passWordLogin']);
$errorMessage = "";
$userTypeLogin = "";

//Go to DB to validate when both exist
if (strlen($userNameLogin) > 0 && strlen($passWordLogin) > 0) {
    require 'connect.php';
    //echo $userName . $passWord;
    $sql = "SELECT userType FROM user WHERE userName='".$userNameLogin."' AND passWord='".$passWordLogin."'";
    $res = mysql_query($sql);
    if (!($row = mysql_fetch_assoc($res))) {
        $errorMessage = "Invalid Login";		//Don't tell users why they are wrong.
    } else {
        $userTypeLogin = $row['userType'];

        $_SESSION['userNameLogin'] = $userNameLogin;
        $_SESSION['passWordLogin'] = $passWordLogin;
        $_SESSION['userTypeLogin'] = $userTypeLogin;
        $_SESSION['loginTime'] = time();

        echo '<meta http-equiv=refresh content=0; url="/homeManager/homeManager.php">';

        switch($userTypeLogin) {
            case 'manager':
                $url = "homeManager/homeManager.php";
                break;
            case 'administrator':
                $url = "homeAdministrator/homeAdministrator.php";
                break;
            case 'salesManager':
                $url = "homeSalesManager/homeSalesManager.php";
                break;
            default:
                $url = "homeManager/homeManager.php";
        }

        echo "<script type='text/javascript'>";
        echo "window.location.href='$url'";
        echo "</script>";
    }
}
?>

<div class="transparent_box">
    <div class="login_logo">
        <p>Welcome</p>
    </div>

    <form onsubmit="return validateForm()" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" autocomplete="off">
        <div class="login_input">
            <p><input type="text" id="userNameLogin" name="userNameLogin" class="login_box" placeholder="User Name" required/><p>
            <p><input type="password" id="passWordLogin" name="passWordLogin" class="login_box" placeholder="Password" required/><p>
        </div>
        <input type="submit" id="loginSubmit" name="loginSubmit" class="login_submit" value="Log in">
    </form>

    <div class="login_error_message">
        <p><?php echo $errorMessage; ?></p>
    </div>
</div>
</body>
</html>