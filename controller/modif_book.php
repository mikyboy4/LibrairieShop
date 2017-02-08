<?php
	//Security check - Logged in 
	require_once $_SERVER['DOCUMENT_ROOT']."/security_checks/check_session.php";
	//Security check - Admin 
	require_once $_SERVER['DOCUMENT_ROOT']."/security_checks/check_admin.php";

	//Security for views and models
    define('INCLUDE_CHECK', true);
	
	// Include file containing class Book
	require_once $_SERVER['DOCUMENT_ROOT']."/model/m_book.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/model/m_book_manager.php";
	require_once $_SERVER['DOCUMENT_ROOT']."/model/m_genre_manager.php";

	//Init BookManager
	$bookManager = new BookManager();
	$genreManager = new GenreManager();

	//Get genres to create select in HTML + Book infos
	$bookinfos = $bookManager -> select_item($_GET['book']);
	$genres = $genreManager -> select($bookinfos[11]);

	//If form is submitted - Enregistrer or Supprimer
	if (isset($_POST['submit']) && ($_POST['submit'] == 'Enregistrer' || $_POST['submit'] == 'Supprimer')){
		//Image cover upload
		//Reduce array to one instead of multi array --> on multiple upload not possible!
		$_FILES = $_FILES['img_cover'];
		$message = null;
		$imageuploaded = $_FILES['name'] == null;
		//upload the file if any files are beeing uploaded
		if ($imageuploaded == 0){
			//set ini file_size preference + other preferences
			ini_set('upload_max_filesize', '10M');
			$authorized_types = array('image/png', 'image/jpeg');
			$upload_dir = $_SERVER['DOCUMENT_ROOT']."images/books/";
			$new_file_name = $_GET['book'].'_'.date('U').'.'.pathinfo($_FILES['name'], PATHINFO_EXTENSION);

			//Error Handling --> Source: http://php.net/manual/en/features.file-upload.errors.php
			switch ($_FILES['error']) {
				case UPLOAD_ERR_INI_SIZE:
					$message = "Cette image dépasse la taille autorisée! - Veuillez utiliser des images avec une taille de 1MB maximum";
					break;
				case UPLOAD_ERR_PARTIAL:
					$message = "Une erreur est survenue, Veuillez réssayer!";
					break;
				/*case UPLOAD_ERR_NO_FILE:
					$message = "No file was uploaded";
					break;*/
				case UPLOAD_ERR_NO_TMP_DIR:
					$message = "Une erreur est survenue, Veuillez réssayer!";
					break;
				case UPLOAD_ERR_CANT_WRITE:
					$message = "Une erreur est survenue, Veuillez réssayer!";
					break;
				case UPLOAD_ERR_EXTENSION:
					$message = "Une erreur est survenue, Veuillez réssayer!";
					break;
			}

			//Validate file type
			if(!in_array($_FILES['type'], $authorized_types)){
				$message = "Format non autorisé! Veuillez utiliser des images en png ou jpeg";
			}

			//If there is an error create failure message
			if ($message == null && $_FILES['error'] != 0){
				$message = "Une erreur est survenue, Veuillez réssayer!";
			}
			if ($message != null){
				$return_f =  'Formulaire non enregistré<br>'.$message.'<br>';
			}
		}
		if ($message == null && $imageuploaded == 0){
			//Move the file from temp to definitive location
			move_uploaded_file($_FILES['tmp_name'], $upload_dir.$new_file_name);
		}
		if ($message == null){
			//Check if the book will be deleted
			$del = 0;
			if ($_POST['submit'] == 'Supprimer')
				$del = 1;

			// We can give it the $_POST array directly:
			$mybook = new Book([]);
			$mybook -> setid($_GET['book']);		
			$mybook -> settitle($_POST['title']);
			$mybook -> setoverview($_POST['overview']);
			$mybook -> setauthor_sex($_POST['author_sex']);
			$mybook -> setauthor_name($_POST['author_name']);
			$mybook -> setauthor_fname($_POST['author_fname']);
			$mybook -> setyear($_POST['year']);
			$mybook -> setprice($_POST['price']);
			if ($imageuploaded == 0) {$mybook -> setimg_cover($new_file_name);}
			else {$mybook -> setimg_cover($_POST['img_cover_hd']);}
			$mybook -> setedition($_POST['edition']);
			$mybook -> setlogistic_qnt($_POST['logistic_qnt']);
			$mybook -> setFK_genre($_POST['type']);
			$mybook -> setdeleted($del);
			$mybook -> setmodif_date(date('Y-m-d H:i:s'));

			//Modif in the database
			if ($bookManager -> update($mybook) != FALSE){
				$return_s =  'Formulaire enregistré correctement<br>';
				$bookinfos = $bookManager -> select_item($_GET['book']);
				$genres = $genreManager -> select($bookinfos[11]);
			} else {
				$return_f =  'Formulaire non enregistré<br>';
			}
		}
	}

	//HTML dynamic meta data
    $__title = 'Ajouter un livre';

	//View construction
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/head.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/nav.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/v_modif_book.php');
    require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/scripts.php');
?>
