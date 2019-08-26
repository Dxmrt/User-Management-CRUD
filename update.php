<?php
session_start();
ob_start();

include('register_globals.php');
register_globals();
////end///////////
require_once "functions.php";
$user = new LogingRegistration();
$uid  = $_SESSION['uid']; 
$username  = $_SESSION['uname'];



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
<title>Update your profile</title>
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
<h2>Update your profile</h2>
<p class="msg" align="center">

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
$username = $_POST['username'];

$name = $_POST['name'];
$email = $_POST['email'];
$website = $_POST['website'];
if(empty($username) or empty($name) or empty($email)or empty($website))
{
echo "<span style='color:#e53d37;>Error ...This text field can't be empty.</span>";
}else{

$update = $user->updateUser($uid,$username,$name,$email,$website);
	if($update)
	{
	header("Location: index.php");;
	}


}
}
?>

</p>

<?php 
$result = $user->getUserdetails($uid);
foreach($result as $row)
{
?>
<div class="login_reg">
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" name="reg">
<table>
<tr>
<td>Username</td>
<td><input type="text" name="username" value="<?php echo $row['username'];?>" /></td>
</tr>

<tr>
<td>Name</td>
<td><input type="text" name="name" value="<?php echo $row['name'];?>"/></td>
</tr>


<tr>
<td>Email</td>
<td><input type="text" name="email" value="<?php echo $row['email'];?>"/> </td>
</tr>

<tr>
<td>Website</td>
<td><input type="text" name="website" value="<?php echo $row['website'];?>"/> </td>
</tr>


<tr>
<td colspan="2">
<br>
<input type="submit" name="update" value="Update your profile" onclick="alert('Your details were successfully updated');"/>

</td>
</tr>

</table>
</form>
</div>
<?php }?>

</div>






<div class="footer">

</div>


</div>
</body>
</html>

