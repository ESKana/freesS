<?php

function addTweet($db, $tweet, $authorId){
	$req = $db->prepare('INSERT INTO tweets (tweet, author_id, created_at) 
		VALUES (:tweet, :author_id, :created_at)');
	$req->execute(array(
		':tweet'	=>	$tweet,
		':author_id'=>	$authorId,
		':created_at'=> date('Y-m-d H:i:s')
	));
}


function showAllTweets($db){
	$req = $db->prepare('SELECT * FROM users RIGHT JOIN tweets ON tweets.author_id = users.id ORDER BY tweets.id DESC');
	$req->execute();
	return $row = $req->fetchAll();
}

function getTweet($db, $tweet_id){
	$req = $db->prepare('SELECT * FROM tweets WHERE id = :id');
	$req->execute(array(
		':id'	=>	$tweet_id
	));
	return $req->fetch();
}

function updateTweet($db, $tweet_id, $newTweet){
	$req = $db->prepare('UPDATE tweets SET tweet = :newTweet WHERE id = :tweetId');
	$req->execute(array(
		':newTweet'	=>	$newTweet,
		':tweetId'	=>	$tweet_id
	));
}

function deleteTweet($db, $tweet_id){
	$req = $db->prepare('DELETE FROM tweets WHERE id = :id');
	$req->execute(array(
		':id'	=>	$tweet_id
	));
}