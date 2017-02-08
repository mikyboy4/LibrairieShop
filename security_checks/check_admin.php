<?php
	//Check if session is opened
	if ($_SESSION['right'] != 1){
		header('Location: ../error/401.html');
		die;
	}
?>