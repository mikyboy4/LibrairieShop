<?php
	//Start the session 
	session_start();

	//Check if session is opened
	if (!isset($_SESSION['id'])){
		header('Location: ../error/401.html');
		die;
	}
?>