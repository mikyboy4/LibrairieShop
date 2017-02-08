<?php 
if (!defined('INCLUDE_CHECK')) {
    http_response_code(404); die;
}
?>
<div class="row">
    <div class="box-grey col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
        <?php echo $msg; ?>
        <form class="" method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">Nom d'utilisateur</label>
                <input name="username" type="text" class="form-control" id="exampleInputEmail1" placeholder="Nom d'utilisateur"/>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Mot de passe</label>
                <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Mot de passe"/>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Valider" class="btn btn-primary"/>
                <a class="btn btn-default" href="new_user.php">S'enregistrer</a>
            </div>
        </form>
    </div>
</div>
<?php require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/footer.php'); ?>