
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
					<h1  id="navbar">Twitter</h1>

					<h2>Creer un nouveau tweet</h2>
					<!--<form action="home.php" method="post">
						<input type="text" name="tweet" placeholder="Votre tweet">
						<input type="submit">
						
					</form>-->
						<form 
						class="navbar-form navbar-left" role="search" action="home.php" method="post">
							<div class="form-group">
							<input type="text" class="form-control" placeholder="Message">
							</div>
                      <button type="submit" class="btn btn-default">Envoyer</button>
                    </form>

					<h2>Tous les tweets</h2>
					<ul>
					<?php 
						foreach(showAllTweets($db) AS $tweet){
							echo '<div class="col-lg-8">';
							echo'<div class="well bs-components">';
							echo '<form class="form-vertical">';
							echo '	<fieldset>';
							echo ' <label for="msg" class="col-lg-6 control-label">'.$tweet['tweet'].'</label>';
							echo ' - <a href="profil.php?id=';
							echo $tweet['author_id'];
							echo '">';
							echo $tweet['username'];
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
					</ul>
					</div>
				</div>
		</div>
</div>

<h2>Gestion du profil</h2>
<ul>
	<li><a href="profil.php">Voir mon profil</a></li>
	
</ul>
</body>
</html>