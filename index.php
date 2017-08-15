<?php
include('config/autoload.php');


if(isset($_POST['connexion']) AND isset($_POST['username']) AND isset($_POST['password'])){
	login($db, $_POST['username'], $_POST['password']);
}

if(isset($_SESSION['id'])){
	header('Location: home.php');
}


?>

<html>
	<header>
			<meta charset="utf-8">
			<link rel="stylesheet" href="./stylesheet/stylesheet.css" media="screen">
	</header>
	
<body>
  <div class="bs-docs-section clearfix">
        <div class="row">
				<div class="container">
					<div class="page-header">
					
<a href="index.php"><h1>FreeSocial</h1></a>

<div class="col-lg-6">
	<div class="well bs-components">


<h2>Connexion</h2>
<?php 
if(isset($_GET['msg'])){
	$msg= "ERROR BAD LOGIN OR PASSWORD";
	?>
<p><span class="label label-warning"><?php echo $msg; ?> </span><p>
<?php } ?> 
<form action="index.php" method="post">
	<input type="text" name="username" placeholder="Nom d'utilisateur">
	<input type="password" name="password" placeholder="Mot de passe">
	<input type="submit" name="connexion" value="Connexion">
	
<p class="account">Vous n'avez pas de compte ? <a href="register.php">Inscrivez vous !</a></p>
</form>
							</div>
						</div>

					</div>
				</div>
		</div>
</div>


</body>
</html>
	
	