<?php
session_destroy();
echo'
	    <script type="text/javascript">
	        window.parent.location.href="login.php";
	    </script>
        ';
?>