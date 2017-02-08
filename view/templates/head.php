<?php 
if (!defined('INCLUDE_CHECK')) {
    http_response_code(404); die;
}
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $__title; ?> | LibrairieShop</title>
    <!-- RSS FEED  -->
    <link rel="alternate" type="application/rss+xml" title="RSS fluxisation" href="/../fluxRSS/libraryFlux.xml" />
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="https://opensource.keycdn.com/fontawesome/4.7.0/font-awesome.min.css" integrity="sha384-dNpIIXE8U05kAbPhy3G1cz+yZmTzA6CY8Vg/u2L9xRnHjJiAK76m2BIEaSEV+/aU" crossorigin="anonymous"> 
    <link rel="stylesheet" href="../view/assets/librarieshop.css"> 
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
	  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/jquery-footable/3.1.3/footable.bootstrap.css" rel="stylesheet">
     <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script> 
    <!--<script src="../view/assets/messages_fr.js"></script>-->
  </head>
<body id="body">