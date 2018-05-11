<!DOCTYPE html>
<?php
session_start();
unset($_SESSION['username']);
session_destroy();

header("Location: a_register.php");
exit;
?>
	
</html>

