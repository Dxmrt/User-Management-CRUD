<?php
require "config.php";



class LogingRegistration
{

 function __construct()
 {
  $database = new DatabaseConnection();
  }
  
public function registerUser($username,$password,$name,$email,$website)
{
   global $pdo;
   $query = $pdo->prepare("SELECT id FROM users WHERE username = ? AND email = ? ");
   $query->execute(array($username,$email));
   $num = $query->rowCount();
   
   if($num ==0)
   {
   $query = $pdo->prepare("INSERT INTO users (username,password,name,email,website) VALUES (?,?,?,?,?)");
   $query->execute(array($username,$password,$name,$email,$website));
   header("Location: login.php");
   return true;
   }else
   {
   return print"<span style='color:red'>'Error...This user or email already exists in our DB</span>";
   }
    
}


public function loginUser($email, $password)
{
   global $pdo;
   echo $password;
   $query = $pdo->prepare("SELECT id,username FROM users WHERE email = ? AND password = ? ");
   $query->execute(array($email,$password));
   $userdata =$query->fetch();
   $num = $query->rowCount();
	
   if($num ==1)
   {
   session_start();
   $_SESSION['login'] = true;
   $_SESSION['uid'] = $userdata['id'];
   $_SESSION['uname'] = $userdata['username'];
   $_SESSION['loin_msg'] = "<span style='color:green'>You are logged in...</span>";

   return true;
   
   }else{
   return false;
   } 

}

public function getAllusers()
{
global $pdo;
$query = $pdo->prepare("SELECT * FROM users ORDER BY id DESC");
$query->execute();
return $query->fetchAll(PDO::FETCH_ASSOC);
}



public function getSession()
{
   return @$_SESSION['login'];   
}

public function getUsername($uid){
global $pdo;
$query = $pdo->prepare("SELECT name FROM users WHERE id = ? ");
$query->execute(array($uid));
$result = $query->fetch();
echo $result['name'];
}
public function getUserByid($id)
{
global $pdo;
$query = $pdo->prepare("SELECT * FROM users WHERE id = ? ");
$query->execute(array($id));
return $query->fetchAll(PDO::FETCH_ASSOC);
}   
   
   
public function updateUser($id,$username,$name,$email,$website)
{
	global $pdo;
	$query = $pdo->prepare("UPDATE users SET username = ? , name = ? ,   email = ? , website = ? WHERE id = ?");
	$query->execute(array($username,$name,$email,$website,$id));
	return true;
} 

public function getUserdetails($id){
global $pdo;
$query = $pdo->prepare("SELECT * FROM users WHERE id = ? ");
$query->execute(array($id));
return $query->fetchAll(PDO::FETCH_ASSOC);
}

public function updatePassword($uid,$new_pass,$old_pass){
 global $pdo;
 $query = $pdo->prepare("SELECT id FROM users WHERE password =".$old_pass);
 $query->execute(array($old_pass));
 header("Location: index.php");
 
 
 $num = $query->rowCount();
 if($num == 0)
 {
  return print("<span style='color:red'>Error ...The old password doesn't exists.</span>");
 }else{
  $query= $pdo->prepare("UPDATE users SET password = ? WHERE id = ? ");
  $query->execute(array($new_pass,$uid));
 } 
 
}

public function deleteUser($table,$id)
 {
global $pdo;
 $query = $pdo->prepare("DELETE FROM $table WHERE id=".$id);
 $query->execute(array($id));
  session_destroy();
 }

public function logOutUser(){
   $_SESSION['login'] = false;
   unset($_SESSION['uid']);
   unset($_SESSION['uname']);
   unset($_SESSION['loin_msg']);
   session_destroy();
}






  
}


?>