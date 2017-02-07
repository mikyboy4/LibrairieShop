<?php 
if (!defined('INCLUDE_CHECK')) {
    http_response_code(404); die;
}

$selectRight = '<select id="right" name="right" class="form-control">';
foreach($right as $key => $value){
    if($User->getright() == $key){
        $selected = 'selected';
    }else{
        $selected = '';
    }
    $selectRight .= '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
}
$selectRight .= '</select>';

$selectDeleted = '<select id="deleted" name="deleted" class="form-control">';
foreach($deleted as $key => $value){
    if($User->getdeleted() == $key){
        $selected = 'selected';
    }else{
        $selected = '';
    }
    $selectDeleted .= '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
}
$selectDeleted .= '</select>';
?>
<div class="row">
    <div class="box-grey col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
        <?php echo $msg; ?>
        <form class="" method="post">
            <div class="form-group">
                <label for="username">Nom d'utilisateur</label>
                <p id="username"><?php echo $User->getusername(); ?></p>
            </div>
            <div class="form-group">
                <label for="email">Adresse email</label>
                <p id="email"><?php echo $User->getemail(); ?></p>
            </div>
            <div class="form-group">
                <label for="inputName">Prénom</label>
                <p id="inputName" ><?php echo $User->getname(); ?></p>
            </div>
            <div class="form-group">
                <label for="surname">Nom</label>
                <p id="surname" ><?php echo $User->getsurname(); ?></p>
            </div>
            <div class="form-group">
                <label for="adress">Rue et n°</label>
                <p id="adress" ><?php echo $User->getadress(); ?></p>
            </div>
            <div class="form-group">
                <label for="npa">Code postal</label>
                <p id="npa" ><?php echo $User->getnpa(); ?></p>
            </div>
            <div class="form-group">
                <label for="city">Commune</label>
                <p id="city" ><?php echo $User->getcity(); ?></p>
            </div>
            <div class="form-group">
                <label for="right">Droits</label>
                <?php echo $selectRight; ?>
            </div>
            <div class="form-group">
                <label for="deleted">Etat</label>
                <?php echo $selectDeleted; ?>
            </div>
            <input type="hidden" name="id" value="<?php echo $User->getid(); ?>"/>
            <input type="submit" name="submit" value="Modifier" class="btn btn-danger"/>
        </form>
    </div>
</div>
<?php require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/footer.php'); ?>