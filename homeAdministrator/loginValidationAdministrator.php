<?php
if(!isset($_SESSION)) {
    session_start();
}
$validateUserType = 'administrator';
require '../connect.php';
$sql = "SELECT userType FROM user WHERE userName='" .
    $_SESSION['userNameLogin'] . "' AND passWord= '" . $_SESSION['passWordLogin'] . "'";
$res = mysql_query($sql);

if (!($row = mysql_fetch_assoc($res))) {
    session_destroy();
    echo'
	    <script type="text/javascript">
	        window.alert("You are not in the database");
	        window.parent.location.href="../login.php";
	    </script>
        ';
} else if ($row['userType'] !== $validateUserType) {
    session_destroy();
    echo'
	    <script type="text/javascript">
	        window.alert("You are in the database, but you have no authority");
	        window.parent.location.href="../login.php";
	    </script>
        ';
} else {
    if (time() - $_SESSION['loginTime'] > 300) {
        session_destroy();
        echo'
	    <script type="text/javascript">
	        window.alert("login time longer than 5 min");
	        window.parent.location.href="../login.php";
	    </script>
        ';
    }
}
$_SESSION['loginTime'] = time();
mysql_close($con);
?>
