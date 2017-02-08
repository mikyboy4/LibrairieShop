<?php 
if (!defined('INCLUDE_CHECK')) {
    http_response_code(404); die;
}
//  Définition de l'affichage du panier
    $output =  '<div id="cart" class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                    <div class="list-group">
                        <span class="list-group-item active"><h3>Mon panier</h3></span>';

    if(isset($cartBookList)){
        $total = array();
        foreach($cartBookList as $key => $value){
            
//  Détermine la quantité d'un produit grâce à son id
            foreach($cart as $v){
                if($value['id'] === $v['id']){
                    $amount = floatval($v['amount']);
                    $id = $v['id'];
                }
            }

//  Met le prix au type flotant et le format à deux chiffre après la virgule
            $price = floatval($value['price']);
            $price = number_format($price, 2);
            $output .= '<span class="list-group-item">
                      '.$value['title'].'<br><i>Quantité: '.$amount.'</i><br>
                      <b class="pull-left">CHF '.$price.'</b><br>
                      <span class="pull-right">
                      <button onclick="remove('.$value['id'].')"><i class="fa fa-trash-o"></i></button>
                      <button onclick="increase('.$value['id'].')"><i class="fa fa-plus"></i></button>
                      <button onclick="decrease('.$value['id'].')"><i class="fa fa-minus"></i></button>
                      </span><br>
                  </span>';

//  Additionne au prix total
            $priceAmount = $amount * $price;
            $total[] = $priceAmount;
        }
        
//  Affiche le prix total
        $output.= '      <span class="list-group-item">
                    <strong>Total : CHF '.number_format(array_sum($total), 2).'</strong>
                    </span>
                    <span class="list-group-item">
                        <a href="checkout.php" class="btn btn-primary">Payer</a>
                    </span>';

//  Affiche panier vide
    }else{
        $output .=  '<span class="list-group-item">
                        <strong>Panier vide</strong>
                    </span>';
    }
    $output.= '</div></div>';
    echo $output;
?>