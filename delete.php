<?php
session_start();
ob_start();

include('register_globals.php');
register_globals();

require_once "functions.php";
$user = new LogingRegistration();
$uid  = $_SESSION['uid'];

 
if(!$user->getSession())
	{
	header("Location: login.php");
	exit();
	
	}
	


?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Unsuscribe</title>
<link  rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<div class="wrapper">
<div class="header">
<h3>User management</h3>
</div>
<?php
$delete = $user ->deleteUser("users",$uid);
session_destroy();
header("Location: register.php");
?>
<br>
<br>



<div class="footer">

</div>


</div>
</body>
</html>
