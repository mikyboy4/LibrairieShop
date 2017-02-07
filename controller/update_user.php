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
    
    $msg='';
    
    if(isset($_POST['right']) && isset($_POST['deleted']) && isset($_POST['id'])){
        $id = $_POST['id'];
        $userInfo = $UserManager->select_by_id_deleted($id);
        $User = new User($userInfo);
        
        if($_POST['right'] == 1){
            $UserManager->grant_admin($User);
        }else{
            $UserManager->grant_user($User);
            if($_SESSION['id'] == $id){
                $_SESSION['right'] = 0;
                header('location: books.php');
            }
        }
        if($_POST['deleted'] == 1){
            $UserManager->soft_delete($User);
            if($_SESSION['id'] == $id){
                session_destroy();
                header('location: books.php');
            }
        }else{
            $UserManager->recover($User);
        }
        $msg = '<p class="alert alert-success">L\'utilisateur à été modifié avec succès</p>';
        
    }
    
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $userInfo = $UserManager->select_by_id_deleted($id);
        $User = new User($userInfo);
    }else{
        $error = 1;
    }
    
    $__title = 'Modifier un utilisateur';
    
//  View construction
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/head.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/nav.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/v_update_user.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/scripts.php');