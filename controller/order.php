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

	//Security check - Logged in 
	require_once $_SERVER['DOCUMENT_ROOT']."/security_checks/check_session.php";
    //Security for views and models
    define('INCLUDE_CHECK', true);
    
    if(!isset($_SESSION['id'])){
        header('Location: books.php');
    }
    
//  Models requirements
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/model/m_book_manager.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/model/m_book.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/model/m_order_manager.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/model/m_user_manager.php');
    
//  Required objects
    $UserManager = new UserManager();
    $OrderManager = new OrderManager();
    
//  Status 0 = new / 1 = en cours / 2 = livré  
    $status = array('Nouvelle', 'Validée', 'Payée', 'Epediée', 'Cloturée');
    
    if(isset($_GET['by']) && isset($_GET['value']) && $_SESSION['right']==1){
        if($_GET['by'] == 'user' || $_GET['by'] == 'status' || $_GET['by'] == 'id'){
            $method = 'select';
            $value = $_GET['value'];
            $by = $_GET['by'];
        }else{
            $method = 'select_by_id';
            $by = 'id';
            $value = $_SESSION['id'];
        }
        $orders = $OrderManager->$method($value);
        $update = 1;
        $title = 'Commandes par '.$by;
    }else{
        $method = 'select_by_user';
        $orders = $OrderManager->$method($_SESSION['id']);
        $update = 0;
        $title = 'Mes commandes';
    }
    
    $__title = 'Voir commandes';

//  View construction
        require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/head.php');
        require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/nav.php');
        require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/v_order.php');
        require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/scripts.php');