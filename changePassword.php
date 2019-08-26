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
<title>Change your password</title>
<link  rel="stylesheet" type="text/css" href="style.css"/>
</head>

<body>
<div class="wrapper">
<div class="header">
<h3>User management</h3>
</div>

<div class="mainmenu">
<ul>
<?php if($user->getSession())
	{?>
	<li><a href="index.php"> Home</a></li>
	<li><a href="profile.php"> Show profiles</a></li>
	<li><a href="ChangePassword.php">Change your password</a></li>
	<li><a href="logout.php">Sign out</a></li>
	
	<?php }else{?>
	
	<li><a href="login.php">Sign in</a></li>
	<li><a href="register.php">Register</a></li>
	<?php }?>
</ul>
</div>

<div class="content">
<h2> Change your password</h2>
<p class="msg" align="center">

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
$old_pass      = $_POST['old_password'];
$new_pass      = $_POST['new_password'];
$confirm_pass  = $_POST['confirm_password'];

if(empty($old_pass) or empty($new_pass) or empty($confirm_pass))
	{
	echo "<span style='color:#e53d37;'> Error ...This text field can't be empty</span>";
	}else if($new_pass != $confirm_pass){
	echo "<span style='color:#e53d37;'> Error ...The password doesn't match</span>";
	}else{
	$old_pass = ($old_pass);
	$new_pass = ($new_pass);
	$update = $user->updatePassword($uid,$new_pass,$old_pass);
	}
}
?>

</p>

<div class="login_reg">
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" name="reg">
<table>
<tr>
<td>Old password</td>
<td><input type="password" name="old_password"  placeholder="Please introduce your old password"/></td>
</tr>

<tr>
<td>New password</td>
<td><input type="password" name="new_password" placeholder="Please introduce your new password"/></td>
</tr>


<tr>
<td>Confirm:</td>
<td><input type="password" name="confirm_password"  palceholder="Please type your new password again" /></td>
</tr>

<tr>
<td colspan="2">
<br>
<input type="submit" name="actualizar" value="Update your password" onclick="alert('Your password was successfully changed');"/>
</td>
</tr>

</table>
</form>
</div>


<br>
<br>


<div class="footer">

</div>


</div>
</body>
</html>

