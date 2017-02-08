<?php
    session_start();
    //Security for views and models
    define('INCLUDE_CHECK', true);

	// Include required files
	require_once $_SERVER['DOCUMENT_ROOT']."/model/m_book_manager.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/model/m_genre_manager.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/model/m_comment.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/model/m_comment_manager.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/model/m_user_manager.php";
	//Init BookManager
	$bookManager = new BookManager();
	$genreManager = new GenreManager();
	$commentManager = new CommentManager();
	$userManager = new UserManager();

	 //  transforme $_SESSION['cart'] en tableau s'il existe
    if(isset($_SESSION['cart'])){
        $cart = unserialize($_SESSION['cart']);
    }
    
    //  Selectionne les données du panier dans la base de données
    if(isset($cart[0])){
        $cartBookList = $bookManager->select_items($cart);
    }

	//Get genres to create select in HTML + Book infos
	$bookinfos = $bookManager -> select_item($_GET['book']);
	$genres = $genreManager -> select($bookinfos[11]);

	//HTML dynamic meta data
    $__title = $bookinfos[1];

	//Get validated comments
	$comments = $commentManager -> select($_GET['book']);
        $HTMLlayout = null;
        if (!empty($comments)) {
            foreach ($comments as $comment) {
                //Layout
				//Get username with id
				$comment[2] = $userManager -> select_name($comment[2]);

				//Dates format
				$comment[3] = new DateTime($comment[3]); 
				$comment[3] = $comment[3] -> format('d.m.Y à H:i:s');

                $HTMLlayout .= "<div class=\"panel panel-default\">
				<div class=\"panel-body\">".nl2br(htmlentities($comment[1]))."</div>
				<div class=\"panel-footer\"><small>Ecrit le <b>".$comment[3]."</b> par <b>".$comment[2]."</b> </small></div>
				</div>\n\r";
            }
        } else
            $HTMLlayout = 'Aucun commentaire!';
        
        //  Captcha
        $captchaimg = array(
        '1'=>'83tsU',
        '2'=>'viearer',
        '3'=>'ZZECEL'
        );
        if(!isset($_POST['submit'])){
            $captcharnd = rand(1, 3);
            $_SESSION['randnb'] = $captcharnd;
        }
        
	//Form submit
	if (isset($_POST['submit']) && ($_POST['submit'] == 'Soumettre')){
                if(isset($_POST['captcha']) && $_POST['captcha'] == $captchaimg[$_SESSION['randnb']]){
                    $comment = new Comment([]);
                    $comment -> setuser($_SESSION['id']);
                    $comment -> setcomment($_POST['comment']);
                    $comment -> setstatus(0);
                    $comment -> setFK_book($_GET['book']);
                    $comment -> setcreation_date(date('Y-m-d H:i:s'));
                    $comment -> setdeleted(0);
                    //Record to the database
                    if ($insertedid = $commentManager -> insert($comment) != FALSE){
                            $return_s =  'Commentaire enregistré. La validation est en cours!<br>';
                    } else {
                            $return_f =  'Commentaire non enregistré<br>';
                    }
                }else{
                    $return_f =  'Captcha incorrect<br>';
                }
                $captcharnd = rand(1, 3);
                $_SESSION['randnb'] = $captcharnd;
	}
        
        $captcha = '<img alt="captcha" src="../images/captcha/captcha'.$captcharnd.'.png"/>';
    
    //View construction
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/head.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/nav.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/v_view_book.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/scripts.php');
?>