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
<title>Register form</title>
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
	<li><a href="index.php">Home</a></li>
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
<h2>Register</h2>
</div>

<p class="msg" align="center">
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST")
{
$username = $_POST['username'];
$password = $_POST['password'];
$name = $_POST['name'];
$email = $_POST['email'];
$website = $_POST['website'];

if(empty($username) or empty($password)or empty($name) or empty($email)or empty($website))
{
echo "<span style='color:red;'>Error ...This text field can't be empty</span>";
}else{
 
 $register = $user ->registerUser($username,$password,$name,$email,$website);
  
}

}



?>
</p>
<div class="login_reg">
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
<table>
<tr>
<td>Username</td>
<td><input type="text" name="username" placeholder="Please introduce a username"/> </td>
</tr>

<tr>
<td>Password</td>
<td><input type="password" name="password" placeholder="Please introduce a password"/> </td>
</tr>

<tr>
<td>Name</td>
<td><input type="text" name="name" placeholder="Please introduce your name"/> </td>
</tr>


<tr>
<td>Email</td>
<td><input type="text" name="email" placeholder="Please introduce a valid email adress"/> </td>
</tr>

<tr>
<td>Website</td>
<td><input type="text" name="website" placeholder="Please introduce your website if you have one"/> </td>
</tr>


<tr>
<td colspan="2">
<input type="submit" name="register" value="Register" onclick="alert('Your register was succesful, we have sent you a confirmation email, please verify your account.');"/>

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
