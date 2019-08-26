<?php
session_start();
ob_start();

include('register_globals.php');
register_globals();



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
<title>Show profiles</title>
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
<h2>Welcome home, <span style="color:darkblue;"><?php echo $username; ?></h2></span>
</div>
<span class="login_msg">
<?php 
if(isset($_SESSION['loin_msg']))
{
echo $_SESSION['loin_msg'];
unset($_SESSION['loin_msg']);
}
 ?>
</span>


<div>

<p class="userlist"> Users List </p>

<table class="tbl_one">
<tr>
<th>Serial</th>
<th>Name</th>
<th>Profile</th>
</tr>
<?php
$i=0;
$alluser = $user->getAllusers();
foreach($alluser as $user )
{
$i++;

?>
<tr>
<td> <?php echo $i;?> </td>
<td><?php echo $user['name'];?></td>
<td><a href="profile.php?id=<?php echo $user['id'];?>">See details...</a></td>
</tr>
<?php } ?> 
</table>
</div>



<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>


<div class="footer">

</div>


</div>
</body>
</html>
