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
    
//  variables utiles
    $tva = 0.08;
    $date = new DateTime();
    
//  Models requirements
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/model/m_book_manager.php');
    $BookManager = new BookManager();
    
//  Request for cart products
    session_start();

    if(isset($_SESSION['id'])){
        if(isset($_SESSION['cart'])){
            $cart = unserialize($_SESSION['cart']);
        }

        if(isset($cart[0])){
            $cartBookList = $BookManager->select_items($cart);
        }
        
        $verifStock = array();
        foreach($cartBookList as $key => $value){
            
            
            foreach($cart as $v){
                if($value['id'] === $v['id']){
                    $amount = floatval($v['amount']);
                    $id = $v['id'];
                }
            }
        
            $price = floatval($value['price']);
            $price = number_format($price, 2);

            $priceAmount = $amount * $price;
            $prices[] = $priceAmount;
            
            if($amount > $value['logistic_qnt']){
                $checkStock[$key] = 0;
            }else{
                $checkStock[$key] = 1;
            }
        }
        $stock = 1;
        
        foreach($checkStock as $key => $value){
            if(!$value){
                $stock = 0;
            }
        }
        
        if($stock == 0){
            $interval = '+15 days';
        }else{
            $interval = '+3 days';
        }
        
        $date->add(DateInterval::createFromDateString($interval));
        $total = number_format(array_sum($prices), 2);
        
        $__title = 'Validation de la commande';
        
//  View construction
        require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/head.php');
        require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/nav.php');
        require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/v_checkout.php');
        require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/scripts.php');
        
    }else{
        header('location: login.php?order=1');
    }



