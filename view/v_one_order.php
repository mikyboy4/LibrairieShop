<?php
$action = 'Details de';
if($_SESSION['right'] == 1 && $_GET['action'] == 'edit'){
    $action = 'Modifier';
    $select = '<select onchange="this.form.submit()" name="status" class="form-control">';
    foreach($status as $key => $value){
        if($order['status'] == $key){
            $selected = 'selected';
        }else{
            $selected = '';
        }
        $select .= '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
    }
    $select .= '</select>';
}else{
    $select = $status[$order['status']];
}    
    $output =  '<div id="cart" class="center col-xs-12 col-sm-12 col-md-offset-1 col-lg-offset-1 col-md-10 col-lg-10">'
               . '<div class="list-group"><div><h2>'.$action.' la commande N° '.$order['id'].'</h2></div>';
    //  Informations
    $output.= '<div clas="col-xs-12 col-sm-12 col-md-4 col-lg-4">'
                . '<p><strong>Adresse de livraison :</strong></p>'
                . '<p>'.$user['name'].' '.strtoupper($user['surname']).'<br>'.$user['adress'].'<br>'.$user['npa'].' '.$user['city'].'</p>'
                . '<p><strong>Date de la commande :</strong> '.$orderDate->format('d.m.Y').'</p>'
            . '</div>';
    //  Informations
    $output.= '<div clas="col-xs-12 col-sm-12 col-md-4 col-lg-4">'
                . '<p><strong>Date de livraison estimée :</strong> '.$deliveryDate->format('d.m.Y').'</p>';

    if($stock == 0){
        $output.= '<p class="alert">Attention nous n\'avons pas assez d\'articles en stock pour répondre à votre commande. La date de livraison risque d\'être plus longue que prévue</p>';
    }
    $output.=   '<p><strong>Etat de la commande :</strong> ';
    $output.=   '<form class="form-inline" method="post">
                    '.$select.'
                    <input type="hidden" value="'.$order['id'].'" name="id"/>'
          . '</form></p>'
            . '</div>';

    $output.=   '<div><a href="one_order.php?action=pdf&id='.$order['id'].'" target="_blank"><button class="btn"><i class="fa fa-download"></i>Télécharger commande en PDF</button></a></div><br>';
  
//  Order
    $output.=           '<div><table class="table table-hover">'
                            . '<thead>'
                                . '<tr class="tableImportant">'
                                    . '<td>Produit</td><td>Quantité</td><td>En stock</td><td class="priceColumn">Prix en CHF</td>'
                                . '</tr>'
                            . '</thead>'
                            . '<tbody>';

    if(isset($cartBookList)){
        foreach($cartBookList as $key => $value){
            foreach($cart as $v){
                if($value['id'] === $v['id']){
                    $amount = floatval($v['amount']);
                    $id = $v['id'];
                }
            }
            
            $price = floatval($value['price']);
            $priceAmount = $amount * $price;
            $priceAmount = ($priceAmount*(1-$tva));
            $priceAmount = number_format($priceAmount, 2);
            $output .= '<tr><td>'.$value['title'].'</td><td>'.$amount.'</td><td>'.$value['logistic_qnt'].'</td><td class="priceColumn"> '.$priceAmount.'</td></tr>';

        }
        
        $output.= '<tfoot>'
                    . '<tr class="tableImportant"><td colspan="3"><strong>TVA</strong></td><td class="priceColumn"><strong>'.(100*$tva).'%</strong></td></tr>'
                    . '<tr class="tableImportant"><td colspan="3"><strong>Total</strong></td><td class="priceColumn"><strong>'.$total.'</strong></td></tr>'
                . '</tfoot></table></div>';
    }

echo $output;

require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/footer.php'); ?>