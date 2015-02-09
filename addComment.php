<?php
session_start();
$idUser = $_SESSION['idUser'];
if(!empty($_POST['F_idPublication']) && !empty($_POST['F_comment']) )
{
	$comment = $_POST['F_comment'];
	$idPublication = $_POST['F_idPublication'];


	// connect to database using PDO.
	$dsn = 'mysql:dbname=baseone;host=127.0.0.1';
	$user = 'root';
	$pwd = '';

	try {
		$DBH = new PDO($dsn, $user, $pwd);
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
	}

	// insert data into table users.
	$query = 'INSERT INTO comments (idUser,comment,idPublication) VALUES ("'.$idUser.'","'.$comment.'","'.$idPublication.'")';
	$STH =null;
	$STH = $DBH->prepare($query);
	$STH->execute(); 
	$DBH = null;
}
else
{
	$_SESSION['notification'] = '<p style="color:red;">Fill the Form PLEASE.</p>';
} 

header("Location: world.php");
?>