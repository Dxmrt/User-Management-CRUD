<?php 
session_start();
ob_start();
require_once "functions.php";
$user = new LogingRegistration();

	if($user->getSession())
	{
	header("Location: index.php");
	exit();
	}

?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Sign in</title>
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
	<li><a href="profile.php">Show profiles</a></li>
	<li><a href="ChangePassword.php">Change your password</a></li>
	<li><a href="logout.php">Sign out</a></li>
	
	<?php }else{?>
	
	<li><a href="login.php">Sign in</a></li>
	<li><a href="register.php">Register</a></li>
	<?php }?>
</ul>
</div>

<div class="content">
<h2>Login</h2>
</div>

<p class="msg" align="center">
<span class="login_msg" hidden="true">
<?php 
if(isset($_GET['response']))
{
	 if($_GET['response']==1)
	 {
	 echo "<span style='color:red'>You've succesfully logged out.....</span>";
	 }
}
?>
</span>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
$email = $_POST['email'];
$password = $_POST['password'];


if(empty($password)or empty($email))
{
echo "<span style='color:red'>Error: This text field can't be empty</span>";
}else{ 

$login = $user->loginUser($email, $password);

if($login)
{
header('Location: index.php');
}else
{
echo"<span style='color:red'>Error: The email adress or the password doesn't match.</span>";
}
  
  
}

}



?>
</p>
<div class="login_reg">
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<table>
<tr>
<td>Email</td>
<td><input type="text" name="email" placeholder="Please introduce a valid email adress"/> </td>
</tr>

<tr>
<td>Password</td>
<td><input type="password" name="password" placeholder="Please introduce a password"/> </td>
</tr>


<tr>

<td colspan="2">
<input type="submit" name="login" value="Login"/>
<input type="reset" name="reset" value="Reset"/>
</td>
</tr>

</table>
</form>
</div>

<br>
<br>

<div class="footer">




</div>
</body>
</html>
