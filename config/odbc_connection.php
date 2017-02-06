<?php
if (!defined('INCLUDE_CHECK')) {
    http_response_code(404); die;
}
$accessPath = $_SERVER['DOCUMENT_ROOT'].'/DATABASE/projet151.accdb';

if (!file_exists($accessPath)) {
    die("Access database file not found !");
}

//Establish the connection
$odbc = new PDO('odbc:Driver={Microsoft Access Driver (*.mdb, *.accdb)};Dbq='.$accessPath.';Uid=;Pwd=;');

//hide sensible information on PDO errors
$odbc -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>