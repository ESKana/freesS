<?php
include('config/autoload.php');
if(!isset($_SESSION['id'])){
	header('Location: index.php');
}
session_destroy();
header('Location: index.php');