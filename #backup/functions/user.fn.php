<?php

function register($db, $username, $password){

	$check = $db->prepare('SELECT * FROM users WHERE username = :username');
	$check->execute(array(
		':username'	=>	$username
	));

	if($userExist = $check->fetch() ){
		// Si la fonction renvoie true, c'est que l'utilisateur existe
		header('Location: index.php?msg=errorUserExist');
	}
	else{
		// Si la fonction ne renvoie rien, c'est que l'utilisateur n'existe pas
		// Comme l'utilisateur n'existe pas, on peut l'insérer en base de données
		$insert = $db->prepare('INSERT INTO users (username, password, rank, created_at, last_login) 
			VALUES (:username, :password, :rank,:created_at, :last_login)');
		$insert->execute(array(
			':username'	=>	$username,
			':password'	=>	sha1($password),
			':rank'		=>	1,
			':created_at'	=>	date('Y-m-d H:i:s'),
			':last_login'	=>	date('Y-m-d H:i:s')
		));
		header('Location: index.php?msg=success');
	}

}

function login($db, $username, $password){
	$check = $db->prepare('SELECT * FROM users WHERE username = :username');
	
	$check->execute(array(
		':username'	=>	$username
	));

	if($userExist = $check->fetch() ){
		// Si la fonction renvoie true, c'est que l'utilisateur existe
		// On verifie désormais que le mot de passe correspond à la base de données
		if($userExist['password'] == sha1($password)){
			// L'utilisateur est connecté. On met à jour la colonne "last_login"
			$update = $db->prepare('UPDATE users SET last_login = :last_login WHERE id = :id');
			$update->execute(array(
				':last_login'	=>	date('Y-m-d H:i:s'),
				':id'			=>	$userExist['id']
			));
			// On crée desormais les sessions
			$_SESSION['id'] = $userExist['id'];
			$_SESSION['username'] = $userExist['username'];
			$_SESSION['created_at'] = $userExist['created_at'];
			$_SESSION['last_login'] = $userExist['last_login'];
		}
		else{
			// Les mots de passe ne correspondent pas
			header('Location: index.php?msg=errorConnexion');
		}
	}
	else{
		header('Location: index.php?msg=errorConnexion');
	}		
}

function countTweets($db, $userId){
	$req = $db->prepare('SELECT * FROM tweets WHERE author_id = :id');
	$req->execute(array(
		':id'	=>	$userId
	));
	return $req->rowCount();
}

function getUser($db, $userId){
	$req = $db->prepare('SELECT id, username, image, last_login, created_at FROM users WHERE id = :id');
	$req->execute(array(
		':id'	=>	$userId
	));
	return $req->fetch();
}

function setUsername($db, $userId ,$username){
	// Check si l'username est déjà pris
	$check = $db->prepare('SELECT * FROM users WHERE username = :username');
	$check->execute(array(
		':username'	=>	$username
	));
	if($check->fetch()){
		// L'utilisateur est déjà pris
		return false;
	}
	else
	{
		// On peut continuer
		$update = $db->prepare('UPDATE users SET username = :username WHERE id = :id');
		$update->execute(array(
			':username'	=>	$username,
			':id'	=>	$userId
		));
		// Définition de la nouvelle session
		$_SESSION['username'] = $username;
	}
}

function setPassword($db, $userId ,$password){
	$update = $db->prepare('UPDATE users SET password = :password WHERE id = :id');
	$update->execute(array(
		':password'	=>	sha1($password),
		':id'	=>	$userId
	));
}

function setImage($db, $userId, $file){
	$extensions = array('.png', '.gif', '.jpg', '.jpeg');
	// récupère la partie de la chaine à partir du dernier . pour connaître l'extension.
	$extension = strrchr($_FILES['avatar']['name'], '.');
	//Ensuite on teste
	if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
	{
	     header('Location: editProfil.php?msg=ErrorExtension');
	}
	$dossier = 'assets/uploads/';
	$fichier = basename($file['name']);
	if(move_uploaded_file($file['tmp_name'], $dossier . $fichier)) 
	{
		$req = $db->prepare('UPDATE users SET image = :image WHERE id = :id');
		$req->execute(array(
		    ':image'=>  $file['name'],
		    ':id'   =>  $userId
		));
	}
}

function getImage($db, $id){
	$req = $db->prepare('SELECT image FROM users WHERE id =:id');
	$req->execute(array(
		'id'	=> $id
		));
	return $req->fetch();
}

function getIDfromUsername($db,$username){
	
	$req = $db->preapre('SELECT `username` FROM `users` WHERE username = :username');
	$req->execute(array(
		':username' => $username
		));
		return $req->fetch();	
}

function getInfoFromUser($db, $user_id){
	$req = $db->prepare('SELECT * FROM info WHERE id_user = :id');
	$req->execute(array(
		':id'	=>	$user_id
	));
	//return $req->fetch(); 
	return $row = $req->fetchAll();
}

function friend_request($db,$id_to){
	
	/*
	on a qu'une table finalement pour les amis, avec le status, ça permet de tout faire d'un coup, connaitre l'etat de l'amitié en cours.
	pas besoin d'ID normalement
	
	*/
	
	/*
		rechercher dans la table FRIEND_REQUEST si l'invitation a déjà été demande, si OUI on n'afficheras pas le bouton avec un liens pour envoyé l'invitation.
			et on checkeras egalement ici, pour eviter tout bug, et ne pas avoir 50fois la même request
	*/
	
	/*	(condition pour chercher si l'entrée est present)*/
	/* SI OUI, ne rien faire*/
	/* SI NON, l'ecrire dans la table, friend_request en ecrivant l'entrée et en mettant un 0 dans la demande d'amitié*/
	
	/*
	 0-> demande envoyé
	 1-> demande refuser possibilitié de redemander une invitation
	 2-> demande refuser plus possibilité de demander (user blocké *en gros*)
	 3-> demande accepté	
	*/
	
}

function accept_request($db, $id_to){
	
	/*
		Accepte la demande d'ami en midifiant le status en 3
	*/
	
	
}


/************************************/

function getURLfromUser($db,$username){
	
	$req = $db->prepare('SELECT `url`,`rank` FROM `url` WHERE username = :username');
	$req->execute(array(
		':username' => $username
		));
		return $req->fetch();	
	
	
}

/************************************/

?>