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
			
				<?php $img = getUser($db, $id); echo "<img src='./assets/uploads/".$img['image']."'></img> </BR>";?>
				<div class="col-lg-8">
				<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Panel primary</h3>
  </div>
  <div class="panel-body">
				<p>Nom d'utilisateur :  <?php echo $username; ?></p>
				<p>Nombre de tweets : <?php echo $nbTweets; ?></p>
				<p>Creation du profil :  <?php echo date('d-m-Y H:i:s', strtotime($created_at)); ?></p>
				<p>Derniere connexion :  <?php echo date('d-m-Y H:i:s', strtotime($last_login)); ?></p>
				
				<?php //

				foreach(getURLfromUser($db,$username) as $url){
					echo '<li>'.$url['url'].'RANK : '.$url['rank'].'</li>';
				}
				
				?>

				</div></div></div>
				
				
				<div class="container">
				<div class="col-lg-8">
				
				<div class="panel panel-info">
  <div class="panel-heading">
    <h3 class="panel-title">MESSAGE :</h3>
  </div>
  <div class="panel-body">
    			<?php
/*

la function : getTweetFromUser viens de tweet.fn, c'est pour que je l'ai ecrit, mais jme suis gourée dans l'algo,
donc à rectifier,

l'idée est d'afficher tout les tweet du profil courant

*/


					
foreach(getTweetFromUser($db,$_user) AS $tweet){
							
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
							

							
						}
?>
	</div>
				
  </div>
</div>

</div>
				<div class="container"> 
<?php

				/*echo '<div class="col-lg-8">';
				echo '<fieldset>';
				echo'<div class="well bs-components">';
								
				
				echo '<h2> info : </h2>';
				foreach(getInfoFromUser($db,$_user) AS $info){
					
					echo '<p> Jabber :'.$info['jabber'].'</p>';
					echo '<p> PGP :'.$info['PGP'].'</p>';			//mettre de la couleur au nom d'info, et faire en sorte que l'on puisse Copy le contenu des infos sans probleme
					
							
				}
				
				echo '</div>';
				echo '</fieldset>';
				echo '</div>';*/
				
				echo '<div class="col-lg-8">';
				echo '<div class="panel panel-success">';
  echo '<div class="panel-heading">';
    echo '<h3 class="panel-title">INFO</h3>';
  echo '</div>';
  echo '<div class="panel-body">';
    				foreach(getInfoFromUser($db,$_user) AS $info){
					
					echo '<p> Jabber :'.$info['jabber'].'</p>';
					echo '<p> PGP :'.$info['PGP'].'</p>';			//mettre de la couleur au nom d'info, et faire en sorte que l'on puisse Copy le contenu des infos sans probleme
					
							
				}
  echo '</div>';
echo '</div>';
echo '</div>';
				
				
				?>
				</div>




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

