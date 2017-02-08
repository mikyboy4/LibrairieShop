<?php 
if (!defined('INCLUDE_CHECK')) {
    http_response_code(404); die;
}
?>
<div class="container">
  	<div class="row">
		<form method="POST" class="form-vertical" id="modif_book" enctype="multipart/form-data">
			<div class="col-md-6">
				<div class="form-group">
					<label>ID</label>
					<input class="form-control" name="id" id="id" disabled value="<?php echo $bookinfos[0]; ?>">
				</div>
				<div class="form-group">
					<label>Titre*</label>
					<input class="form-control" name="title" id="title" data-validation="required length" data-validation-length="3-150" value="<?php echo $bookinfos[1]; ?>">
				</div>
				<div class="form-group">
					<label>Résumé*</label>
					<textarea class="form-control" name="overview" id="overview" data-validation="required length" data-validation-length="20-1500"><?php echo $bookinfos[2]; ?></textarea>
				</div>
				<div class="form-group">
					<label>Sexe de l'auteur*</label>
					<select name="author_sex" id="author_sex" data-validation="required" class="form-control">
						<option <?php if($bookinfos[3] == 'F') echo 'selected'; ?> value="F">Madame</option>
						<option <?php if($bookinfos[3] == 'M') echo 'selected'; ?> value="M">Monsieur</option>
					</select>
				</div>
				<div class="form-group">
					<label>Nom de l'auteur*</label>
					<input class="form-control" name="author_name" id="author_name" data-validation="required length" data-validation-length="3-100" value="<?php echo $bookinfos[4]; ?>">
				</div>
				<div class="form-group">
					<label>Prénom de l'auteur*</label>
					<input class="form-control" name="author_fname" id="author_fname" data-validation="required length" data-validation-length="3-100" value="<?php echo $bookinfos[5]; ?>">
				</div>
				<div class="form-group">
					<label>Année de l'édition*</label>
					<input class="form-control" name="year" id="year" data-validation="required date" data-validation-format="yyyy" value="<?php echo $bookinfos[6]; ?>">
				</div>
				<div class="form-group">
					<label>Prix*</label>
					<input class="form-control" name="price" id="price" data-validation="required number" data-validation-allowing="float" data-validation-decimal-separator="." value="<?php echo $bookinfos[7]; ?>">
				</div>
			</div>

			<div class="col-md-6">
				<div class="form-group">
					<label>Image du livre</label>
					<input class="" type="file" name="img_cover" id="img_cover">
					<small>Veuilez insérer des images en PNG ou JPEG et avec une taille maximale de 1 MB</small>
					<br>
					<input type="hidden" name="img_cover_hd" id="img_cover_hd" value="<?php echo $bookinfos[8]; ?>">
					<img class="admin-book-img" src="../images/books/<?php echo $bookinfos[8]; ?>">
				</div>
				<div class="form-group">
					<label>Edition*</label>
					<input class="form-control" name="edition" id="edition" data-validation="required length" data-validation-length="3-100" value="<?php echo $bookinfos[9]; ?>">
				</div>
				<div class="form-group">
					<label>Quantité en stock*</label>
					<input class="form-control" name="logistic_qnt" id="logistic_qnt" data-validation="number" value="<?php echo $bookinfos[10]; ?>">
				</div>
				<div class="form-group">
					<label>Genre*</label>
					<select name="type" id="type" data-validation="required" class="form-control">
						<?php echo $genres; ?>
					</select>
				</div>
				<div class="form-group">
					<label>Date de création</label>
					<input class="form-control" name="creation_date" id="creation_date" disabled value="<?php echo $bookinfos[12]; ?>">
				</div>
				<div class="form-group">
					<label>Date de la dernière modification</label>
					<input class="form-control" name="modif_date" id="modif_date" disabled value="<?php echo $bookinfos[13]; ?>">
				</div>
				<div class="form-group">
					<label>Supprimé?</label>
					<input class="form-control" name="deleted" id="deleted" disabled value="<?php echo $bookinfos[14]; ?>">
				</div>
			</div>
			<div class="col-md-12">
				<hr>
				<div class="form-group text-center">
					<span class="text-danger"><?php if (isset($return_f)) echo $return_f; ?></span>
					<span class="text-success"><?php if (isset($return_s)) echo $return_s; ?></span><hr>
					<button type="submit" name="submit" value="Enregistrer" class="btn btn-primary">Enregistrer</button>
					<button type="submit" name="submit" value="Supprimer" class="btn btn-danger">Supprimer</button>
				</div>
			</div>
		</form>
	</div>
</div>
<?php require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/footer.php'); ?>