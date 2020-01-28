<?php
session_start();
$_SESSION['pseudo']=$_POST['pseudo'];
$_SESSION['msg']=$_POST['msg'];
$pseudo =$_SESSION['pseudo'];
$msg =$_SESSION['msg'];


try
{
	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch (Exception $e)
{
	die('Erreur : ' . $e->getMessage());
}

$envoie = $bdd->prepare('INSERT INTO chat(pseudo,msg) VALUES(:pseudo, :msg)');
$envoie->execute(array('pseudo' => $pseudo, 'msg' => $msg));

header('Location: chat.php');

?>