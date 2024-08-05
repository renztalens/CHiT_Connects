<?php
	session_start();
	unset($_SESSION['index']);
	$_SESSION['message'] = 'User does not exist';
	header('location: index.php');
?>