<?php
	////////////////////////////////// ---------- Entête du programme ---------- //////////////////////////////////
	#################################################################
	#                                                               #
	#	Programme:          LibraryShop                         #
	#	Auteur:             Miguel Jalube                       #
	#                                                               #
	#################################################################
	#                                                               #
	# 	Date :              Decembre 2016                       #
	#	Version :           1.0                                 #
	#	Révisions :                                             #
	#                                                               #
	#################################################################
	#                                                               #
	#	Get administration adding book informations             #
	#                                                               #
	#################################################################
	
	////////////////////////////////// ----- Déclarations ----- //////////////////////////////////

    session_start();

    //Security for views and models
    define('INCLUDE_CHECK', true);
    
    // Recuperation de l'ID
    if(isset($_GET['action']) && isset($_GET['id']) && is_numeric($_GET['id']) && is_numeric($_GET['action'])){
        $id = $_GET['id'];
        $action = $_GET['action'];
    }
    
/*  Effectue les differentes actions :
 *  0 => Ajouter au panier
 *  1 => Enlever du panier
 *  2 => Incrémenter la quantité
 *  3 => Diminuer la quantité
 */
    
//  Ajouter au panier
    if($action == 0){
        $updated = 0;
        if(isset($_SESSION['cart'])){
            $cart = unserialize($_SESSION['cart']);
            foreach ($cart as $k => $v) {
                if($v['id'] == $id){
                    $cart[$k]['amount']++;
                    $updated = 1;
                }
            }
        }else{
            $cart = array();
        }
        if($updated == 0){
            $cart[] = array('id' => $id, 'amount' => 1);
        }

//  Enlever du panier
    }elseif($action == 1){
        if(isset($_SESSION['cart'])){
            $cart = unserialize($_SESSION['cart']);
            
            $key = null;
            //  S'il larticle qui va être ajouté existe déjà dans le panier on augmente la quantité
            foreach ($cart as $k => $v) {
                if($v['id'] == $id){
                    $key = $k;
                }
            }
            array_splice($cart, $key, 1);
        }
        
//  Incrémenter la quantité
    }elseif($action == 2){
        if(isset($_SESSION['cart'])){
            $cart = unserialize($_SESSION['cart']);
            foreach ($cart as $k => $v) {
                if($v['id'] === $id){
                    $key = $k;
                }
            }
            if(isset($key)){
                $cart[$key]['amount']++;
            }
        }
        
//  Diminuer la quantité
    }elseif($action == 3){
        if(isset($_SESSION['cart'])){
            $cart = unserialize($_SESSION['cart']);
            foreach ($cart as $k => $v) {
                if($v['id'] === $id){
                    $key = $k;
                }
            }
            if(isset($key)){
                if($cart[$key]['amount'] > 1){
                    $cart[$key]['amount']--;
                }else{
                    array_splice($cart, $key, 1);
                }
            }
        }
        
    }else{
        echo '<h1>Erreur 404</h1>';
    }
    
//  Si le panier est vide la variable de session est unset pour ne pas faire des requetes dans le vide
    if(isset($cart[0])){
        $_SESSION['cart'] = serialize($cart);
    }else{
        unset($_SESSION['cart']);
    }
    
//Géneration de la page résultat pour l'ajax
///////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//
    //Models requirements
        require_once ($_SERVER['DOCUMENT_ROOT'] . '/model/m_book_manager.php');
        $BookManager = new BookManager();
    
    //  transforme $_SESSION['cart'] en tableau s'il existe
    if(isset($_SESSION['cart'])){
        $cart = unserialize($_SESSION['cart']);
    }
    
    //  Selectionne les données du panier dans la base de données
    if(isset($cart[0])){
        $cartBookList = $BookManager->select_items($cart);
    }
    
    //  Définition de l'affichage du panier
    $output =  '<div class="list-group">
                        <span class="list-group-item active"><h3>Mon panier</h3></span>';

    if(isset($cartBookList)){
        $total = array();
        foreach($cartBookList as $key => $value){
            
//  Détermine la quantité d'un produit grâce à son id
            foreach($cart as $v){
                if($value['id'] === $v['id']){
                    $amount = floatval($v['amount']);
                    $id = $v['id'];
                }
            }

//  Met le prix au type flotant et le format à deux chiffre après la virgule
            $price = floatval($value['price']);
            $price = number_format($price, 2);
            $output .= '<span class="list-group-item">
                      '.$value['title'].'<br><i>Quantité: '.$amount.'</i><br>
                      <b class="pull-left">CHF '.$price.'</b><br>
                      <span class="pull-right">
                      <button onclick="remove('.$value['id'].')"><i class="fa fa-trash-o"></i></button>
                      <button onclick="increase('.$value['id'].')"><i class="fa fa-plus"></i></button>
                      <button onclick="decrease('.$value['id'].')"><i class="fa fa-minus"></i></button>
                      </span><br>
                  </span>';

//  Additionne au prix total
            $priceAmount = $amount * $price;
            $total[] = $priceAmount;
        }
        
//  Affiche le prix total
        $output.= '      <span class="list-group-item">
                    <strong>Total : CHF '.number_format(array_sum($total), 2).'</strong>
                    </span>
                    <span class="list-group-item">
                        <a class="btn btn-primary"><i class="fa fa-trash-o"></i></a>
                        <a href="checkout.php" class="btn btn-primary">Payer</a>
                    </span>';

//  Affiche panier vide
    }else{
        $output .=  '<span class="list-group-item">
                        <strong>Panier vide</strong>
                    </span>
                    <span class="list-group-item">
                    <strong>Total : CHF 00.00</strong>
                    </span>
                    <!--span class="list-group-item">
                        <a class="btn btn-primary"><i class="fa fa-trash-o"></i></a>
                        <a href="checkout.php" class="btn btn-primary">Payer</a>
                    </span-->';
    }
    $output.= '</div>';
    echo $output;
?>
    
