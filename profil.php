<?php
include('config/autoload.php');
if(!isset($_SESSION['id'])){
	header('Location: index.php');
}

if(empty($_GET['id']) OR $_SESSION['id'] == $_GET['id']){
	$id = $_SESSION['id'];
	$username = $_SESSION['username'];
	$created_at = $_SESSION['created_at'];
	$last_login = $_SESSION['last_login'];
}
else{
	$user = getUser($db, $_GET['id']);
	$id = $user['id'];
	$username = $user['username'];
	$created_at = $user['created_at'];
	$last_login = $user['last_login'];
}
// Fonction nombre de tweets
$nbTweets = countTweets($db, $id);
?>
<h1>Profil de : <?php echo $username; ?></h1>
<a href="home.php">Accueil</a>
<p>Nom d'utilisateur :  <?php echo $username; ?></p>
<p>Nombre de tweets : <?php echo $nbTweets; ?></p>
<p>Creation du profil :  <?php echo date('d-m-Y H:i:s', strtotime($created_at)); ?></p>
<p>Derniere connexion :  <?php echo date('d-m-Y H:i:s', strtotime($last_login)); ?></p>


/*

la function : getTweetFromUser viens de tweet.fn, c'est pour que je l'ai ecrit, mais jme suis gourée dans l'algo,
donc à rectifier,

l'idée est d'afficher tout les tweet du profil courant

*/

<?php
foreach(getTweetFromUser($db,$user['id']) AS $tweet){


	echo '<li>'.$tweet['tweet'].' ';
		echo date('d-m-Y \à\ H:i:s', strtotime($tweet['created_at']));
		if($tweet['author_id'] == $_SESSION['id']){
			// Affichage de modifier et supprimer
			echo ' | <a href="edit.php?id='.$tweet['id'].'">Modifier</a> | ';
			echo '<a href="delete.php?id='.$tweet['id'].'">Supprimer</a>';
		}
		echo '</li>';
	}
?>

