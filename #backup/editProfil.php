<?php 
include('config/autoload.php');
if(!isset($_SESSION['id'])){
	header('Location: index.php');
}
// Edition du profil
if(isset($_POST['username'])){
	setUsername($db, $_SESSION['id'], $_POST['username']);
}
if(isset($_POST['password'])){
	setPassword($db, $_SESSION['id'], $_POST['password']);	
}
if(isset($_FILES['image'])){
	$img = setImage($db, $_SESSION['id'], $_FILES['image']);
	print_r($img);
}
?>
<h1>Edition du profil</h1>
<form action="editProfil.php" method="post" enctype="multipart/form-data">
	Nom d'utilisateur : 
	<input type="text" name="username" value="<?php echo $_SESSION['username'] ?>"><br>
	Mot de passe : 
	<input type="password" name="password" placeholder="mdp a changer qu'en cas de besoin">
	<br>
	Image de profil : 
	<input type="file" name="image"><br>

	<input type="submit">
</form>