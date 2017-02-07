<?php 
if (!defined('INCLUDE_CHECK')) {
    http_response_code(404); die;
}

    $output =  '<div id="cart" class="center col-xs-12 col-sm-12 col-md-offset-1 col-lg-offset-1 col-md-10 col-lg-10">'
               . '<div class="list-group"><h2>'.$title.'</h2>';
    $output.=       '<table data-sorting="true" data-filtering="true" data-paging="true" class="table table-hover"><thead>'
                        . '<tr class="tableImportant">'
                            . '<th>N° de commande</th>'
                            . '<th>Nom d\'utilisateur</th>'
                            . '<th>Statut</th>'
                            . '<th>Date de la commande</th>'
                            . '<th class="priceColumn">Montant</th>'
                            . '<th data-type="html">Actions</th>'
                        . '</tr></thead><tbody>';
    foreach($orders as $key => $value){
        $user = $UserManager->select_by_id_deleted($value['user']);
        $output.=       '<tr>'
                            . '<td>'.$value['id'].'</td>'
                            . '<td>'.$user['username'].'</td>'
                            . '<td>'.$status[$value['status']].'</td>'
                            . '<td>'.$value['order_date'].'</td>'
                            . '<td class="priceColumn">'.$value['total_price'].'</td>'
                            . '<td><a href="one_order.php?action=view&id='.$value['id'].'"><button class="btn"><i class="fa fa-eye"></i></button></a>';
        if($update == 1){
            $output.=             '<a href="one_order.php?action=edit&id='.$value['id'].'"><button class="btn"><i class="fa fa-edit"></i></button></a>';
        }
        $output.=             '</td>'
                      . '</tr>';
    }
    $output.=         '</tbody></table>'
               . '</div>'
            . '</div>';
    echo $output;
require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/footer.php'); 
?>
