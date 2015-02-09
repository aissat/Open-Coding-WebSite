<?php 
	session_start();
	$idUser = $_SESSION['idUser'];
?>

<!doctype html>
<link rel="stylesheet" type="text/css" href="./style/style_index.css"/>
<meta charset="UTF-8">
<html>
<header><title>World of Open coding</title></header>
<body>
<form method="GET" action="signOut.php">
<input type="submit" id="buttonLogout" value="LOG OUT" \>
</form>
<center>
<div style="width:900px;">
<div id="homeHeader">
<p>World</p><br>
</div>

<?php
	$userData        = new StdClass();
	$publicationData = new StdClass();
	$publications    = array();

	$commentData     = new StdClass();
	$comments        = array();

	
	// connect to database using PDO.
	$dsn = 'mysql:dbname=baseone;host=127.0.0.1';
	$user = 'root';
	$pwd = '';

	try {
		$DBH = new PDO($dsn, $user, $pwd);
	} catch (PDOException $e) {
		echo 'Connection failed: ' . $e->getMessage();
	}
	
	# creating the statement to bring user informations.
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

	# creating the statement to pring all the publications.
	$STH = $DBH->prepare('SELECT * FROM publications');
	$STH->setFetchMode(PDO::FETCH_OBJ);
	$STH->execute();
    
	# load data for user to display it.
	while($row = $STH->fetch()) 
	{
	    $publicationData->idPublications  = $row->idPublications;
	    $publicationData->title           = $row->title;
	    $publicationData->content         = $row->content;
	    $publicationData->dateInserted    = $row->dateInserted;
	    $publicationData->idUser          = $row->idUser;

echo '<div id="homeAddPost">
	<div id="title_pub"><center>'.$publicationData->title.'</center></div>
	<div id="content_pub">'.$publicationData->content .'</div>
	<div style="float:right; color:gray;">'.$publicationData->dateInserted.' By : '.$publicationData->idUser.'</div>
	</div>';

	    // dealing with comments.
		    $STH_2 = $DBH->prepare('SELECT * FROM comments WHERE idPublication="'.$row->idPublications.'"');
			$STH_2->setFetchMode(PDO::FETCH_OBJ);
			$STH_2->execute();

			while($row1 = $STH_2->fetch()) 
		    {
			    $commentData->idComment       = $row1->idComment;
			    $commentData->idUser          = $row1->idUser;
			    $commentData->comment         = $row1->comment;
			    $commentData->dateModified    = $row1->dateModified;
			    $commentData->idPublication   = $row1->idPublication;

			    echo '<div style="width:700px;">
					<div id="comment">'.$commentData->comment.'</div>
					<div style="float:right; color:whitesmoke; font-size:;">'.$commentData->dateModified.' By '.$idUser.'</div>
					</div>
					<br>';
		    }

		  echo '<form method="POST" action="addComment.php">
				<div>
				<input name="F_idPublication" type="hidden" value="'.$publicationData->idPublications.'" />
				<textarea style="width:500px; min-height:40px;" type="text" id="textarea" name="F_comment" placeholder="comment ..." maxlength="1024"></textarea></div>
				<div ><input style="width:60px;" type="submit" id="button" value="Add comment" \></div>
				</form><br>	';
	}

?>

</div>
</center>
</body>
</html>