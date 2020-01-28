<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="form.css">
	<meta charset="UTF-8">
	<title>Form</title>
</head>
<body>
	<?php
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}
	?>
	<div id="envoie_msg">
	<form action="chat_post.php" method="post">
		<label for="pseudo">Pseudo : </label>
		<input type="text" name="pseudo" maxlength="16" value="<?php 
		if (isset($_SESSION['pseudo']))
		{
			echo $_SESSION['pseudo'];
		}

		?>"><br><br>

		<label for="msg">Message : </label>
		<input type="text" name="msg" placeholder="Message..">
		<!--<textarea rows="12" cols="40" placeholder="Message.." name="msg"></textarea><br>*/-->
		<div id="bouton">

		<input type="submit" name="button" value="Envoyer">
		
		</div>

	</form>
	</div>

	<div id="messages">
	<?php 

	$liste_msg = $bdd->query('SELECT * FROM chat ORDER BY id DESC LIMIT 0,10');

	while ($liste_organisee = $liste_msg->fetch())
	{
	?>
	<p><strong><?php echo htmlspecialchars($liste_organisee['pseudo'])?></strong>  :   <?php echo htmlspecialchars($liste_organisee['msg'])?><br></p>
	<?php
	}

	$liste_msg->closeCursor();

	?>
</div>

</body>
</html>