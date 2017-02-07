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
                <label for="inputUsername">Nom d'utilisateur</label>
                <input name="username" type="text" class="form-control" id="inputUsername" value="<?php echo $User->getusername(); ?>"/>
            </div>
            <div class="form-group">
                <label for="inputPassword1">Nouveau mot de passe</label>
                <input name="password" type="password" class="form-control" id="inputPassword1" placeholder="Password"/>
            </div>
            <div class="form-group">
                <label for="inputPassword2">Confirmer le nouveau mot de passe</label>
                <input type="password" class="form-control" id="inputPassword2" placeholder="Password"/>
            </div>
            <div class="form-group">
                <label for="inputEmail">Adresse email</label>
                <input name="email" type="email" class="form-control" id="inputEmail" value="<?php echo $User->getemail(); ?>"/>
            </div>
            <div class="form-group">
                <label for="inputName">Prénom</label>
                <input name="name" type="text" class="form-control" id="inputName" value="<?php echo $User->getname(); ?>"/>
            </div>
            <div class="form-group">
                <label for="inputSurname">Nom</label>
                <input name="surname" type="text" class="form-control" id="inputSurname" value="<?php echo $User->getsurname(); ?>"/>
            </div>
            <div class="form-group">
                <label for="inputAdress">Rue et n°</label>
                <input name="adress" type="text" class="form-control" id="inputAdress" value="<?php echo $User->getadress(); ?>"/>
            </div>
            <div class="form-group">
                <label for="inputNpa">Code postal</label>
                <input name="npa" type="text" class="form-control" id="inputNpa" value="<?php echo $User->getnpa(); ?>"/>
            </div>
            <div class="form-group">
                <label for="inputCity">Commune</label>
                <input name="city" type="text" class="form-control" id="inputCity" value="<?php echo $User->getcity(); ?>"/>
            </div>
            <input type="submit" name="submit" value="Modifier" class="btn btn-default"/>
        </form>
    </div>
</div>
<?php// require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/footer.php'); ?>