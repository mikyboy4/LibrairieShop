<?php
	////////////////////////////////// ---------- Entête du programme ---------- //////////////////////////////////
	#################################################################
	#
	#	Programme:          LibraryShop
	#	Auteur:             Miguel Jalube
	#
	#################################################################
	#
	# 	Date :              Decembre 2016
	#	Version :           1.0
	#	Révisions :		
	#
	#################################################################
	#
	#	Get administration adding book informations
	#
	#################################################################
	
	////////////////////////////////// ----- Déclarations ----- //////////////////////////////////

//Security for views and models
    define('INCLUDE_CHECK', true);
    
    session_start();
    if(!isset($_SESSION['id']) && $_SESSION['right'] != 1){
        header('Location: books.php');
    }
    
//  Models requirements
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/model/m_user.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/model/m_user_manager.php');
    
//  Required objects
    $UserManager = new UserManager();
    
    $right = array('Utilisateur', 'Administrateur');
    $deleted = array('Actif', 'Supprimé');

    $userList = $UserManager->select_all();
    
    $__title = 'Liste des utilisateurs';
    
//  View construction
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/head.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/nav.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/v_user_list.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/scripts.php');