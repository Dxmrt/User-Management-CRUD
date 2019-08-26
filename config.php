<?php
class DatabaseConnection{
	public function __construct()
	{
	global $pdo;
	
	 $servername = "localhost";
    $username = "root";
   $password = "";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=um", $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
  }
}



?>
