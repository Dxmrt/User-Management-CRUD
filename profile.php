<?php
session_start();
ob_start();

include('register_globals.php');
register_globals();

require_once "functions.php";
$user = new LogingRegistration();
$uid  = $_SESSION['uid'];
$username  = $_SESSION['uname'];

if(isset($_REQUEST['id']))
{
$id = $_REQUEST['id'];
}else{
header('Location: index.php');
}

if(!$user->getSession())
	{
	header("Location: login.php");
	exit();
	}

?>
<!DOCTYPE html>
<html>
<head>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
<script language="JavaScript" type="text/javascript">
$(document).ready(function(){
		$("a.delete").click(function(e){
			if(!confirm('Are you sure?')){
				e.preventDefault();
				return false;
			}
			return true;
		});
});
</script>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>User profiles</title>
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
<span class="login_msg" align="center">
</span>
<h2>Welcome home, <span style="color:darkblue;"><?php echo $username; ?></h2></span>
<p class="userlist"> Profile of: <?php $user->getUsername($id); ?> </p>
<table class="tbl_one">
<?php 
$getUser = $user->getUserByid($id);
foreach($getUser as $user)
{
?>

<tr>
<td>Username</td>
<td><?php echo $user['username']; ?></td>
</tr>
<tr>
<td>Name</td>
<td><?php echo $user['name']; ?></td>
</tr>

<tr>
<td>Email</td>
<td><?php echo $user['email'];?></td>
</tr>

<tr>
<td>Website</td>
<td><?php echo $user['website'];?></td>
</tr>
<?php 
if($user['id']==$uid)
{
?>
<tr>

<td><a href="update.php?id=<?php echo $user['id'];?>" class="update">Edit</a></td>
<td><a href="delete.php?id=<?php echo $user['id'];?>" class="delete">Delete your profile</a>
</tr>
<?php }?>


<?php } ?>
</table>
</div>

<a href="index.php"> <img src="img/back-button.png" name="atras" alt="back" width="93" height="34" /> </a>
</div>


<div class="footer">

</div>


</div>
</body>
</html>

