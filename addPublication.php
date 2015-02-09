<?php
session_start();
$idUser = $_SESSION['idUser'];
if( !empty($_POST['F_title']) && !empty($_POST['F_publication']) )
{
	$title   = $_POST['F_title'];
	$content = $_POST['F_publication'];

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
	$query = 'INSERT INTO publications (title,content,idUser) VALUES ("'.$title.'","'.$content.'","'.$idUser.'")';
	$STH =null;
	$STH = $DBH->prepare($query);
	$STH->execute(); 
	$DBH = null;
	
	$_SESSION['notification'] = "<p style='color:green;'>Publication Inserted.</p>";
}
else
{
	$_SESSION['notification'] = '<p style="color:red;">Fill the Form PLEASE.</p>';
} 

header("Location: home.php");
?>