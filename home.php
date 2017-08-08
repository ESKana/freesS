<?php
include('config/autoload.php');
if(!isset($_SESSION['id'])){
	header('Location: index.php');
}
if(isset($_POST['tweet'])){
	if(strlen($_POST['tweet']) <= 120){
		addTweet($db, $_POST['tweet'], $_SESSION['id']);
		header('Location: home.php');
	}
	else{
		$error = "Le tweet est trop long";
	}
}

?>
<h1>Twitter</h1>

<h2>Creer un nouveau tweet</h2>
<form action="home.php" method="post">
	<input type="text" name="tweet" placeholder="Votre tweet">
	<input type="submit">
</form>

<h2>Tous les tweets</h2>
<ul>
<?php 
	foreach(showAllTweets($db) AS $tweet){
		echo '<li>'.$tweet['tweet'];
		echo ' - <a href="profil.php?id=';
		echo $tweet['id'];
		echo '">';
		echo $tweet['username'];
		echo ' </a> -';
 
		echo date('d-m-Y \à\ H:i:s', strtotime($tweet['created_at']));
		if($tweet['author_id'] == $_SESSION['id']){
			// Affichage de modifier et supprimer
			echo ' | <a href="edit.php?id='.$tweet['id'].'">Modifier</a> | ';
			echo '<a href="delete.php?id='.$tweet['id'].'">Supprimer</a>';
		}
		echo '</li>';
	}
?>
</ul>

<h2>Gestion du profil</h2>
<ul>
	<li><a href="profil.php">Voir mon profil</a></li>
	<li><a href="logout.php">Se deconnecter</a></li>
</ul>