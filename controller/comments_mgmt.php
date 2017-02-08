<?php
	//Security check - Logged in 
	require_once $_SERVER['DOCUMENT_ROOT']."/security_checks/check_session.php";
	//Security check - Admin 
	require_once $_SERVER['DOCUMENT_ROOT']."/security_checks/check_admin.php";
    //Security for views and models
    define('INCLUDE_CHECK', true);

	//Security check - Logged in 
	require_once $_SERVER['DOCUMENT_ROOT']."/security_checks/check_session.php";
	//Security check - Admin 
	require_once $_SERVER['DOCUMENT_ROOT']."/security_checks/check_admin.php";

	// Include required files
	require_once $_SERVER['DOCUMENT_ROOT']."/model/m_book_manager.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/model/m_comment.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/model/m_comment_manager.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/model/m_user_manager.php";
	//Init BookManager
	$bookManager = new BookManager();
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

	//HTML dynamic meta data
    $__title = 'Gestion des commentaires';

	//Get all comments
	function get_all_comments($commentManager, $userManager){
		$comments = $commentManager -> select_all(null);
        $HTMLlayout = null;
        if (!empty($comments)) {
            foreach ($comments as $comment) {
                //Layout
				//Dates format
				$comment[3] = new DateTime($comment[3]); 
				$comment[3] = $comment[3] -> format('d.m.Y H:i:s');

				$comment[6] = new DateTime($comment[3]); 
				$comment[6] = $comment[6] -> format('d.m.Y H:i:s');
				
				//Get username with id
				$comment[2] = $userManager -> select_uname($comment[2]);

				//Status of the comment
				if ($comment[4] == 0) {$comment[4] = 'à valider'; $comment[6] = '-';}
				else if ($comment[4] == 1) {$comment[4] = 'validé';}
				else if ($comment[4] == 2) {$comment[4] = 'refusé';}
				else {$comment[4] = 'inconnu';}

                $HTMLlayout .= "<tr>
								<td>".htmlentities($comment[0])."</td>
								<td>".nl2br(htmlentities($comment[1]))."</td>
								<td>".htmlentities($comment[2])."</td>
								<td>".htmlentities($comment[3])."</td>
								<td>".htmlentities($comment[6])."</td>
								<td>".htmlentities($comment[4])."</td>
								<td>
									<a target=\"_blank\" href=\"view_book.php?book=".$comment[5]."\"><button class=\"admin-menu btn\"><i class=\"fa fa-eye\"></i> ID: ".$comment[5]."</button></a>
								</td>
								<td>
									<a href=\"comments_mgmt.php?wtd=validate&comm=".$comment[0]."\"><button class=\"admin-menu btn\"><i class=\"fa fa-check\"></i></button></a>
									<a href=\"comments_mgmt.php?wtd=invalidate&comm=".$comment[0]."\"><button class=\"admin-menu btn\"><i class=\"fa fa-close\"></i></button></a>
									<a alt=\"Supprimer\" href=\"comments_mgmt.php?wtd=del&comm=".$comment[0]."\"><button class=\"admin-menu btn\"><i class=\"fa fa-trash\"></i></button></a>
								</td>
								</tr>";
            }
        } else
            $HTMLlayout = null;
		return $HTMLlayout;
	}
	
	$HTMLlayout = get_all_comments($commentManager, $userManager);

	//URL actions
	if (isset($_GET['wtd']) && $_GET['comm']){
		$comment = new Comment([]);
		$comment -> setid($_GET['comm']);
		$comment -> setvalidation_date(date('Y-m-d H:i:s'));
		if ($_GET['wtd'] == 'validate' && $_SESSION['right'] == 1){
			//UPDATE t_comment status = 1
			$comment -> setstatus(1);
			if ($commentManager -> update_status($comment) != FALSE)
				$return_s = "Commentaire ID: ".htmlentities($_GET['comm'])." validé";
			else 
				$return_f = "Commentaire ID: ".htmlentities($_GET['comm'])." - une erreur c'est produite";
		} else if ($_GET['wtd'] == 'invalidate' && $_SESSION['right'] == 1){
			//UPDATE t_comment status = 2
			$comment -> setstatus(2);
			if ($commentManager -> update_status($comment) != FALSE)
				$return_s = "Commentaire ID: ".htmlentities($_GET['comm'])." refusé";
			else 
				$return_f = "Commentaire ID: ".htmlentities($_GET['comm'])." - une erreur c'est produite";
		} else if ($_GET['wtd'] == 'del' && $_SESSION['right'] == 1){
			//UPDATE t_comment del = 1
			if ($commentManager -> soft_delete($comment) != FALSE)
				$return_s = "Commentaire ID: ".htmlentities($_GET['comm'])." supprimé";
			else 
				$return_f = "Commentaire ID: ".htmlentities($_GET['comm'])." - une erreur c'est produite";
		}
		$HTMLlayout = get_all_comments($commentManager, $userManager);
	}

    //View construction
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/head.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/nav.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/v_comments_mgmt.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/scripts.php');
?>