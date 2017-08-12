<?php
include('config/autoload.php');
if(!isset($_SESSION['id'])){
	header('Location: index.php');
}

if(empty($_GET['id']) OR $_SESSION['id'] == $_GET['id']){
	$_user =  $id = $_SESSION['id'];
	$username = $_SESSION['username'];
	$created_at = $_SESSION['created_at'];
	$last_login = $_SESSION['last_login'];
}
else{
	$user = getUser($db, $_GET['id']);
	$_user =  $id = $user['id'];
	$username = $user['username'];
	$created_at = $user['created_at'];
	$last_login = $user['last_login'];
}
// Fonction nombre de tweets
$nbTweets = countTweets($db, $id);

?>

<html>
	<header>
			<meta charset="utf-8">
			<link rel="stylesheet" href="./stylesheet/stylesheet.css" media="screen">
	</header>
<?php
include('navBar.php');
 ?>
<body>
  <div class="bs-docs-section clearfix">
        <div class="row">
				<div class="container">
					<div class="page-header">

				<h1>Profil de : <?php echo $username; ?></h1>
				<a href="home.php">Accueil</a>
				<p>Nom d'utilisateur :  <?php echo $username; ?></p>
				<p>Nombre de tweets : <?php echo $nbTweets; ?></p>
				<p>Creation du profil :  <?php echo date('d-m-Y H:i:s', strtotime($created_at)); ?></p>
				<p>Derniere connexion :  <?php echo date('d-m-Y H:i:s', strtotime($last_login)); ?></p>


			<?php
/*

la function : getTweetFromUser viens de tweet.fn, c'est pour que je l'ai ecrit, mais jme suis gourée dans l'algo,
donc à rectifier,

l'idée est d'afficher tout les tweet du profil courant

*/


foreach(getTweetFromUser($db,$_user) AS $tweet){
							echo '<div class="col-lg-8">';
							echo'<div class="well bs-components">';
							echo '<form class="form-vertical">';
							echo '	<fieldset>';
							echo ' <label for="msg" class="col-lg-6 control-label">'.$tweet['tweet'].'</label>';
							echo ' - <a href="profil.php?id=';
							echo $tweet['author_id'];
							echo '">';
							echo ' </a> -';
					 
							echo date('d-m-Y \à\ H:i:s', strtotime($tweet['created_at']));
							if($tweet['author_id'] == $_SESSION['id']){
								// Affichage de modifier et supprimer
								echo ' | <a href="edit.php?id='.$tweet['id'].'">Modifier</a> | ';
								echo '<a href="delete.php?id='.$tweet['id'].'">Supprimer</a>';
							}
							echo '</fieldset>';
							echo '</form>';
							echo '</div>';
							echo '</div>';

							
						}
?>


					</div>
				</div>
		</div>
</div>

<h2>Gestion du profil</h2>
<ul>
	<li><a href="editProfil.php">Editer mon profil</a></li>
</ul>
</body>
</html>

