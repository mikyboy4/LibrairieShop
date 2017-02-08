<?php 
if (!defined('INCLUDE_CHECK')) {
    http_response_code(404); die;
}

if (strpos($bookinfos[7], '.') !== FALSE)
	$price = $bookinfos[7];
else 
	$price = $bookinfos[7].'.-';
?>
<div class="container">
  <div class="row row-offcanvas row-offcanvas-right">
    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
      	<img class="admin-book-img" src="../images/books/<?php echo $bookinfos[8]; ?>"><br>
				<h1><?php echo htmlentities($bookinfos[1]); ?></h1>
				<h3>CHF <?php echo $price; ?></h3>
				<?php echo "<button class=\"btn\" onclick=\"add(".$bookinfos[0].")\"><i class=\"fa fa-shopping-cart\"></i> Ajouter au panier</button>"; ?>
				<?php if (isset($_SESSION['right']) && $_SESSION['right'] == 1) {echo "<a href=\"modif_book.php?book=".$bookinfos[0]."\"><button class=\"admin-menu btn\"><i class=\"fa fa-edit\"></i> Modifier</button></a>";} ?>
				<hr>
				<h3>Auteur</h3>
				<?php if($bookinfos[3] == 'M'){$bookinfos[3] = 'Monsieur';} else {$bookinfos[3] = 'Madame';}?>
				<span><?php echo htmlentities($bookinfos[3]).' '.htmlentities($bookinfos[5]).' '.htmlentities($bookinfos[4]); ?></span>
				<hr>
				<b>Resumé: </b><br>
				<div class="panel panel-default"><div class="panel-body"><?php echo nl2br(htmlentities($bookinfos[2])); ?></div></div>
				<hr>
				<b>Edition: </b> <span><?php echo htmlentities($bookinfos[9]); ?></span><br>
				<b>Année d'édition: </b> <span><?php echo htmlentities($bookinfos[6]); ?></span><br>
				<b>Genre: </b> <span><?php echo htmlentities($bookinfos[15]); ?></span><br>
				<b>Quantité en stock: </b> <span><?php echo htmlentities($bookinfos[10]); ?></span><br>
				<hr>
				<h3>Commentaires</h3>
				<?php echo $HTMLlayout; ?>
				<?php if (isset($_SESSION['id'])) { ?>
				<hr>
				<form method="POST" class="form-vertical" id="new_comment">
					<div class="form-group">
						<textarea class="form-control" name="comment" id="comment" placeholder="Veuillez écrire votre commentaire ..." data-validation="required length" data-validation-length="20-1500"></textarea>
					</div>
					<div class="form-group text-center">
						<span class="text-danger"><?php if (isset($return_f)) {echo $return_f;} ?></span>
						<span class="text-success"><?php if (isset($return_s)) {echo $return_s;} ?></span>
					</div>
					<div class="form-group">
						<div class="col-xs-6"><?php echo $captcha; ?></div>
						<div class="col-xs-6">
							<input name="captcha" type="text" class="form-control" id="exampleInputPassword1" placeholder="Captcha"/>
							<button type="submit" name="submit" value="Soumettre" class="btn btn-primary">Soumettre</button>
							<br><br><br>
						</div>
					</div>
				</form>
				<?php } ?>
		</div>
		
  <?php 
  require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/v_cart.php');
  require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/footer.php'); 
  ?>