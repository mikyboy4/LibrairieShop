<?php 
if (!defined('INCLUDE_CHECK')) {
    http_response_code(404); die;
}

    $output =  '<div id="cart" class="center col-xs-12 col-sm-12 col-md-offset-1 col-lg-offset-1 col-md-10 col-lg-10">'
               . '<div class="list-group"><h2>'.$__title.'</h2>';
    $output.=       '<table data-sorting="true" data-filtering="true" data-paging="true" class="table table-hover"><thead>'
                        . '<tr class="tableImportant">'
                            . '<th>ID</th>'
                            . '<th>Nom d\'utilisateur</th>'
                            . '<th>Etat</th>'
                            . '<th>Droits</th>'
                            . '<th data-type="html">Actions</th>'
                        . '</tr></thead><tbody>';
    foreach($userList as $key => $value){
        $output.=       '<tr>'
                            . '<td>'.$value['id'].'</td>'
                            . '<td>'.$value['username'].'</td>'
                            . '<td>'.$deleted[$value['deleted']].'</td>'
                            . '<td>'.$right[$value['right']].'</td>'
                            . '<td><a href="update_user.php?&id='.$value['id'].'"><button class="btn"><i class="fa fa-edit"></i></button></a></td>'
                      . '</tr>';
    }
    $output.=         '</tbody></table>'
               . '</div>'
            . '</div>';
    echo $output;
require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/footer.php'); 
?>
