<?php
if ( !empty($_POST['F_fullname']) && !empty($_POST['F_pseudo']) && !empty($_POST['F_email']) && !empty($_POST['F_password']) && !empty($_POST['F_address']) && !empty($_POST['F_gender']) )
{		
		$username = $_POST['F_fullname'];
		$pseudo   = $_POST['F_pseudo'];
		$email    = $_POST['F_email'];
		$password = $_POST['F_password'];
		$address  = $_POST['F_address'];
		$gender   = $_POST['F_gender'];
		$birthday = null;

	if( !empty($_POST['day']) && !empty($_POST['year']) && !empty($_POST['month']) )
		$birthday = $_POST['year']."-".$_POST['month']."-".$_POST['day'];

	else
		//redirect error birthday.
		header("Location: index.php");

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
	$query = "INSERT INTO users (idUser,fullname,pseudo,birthday,address,email,password,gender) VALUES (null,'".$username."','".$pseudo."','".$birthday."','".$address."','".$email."','".$password."','".$gender."')";
		$STH = $DBH->prepare($query);
	    $STH->execute(); 
	    session_start();
	    $idUser = $DBH->lastInsertId();
		$_SESSION['idUser'] = $idUser;
		$_SESSION['notification'] ='';
		header("Location: home.php");
}
else 
{
	// redirect to index.
	header("Location: index.php");
}


?>