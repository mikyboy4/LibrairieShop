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
    
    //Security check - Logged in 
	require_once $_SERVER['DOCUMENT_ROOT']."/security_checks/check_session.php";
    
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/model/m_user.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/model/m_user_manager.php');
    
    $UserManager = new UserManager();
    $msg = '';
    
       
    if(isset($_SESSION['id'])){
        $id = $_SESSION['id'];
        $userInfo = $UserManager->select_by_id($id);
        $User = new User($userInfo);
        if(isset($_POST['submit'])){
            $userInfo = $_POST;
            
            unset($userInfo['submit']);
            $userInfo['id'] = $id;
            if ($userInfo['password'] != null){
                $userInfo['password'] = sha1('1;151#'.$userInfo['password']);
            }
            $userInfo['right'] = $User->getright();
            $userInfo['deleted'] = 0;
            $User = new User($userInfo);
            $UserManager->update($User);
            $msg = '<p class="alert alert-success">Vos modifications ont été enregistrées</p>';
        }
        $userInfo = $UserManager->select_by_id($id);
        $User = new User($userInfo);
        $error = 0;
    }else{
        $error = 2;
    }
    
    $__title = 'Mes informations';
    
    //  View construction
        require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/head.php');
        require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/nav.php');
        require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/v_my_account.php');
        require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/scripts.php');