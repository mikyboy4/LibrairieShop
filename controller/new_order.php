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
    
    if(!isset($_SESSION['id']) || !isset($_GET['order'])){
        header('Location: books.php');
    }
    
    //Models requirements
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/model/m_book_manager.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/model/m_order_manager.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/model/m_order.php');
    
    $OrderManager = new OrderManager();
    $BookManager = new BookManager();
    $error = 4;
    
    if(isset($_SESSION['cart'])){
        $cart = unserialize($_SESSION['cart']);
        
        //  Total price recalculate
        if(isset($cart[0])){
            $cartBookList = $BookManager->select_items($cart);
        }

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

        }
        $total = number_format(array_sum($prices), 2);

        //  Request to insert the order            
        $orderArray = array();
        $orderArray['user'] = $_SESSION['id'];
        $orderArray['bookqnt'] = $_SESSION['cart'];
        $orderArray['status'] = 0;
        $orderArray['total_price'] = $total;
        $orderArray['deleted'] = 0;
        $orderArray['order_date'] = null;


        $Order = new Order($orderArray);

        if($OrderManager->insert($Order)){
            $error = 0;
        }
        
        foreach($cart as $value){
            $selctedBook = $BookManager->select_item($value['id']);
            if($value['amount'] <= $selctedBook['logistic_qnt']){
                $newStock = $selctedBook['logistic_qnt'] - $value['amount'];
            }else{
                $newStock = 0;
            }
            $BookManager->stock_remove($value['id'], $newStock);
        }
    }else{
        $error = 2;
    }
    unset($_SESSION['cart']);
    header('location: order.php?by=id&value='.$_SESSION['username']);

