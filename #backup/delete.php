<?php 
include('config/autoload.php');
if(!isset($_SESSION['id'])){
	header('Location: index.php');
}

if(!isset($_GET['id'])){
	// Si il n'y a pas de GET défini, on renvoie l'utilisateur sur home.php
	header('Location: home.php');
}
$tweet = getTweet($db, $_GET['id']);
if( $tweet['author_id'] == $_SESSION['id'] ){
	deleteTweet($db, $_GET['id']);
	header('Location: home.php');
}
else{
	header('Location: home.php');
}

?>