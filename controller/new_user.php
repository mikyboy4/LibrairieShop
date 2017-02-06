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
    
    $error = 0;
    $msg = '';
    $__title = 'New user';
    
    $captchaimg = array(
        '1'=>'83tsU',
        '2'=>'viearer',
        '3'=>'ZZECEL'
    );
    if(!isset($_POST['submit'])){
        $captcharnd = rand(1, 3);
        setcookie('randnb',$captcharnd);
    }
    
//Models requirements
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/model/m_user.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/model/m_user_manager.php');
    
    if(isset($_POST['submit'])){
        if($_POST['captcha'] == $captchaimg[$_COOKIE['randnb']]){
            $userInfo = array();
            $UserManager = new UserManager();
            foreach($_POST as $key => $value){
                if(isset($value) && $value != null){
                    $userInfo[$key] = $value;
                    $checkValues = 1;
                }else{
                    $checkValues = 0;
                }
            }
            if($UserManager->check_uname($userInfo['username']) == FALSE){
                $userInfo['password'] = sha1('1;151#'.$userInfo['password']);
                $userInfo['deleted'] = 0;
                $userInfo['right'] = 0;
                $user = new User($userInfo);
                $UserManager->insert($user);
            }else{
                $error = 2;
            }
        }else{
            $error = 1;
        }
        if($error == 1){
            $msg = '<p class="bg-danger">Merci de verifier le CAPTCHA</p>';
        }elseif($error == 2){
            $msg = '<p class="bg-danger">Nom d\'utilisateur déjà existant</p>';
        }elseif($checkValues == 0){
            $msg = '<p class="bg-danger">Nom d\'utilisateur ou mot de passe faux</p>';
        }elseif($error == 0 && $checkValues == 1){
           header('location: login.php?msg=new');
        }
        $captcharnd = rand(1, 3);
        setcookie('randnb',$captcharnd);
    }
    $captcha = '<img alt="captcha" src="../images/captcha/captcha'.$captcharnd.'.png"/>';
    
//View construction
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/head.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/nav.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/v_new_user.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/scripts.php');