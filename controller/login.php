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
    if(isset($_SESSION['user']) && $_SESSION['user'] != null){
        header('Location: books.php');
    }
    
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/model/m_user_manager.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/model/m_user.php');
    
    $error = 0;
    
    if(isset($_GET['msg'])){
        $msg = '<p class="alert alert-success">Merci pour votre incription. Connectez-vous!</p>';
    }
    else{
        $msg = '';
    }
    $__title = 'Login';
    
    $captchaimg = array(
        '1'=>'83tsU',
        '2'=>'viearer',
        '3'=>'ZZECEL'
    );
    if(!isset($_POST['submit'])){
        $captcharnd = rand(1, 3);
        setcookie('randnb',$captcharnd);
    }
    
//  Set the redirection location after login
    if(isset($_GET['order']) && $_GET['order']){
        $location = 'Location: checkout.php';
    }else{
        $location = 'Location: books.php';
    }
    
    if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['submit'])){        
        if($_POST['captcha'] == $captchaimg[$_COOKIE['randnb']]){
            $UserManager = new UserManager();           
            $userData = $UserManager -> select($_POST['username']);

            if(isset ($userData['password']) && $userData['password'] == sha1('1;151#'.$_POST['password'])){

                $User = new User($userData);

                $_SESSION['id'] = $User ->getid();
                $_SESSION['username'] = $User ->getusername();
                $_SESSION['name'] = $User ->getname();
                $_SESSION['surname'] = $User ->getsurname();
                $_SESSION['email'] = $User ->getemail();
                $_SESSION['right'] = $User ->getright();
                $_SESSION['adress'] = $User ->getadress();
                $_SESSION['npa'] = $User ->getnpa();
                $_SESSION['city'] = $User ->getcity();

                header($location);
            }else{
                $error = 2;
            }
        }else{
            $error = 1;
        }
        if($error == 1){
        $msg = '<p class="bg-danger">Merci de verifier le CAPTCHA</p>';
        }elseif($error == 2){
            $msg = '<p class="bg-danger">Nom d\'utilisateur ou mot de passe faux</p>';
        }
        $captcharnd = rand(1, 3);
        setcookie('randnb',$captcharnd);
    }
    $captcha = '<img alt="captcha" src="../images/captcha/captcha'.$captcharnd.'.png"/>';
    
    /*echo '<pre>';
    print_r();
    echo '</pre>';*/
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/head.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/nav.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/v_login.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/scripts.php');