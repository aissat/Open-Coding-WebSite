<form method="GET" action="signOut.php">
<input type="submit" id="buttonLogout" value="LOG OUT" \>
</form>
<?php 
	session_start();
	$idUser = $_SESSION['idUser'];
	$userData = new StdClass();
	// connect to database using PDO.
	$dsn = 'mysql:dbname=baseone;host=127.0.0.1';
	$user = 'root';
	$pwd = '';

	try {
		$DBH = new PDO($dsn, $user, $pwd);
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
	}
	
	# creating the statement
	$STH = $DBH->prepare('SELECT * FROM users WHERE idUser='.$idUser);
	$STH->setFetchMode(PDO::FETCH_OBJ);
	$STH->execute();
    
	# load data for user to display it.
	while($row = $STH->fetch()) 
	{
	    $userData->fullname = $row->fullname;
	    $userData->pseudo   = $row->pseudo;
	    $userData->birthday = $row->birthday;
	    $userData->email    = $row->email;
	    $userData->password = $row->password;
	}
?>
<!doctype html>
<link rel="stylesheet" type="text/css" href="./style/style_index.css"/>
<meta charset="UTF-8">
<html>
<header><title>Open Club</title></header>
<body>
<center>
<div style="width:900px;">

<div id="homeHeader">
<p>Home</p><br>
<?php echo 'Have a nice day : '.$userData->pseudo;  ?>
</div>

<div id="homeAddPost">
<form method="POST" action="addPublication.php">
	<center><h1>Share your opinion with the world</h1><br><h3><?php echo $_SESSION['notification']; ?></h3></center>
	<div ><input style="width:60px;" type="text" id="textfield" name="F_title" placeholder="Title" maxlength="75"\></div>
	<div ><textarea style="width:600px; min-height:80px;" type="text" id="textarea" name="F_publication" placeholder="What's in your mind ?" maxlength="2050"></textarea></div>
	<div ><input style="width:60px;" type="submit" id="button" value="POST" \></div>
</form>	
</div>
<br>
<br>
<br>
<div id="">
	<form method="POST" action="world.php">
		<input type="hidden" name="FH_iduser" value="POST" \>
		<div ><input style="width:120px; height:40px;" type="submit" id="button" value="Publications" \></div>
	</form>
</div>
<br>
<br>
<div id="">
	<form method="POST" action="">
		<input type="hidden" name="FH_iduser" value="POST" \>
		<div ><input style="width:90px;  height:40px;" type="submit" id="button" value="Edit Profile" \></div>
	</form>
</div>

</div>
</center>
</body>
</html>