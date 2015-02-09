<?php
if ( !empty($_POST['F_email']) && !empty($_POST['F_password']) )
{
	$email    = $_POST['F_email'];
	$password = $_POST['F_password'];

	// connect to database 
	$dsn = 'mysql:dbname=baseone;host=127.0.0.1';
	$user = 'root';
	$pws = '';

	try {
		$DBH = new PDO($dsn, $user, $pws);
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
	}

	// SELECT from table users.
	$STH = $DBH->query('SELECT (idUser) FROM users WHERE email ="'.$email.'" AND password="'.$password.'" ');
	# setting the fetch mode
	$STH->setFetchMode(PDO::FETCH_OBJ);

	if($STH->rowCount() > 0)
	{
		while($row = $STH->fetch()) 
		{	
			session_start();
		    $_SESSION['idUser'] = $row->idUser;
		    $_SESSION['notification'] ='';
		    // redirect to HOME 
		    header("Location: home.php");
		}
	}
	else
	{
		header("Location: index.php");
	}

}
else 
{
	// redirect to index.
	header("Location: index.php");

}

?>