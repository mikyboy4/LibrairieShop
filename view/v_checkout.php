<?php 
    if (!defined('INCLUDE_CHECK')) {
        http_response_code(404); die;
    }

    $output =  '<div id="cart" class="center col-xs-12 col-sm-12 col-md-offset-2 col-lg-offset-2 col-md-8 col-lg-8">
                    <div class="list-group"><div><h2>Validation de la commande</h2>';
    
//  Informations
    $output.= '<p><strong>Adresse de livraison :</strong></p><p>'.$_SESSION['name'].' '.strtoupper($_SESSION['surname']).'<br>'.$_SESSION['adress'].'<br>'.$_SESSION['npa'].' '.$_SESSION['city'].'</p>';
    $output.= '<p><strong>Date de livraison estimée :</strong></p><p>'.$date->format('d.m.Y').'</p></div>';
    if($stock == 0){
        $output.= '<p class="alert alert-danger">Attention nous n\'avons pas assez d\'articles en stock pour répondre à votre commande. La date de livraison risque d\'être plus longue que prévue</p>';
    }
  
//  Order
    $output.=           '<table class="table table-hover">'
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
                . '</tfoot>';

    }else{
        $output .='<strong>Panier vide</strong>';
    }
    $output.= '</tbody></table><a style="float:right;" class="btn btn-large btn-primary" href="new_order.php">Valider la commande</a></div></div>';
    echo $output;

require_once ($_SERVER['DOCUMENT_ROOT'] . '/view/templates/footer.php'); 
?>
