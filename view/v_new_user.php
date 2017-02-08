<?php 
if (!defined('INCLUDE_CHECK')) {
    http_response_code(404); die;
}
?>
<div class="row">
    <div class="box-grey col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
        <?php echo $msg; ?>
        <form class="" method="post" id="new_user">
             <div class="form-group">
                <label for="inputUsername">Nom d'utilisateur</label>
                <input name="username" type="text" data-validation="length" data-validation-length="3-100" class="form-control" id="inputUsername" />
            </div>
            <div class="form-group">
                <label for="inputPassword1">Nouveau mot de passe</label>
                <input name="password" type="password" data-validation="length" data-validation-length="0-30" class="form-control" id="inputPassword1" placeholder="Password"/>
                <small>Laisser vide si vous ne souhaitez pas modifier le mot de passe</small>
            </div>
            <div class="form-group">
                <label for="inputPassword2">Confirmer le nouveau mot de passe</label>
                <input type="password" data-validation="length" data-validation-length="0-30" class="form-control" id="inputPassword2" placeholder="Password"/>
                <small>Laisser vide si vous ne souhaitez pas modifier le mot de passe</small>
            </div>
            <div class="form-group">
                <label for="inputEmail">Adresse email</label>
                <input name="email" type="email" data-validation="required email" data-validation-length="6-100" class="form-control" id="inputEmail" />
            </div>
            <div class="form-group">
                <label for="inputName">Prénom</label>
                <input name="name" type="text" data-validation="length" data-validation-length="3-100" class="form-control" id="inputName" />
            </div>
            <div class="form-group">
                <label for="inputSurname">Nom</label>
                <input name="surname" type="text" data-validation="length" data-validation-length="3-100" data-validation="length" data-validation-length="3-100" class="form-control" id="inputSurname" />
            </div>
            <div class="form-group">
                <label for="inputAdress">Rue et n°</label>
                <input name="adress" type="text" data-validation="length" data-validation-length="3-150" class="form-control" id="inputAdress" />
            </div>
            <div class="form-group">
                <label for="inputNpa">Code postal</label>
                <input name="npa" type="text" class="form-control" data-validation="number length" data-validation-length="4" id="inputNpa" />
            </div>
            <div class="form-group">
                <label for="inputCity">Ville</label>
                <input name="city" type="text" data-validation="length" data-validation-length="3-100" class="form-control" id="inputCity" />
            </div>
            <div class="form-group">
                <?php echo $captcha; ?>
                <input name="captcha" type="text" class="form-control" id="inputCaptcha" placeholder="Captcha"/>
            </div>
            <input type="submit" name="submit" />
        </form>
    </div>
</div>
<?php require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/footer.php'); ?>