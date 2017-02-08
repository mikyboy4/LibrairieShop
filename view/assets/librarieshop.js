//Jquery Validate
$.validate({
	lang: 'fr',
	form : '#modif_book'
});

$.validate({
	lang: 'fr',
	form : '#new_book'
});

$.validate({
	lang: 'fr',
	form : '#new_comment'
});

$.validate({
	lang: 'fr',
	form : '#my_account'
});

$.validate({
	lang: 'fr',
	form : '#new_user'
});

$( document ).ready(function() {
});

//Initialize FooTable
jQuery(function($){
	$('.table').footable();
});

//Cart functions
function add (id){
	$('#cart').load('cart.php?action=0&id='+id, function() {
		
	});
}
function remove (id){
	$('#cart').load('cart.php?action=1&id='+id, function() {
		
	});
}
function increase (id){
	$('#cart').load('cart.php?action=2&id='+id, function() {
		
	});
}
function decrease (id){
	$('#cart').load('cart.php?action=3&id='+id, function() {
		
	});
}
function trash (){
	$('#cart').load('cart.php?action=4&id=0', function() {
		
	});
}


var k = [38, 38, 40, 40, 37, 39, 37, 39, 66, 65];
n = 0;
$(document).keydown(function (e) {
    if (e.keyCode === k[n++]) {
        if (n === k.length) {
            $("#konami").append( "<p class=\"alert alert-success\">Monsieur Rogeiro, donnez moi un 6 et vous n'avez rien à payer!</p>" ); // à remplacer par votre code
            $("#price").html("Total: 00.00 CHF");
            $("#payer").attr("href","checkout.php?konami=1");
            n = 0;
            return false;
        }
    }
    else {
        n = 0;
    }
});