<?php
	////////////////////////////////// ---------- Entête du programme ---------- //////////////////////////////////
	#################################################################
	#
	#	Programme:          LibraryShop
	#	Auteur:             Miguel Jalube et David Miranda (génération PDF - Tuto FPDF - http://www.fpdf.org/)
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
    if(!isset($_SESSION['id'])){
        header('Location: books.php');
    }
    
//  Models requirements
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/model/m_book_manager.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/model/m_order_manager.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/model/m_user_manager.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/model/m_order.php');
    

        
//  Required objects
    $UserManager = new UserManager();
    $OrderManager = new OrderManager();
    $BookManager = new BookManager();
    $tva = 0.08;
    
//  Status 0 = new / 1 = en cours / 2 = livré 
    $status = array('Nouvelle', 'Validée', 'Payée', 'Epediée', 'Cloturée');
    
// Download PDF
    //Generate PDF
    if(isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'pdf'){
        require('../fpdf181/fpdf.php');
        $data = array();
        $total = null;
        class PDF extends FPDF {
            // En-tête
            function Header() {
                global $OrderManager;
                global $UserManager;
                global $BookManager;
                global $data;
                global $total;
                $order = $OrderManager->select_by_id($_GET['id']);
                $order = $order[0];
                // Config Police
                $this->SetFont('Arial','',12);
                // Adresse shop
                $this->Cell(50,5,'LibrarieShop SA',0,1,'L');
                $this->Cell(50,5,'Rue Projet 151',0,1,'L');
                $this->Cell(50,5,'1007',0,1,'L');
                $this->Cell(50,5,'Lausanne',0,1,'L');
                // Adresse client
                $this->Cell(100);
                $this->Cell(50,5,utf8_decode($_SESSION['name']).' '.$_SESSION['surname'],0,1,'L');
                $this->Cell(100);
                $this->Cell(50,5,utf8_decode($_SESSION['adress']),0,1,'L');
                $this->Cell(100);
                $this->Cell(50,5,$_SESSION['npa'],0,1,'L');
                $this->Cell(100);
                $this->Cell(50,5,utf8_decode($_SESSION['city']),0,1,'L');
                // Titre
                $this->SetFont('Arial','B',16);
                $this->Cell(30,10,'Commande no '.$order['id'],0,1,'L');
                // Infos de la commande
                $this->SetFont('Arial','',12);
                $user = $UserManager->select_by_id($order['user']);
                if(isset($order['bookqnt'])){
                    $cart = unserialize($order['bookqnt']);
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
                    if($amount >= $value['logistic_qnt']){
                        $checkStock[$key] = 1;
                    } else{
                        $checkStock[$key] = 0;
                    }
                    array_push($data, array(utf8_decode($value['title']), $amount, 'CHF '.$price, 'CHF '.$priceAmount));
                }
                $stock = 1;
                foreach($checkStock as $key => $value){
                    if(!$checkStock){
                        $stock = 0;
                    }
                }
                if($stock == 0){
                    $interval = '+15 days';
                }else{
                    $interval = '+3 days';
                }
                
                $orderDate = new DateTime($order['order_date']);
                $orderDate = $orderDate->format('d.m.Y');
                $deliveryDate = new DateTime($order['order_date']);
                $deliveryDate->add(DateInterval::createFromDateString($interval));
                $deliveryDate = $deliveryDate->format('d.m.Y');
                $total = number_format(array_sum($prices), 2);
                $this->Cell(30,5,'Date de la commande: '.$orderDate,0,1,'L');
                $this->Cell(30,5,utf8_decode('Date de livraison estimée: ').$deliveryDate,0,1,'L');
                // Saut de ligne
                $this->Ln(10);
            }

            // Tableau amélioré
            function ImprovedTable($header, $data) {
                global $total;
                // Largeurs des colonnes
                $w = array(80, 30, 35, 35);
                // En-tête
                for($i=0;$i<count($header);$i++)
                    $this->Cell($w[$i],7,$header[$i],1,0,'C');
                $this->Ln();
                // Données
                foreach($data as $row) {
                    $this->Cell($w[0],6,$row[0],'LR');
                    $this->Cell($w[1],6,$row[1],'LR');
                    $this->Cell($w[2],6,$row[2],'LR');
                    $this->Cell($w[3],6,$row[3],'LR');
                    $this->Ln();
                }
                $this->Cell(array_sum($w),0,'','T');
                $this->Ln();
                $this->Cell($w[0],6,'TVA','LR');
                $this->Cell($w[1],6,'','LR');
                $this->Cell($w[2],6,'','LR');
                $this->Cell($w[3],6,'8%','LR');
                $this->Ln();
                $this->Cell(array_sum($w),0,'','T');
                $this->Ln();
                $this->Cell($w[0],6,'Total taxes comprises','LR');
                $this->Cell($w[1],6,'','LR');
                $this->Cell($w[2],6,'','LR');
                $this->Cell($w[3],6,'CHF '.$total,'LR');
                $this->Ln();
                $this->Cell(array_sum($w),0,'','T');
                
                $this->Ln(10);
                $this->Cell(30,5,utf8_decode('Librarie Shop vous remercie pour votre commande.'),0,1,'L');
            }
        }

        $pdf = new PDF();
        // Titres des colonnes
        $header = array('Produit', utf8_decode('Quantité'), utf8_decode('Prix unité'), 'Prix');
        // Chargement des données
        
        $pdf->SetFont('Arial','',14);
        $pdf->AddPage();
        $pdf->ImprovedTable($header,$data);
        $pdf->Output();
    }

    //Order update
    if(isset($_POST['status']) && isset($_POST['id'])){
        $Order = new Order($_POST);
        $OrderManager->update($Order);
    }
    
    // Order view
    if(isset($_GET['id']) && isset($_GET['action']) && $_GET['action'] == 'view'){
        $order = $OrderManager->select_by_id($_GET['id']);
        $order = $order[0];
        
        $user = $UserManager->select_by_id($order['user']);
        if(isset($order['bookqnt'])){
            $cart = unserialize($order['bookqnt']);
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
            
            if($amount >= $value['logistic_qnt']){
                $checkStock[$key] = 1;
            }else{
                $checkStock[$key] = 0;
            }
        }
        $stock = 1;
        
        foreach($checkStock as $key => $value){
            if(!$checkStock){
                $stock = 0;
            }
        }
        
        if($stock == 0){
            $interval = '+15 days';
        }else{
            $interval = '+3 days';
        }
        
        $orderDate = new DateTime($order['order_date']);
        $deliveryDate = new DateTime($order['order_date']);
        $deliveryDate->add(DateInterval::createFromDateString($interval));
        $total = number_format(array_sum($prices), 2);
    }else{
        $order = null;
    }

    $__title = 'Aperçu de commande';
    
//  View construction
        require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/head.php');
        require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/nav.php');
        require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/v_one_order.php');
        require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/scripts.php');