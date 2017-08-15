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
if( $tweet['author_id'] != $_SESSION['id'] ){
	header('Location: home.php');
}
if(isset($_POST['tweet']) AND strlen($_POST['tweet']) <= 120){
	updateTweet($db, $_GET['id'] ,$_POST['tweet']);
	header('Location: home.php');
}
?>
<form action="edit.php?id=<?php echo $_GET['id']; ?>" method="post">
	<input type="text" name="tweet" value="<?php echo $tweet['tweet'] ?>" placeholder="tweet">
	<input type="submit">
</form>


<?php
include('config/autoload.php');
if(!isset($_SESSION['id'])){
	header('Location: index.php');
}
session_destroy();
header('Location: index.php');


//<?php 
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