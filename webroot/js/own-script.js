(function($) {

	"use strict";

    //$("#myModal").modal();
    var UrlToAddMember = $("#linkToAddMember").html();
    var UrlToLogin = $("#linkToLogin").html();
    var UrlToEspacePerso = $("#linkToEspPerso").html();
    var linkToProductList = $("#linkToProductList").html();
    var linkToProductRelated = $("#linkToProductRelated").html();
    var linkToAddToCart = $("#linkToAddToCart").html();
    var linkToUpdateToCart = $("#linkToUpdateToCart").html();
    var linkToDeleteToCart = $("#linkToDeleteToCart").html();




    console.log(screen.width);
    console.log($(window).width());
    if($(window).width() <= 500){
        $('.slide-element').remove();
    }
    if($(window).width() > 500){
        $('.slide-element-responsive').remove();
    }
    // window.onresize = function(event) {
    //     var element = $('.slide-element');
    //     console.log(element);
    //     if(screen.width <= 500 && (element !== 'undifined' || element==Null) ){
    //         $('.slide-element').remove();
    //     }
    // };
    //$("#resultPaymentDisplay").modal();

   


    /*------------------------------------------
        = LOGIN MODAL FORM
    -------------------------------------------*/  

    // $("#loginButton").on('click', function(e){
    //     e.preventDefault();
    //     $("#loginModal").modal();
    // });
    // console.log($("#loginButton"));

    var $formLogin = $('#login-form');
    var $formLost = $('#lost-form');
    var $formRegister = $('#register-form');
    var $divForms = $('#div-forms');
    var $modalAnimateTime = 300;
    var $msgAnimateTime = 150;
    var $msgShowTime = 2000;

    $('#create-account-btn').on('click', function() {
        //console.log('create');
        $('#login-form').hide();
        $('#register-form').show();
        //modalAnimate($formLogin, $formRegister);
    });

    $('#errorRegisterForm').on('click', '.close', function() {
        console.log('svdf');
        $('#errorRegisterForm .alert-danger').hide();
        //modalAnimate($formLogin, $formRegister);
    });

    $("form").on('submit',function (e) {
        switch(this.id) {
            case "login-form":
                e.preventDefault();
                // var $lg_username=$('#login_username').val();
                // var $lg_password=$('#login_password').val();
                // if ($lg_username == "ERROR") {
                //     msgChange($('#div-login-msg'), $('#icon-login-msg'), $('#text-login-msg'), "error", "", "Login error");
                // } else {
                //     msgChange($('#div-login-msg'), $('#icon-login-msg'), $('#text-login-msg'), "success", "", "Login OK");
                // }
                //console.log($(this).serialize());
                $("#login-button-valide").val("Patientez...");
                console.log($("#login-button-valide"));
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: UrlToLogin,
                    data: $(this).serialize(),
                    success: function (data, textStatus, jqXHR) {
                       console.log(data);
                       //window.location.replace(UrlToEspacePerso);
                       location.reload(true);
                    },
                    error: function(jqXHR) {
                      $('#errorLoginForm').prepend(jqXHR.responseJSON['error_html']);
                      $("#login-button-valide").val("Patientez...");
                      //$('#errorLoginForm').prepend(jqXHR.responseText);
                      console.log(jqXHR);
                      //console.log(data);
                    }
                });
                return false;
                break;
            case "lost-form":
                var $ls_email=$('#lost_email').val();
                if ($ls_email == "ERROR") {
                    msgChange($('#div-lost-msg'), $('#icon-lost-msg'), $('#text-lost-msg'), "error", "glyphicon-remove", "Send error");
                } else {
                    msgChange($('#div-lost-msg'), $('#icon-lost-msg'), $('#text-lost-msg'), "success", "glyphicon-ok", "Send OK");
                }
                return false;
                break;
            case "register-form":
                var $rg_username=$('#register_username').val();
                var $rg_name=$('#register_name').val();
                register_name
                var $rg_email=$('#register_email').val();
                var $rg_password=$('#register_password').val();
                //console.log($(this).serialize());
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: UrlToAddMember,
                    data: $(this).serialize(),
                    success: function (data, textStatus, jqXHR) {
                       console.log(data);
                       //window.location.replace(UrlToEspacePerso);
                       location.reload(true);
                    },
                    error: function(jqXHR) {
                      
                      //$("#login-button-valide").val("Patientez...");
                      //$('#errorRegisterForm').html(jqXHR.responseJSON['error_html']);
                      console.log(jqXHR.responseJSON);
                      $('#errorRegisterForm').html('');
                      $('#errorRegisterForm').prepend(jqXHR.responseJSON['error_html']);
                      if(jqXHR.responseJSON['field_error'] !== 'none'){
                        var field_error = jqXHR.responseJSON['field_error'];
                        $( "input[name='"+field_error+"']" ).addClass('input-error');
                      }
                      
                      //console.log(data);
                    }
                });
                // if ($rg_username == "ERROR") {
                //     msgChange($('#div-register-msg'), $('#icon-register-msg'), $('#text-register-msg'), "error", "glyphicon-remove", "Register error");
                // } else {
                //     msgChange($('#div-register-msg'), $('#icon-register-msg'), $('#text-register-msg'), "success", "glyphicon-ok", "Register OK");
                // }
                return false;
                break;
            default:
                return false;
        }
        return false;
    });
    
    $('#login_register_btn').click( function () { modalAnimate($formLogin, $formRegister) });
    $('#register_login_btn').click( function () { modalAnimate($formRegister, $formLogin); });
    $('#login_lost_btn').click( function () { modalAnimate($formLogin, $formLost); });
    $('#lost_login_btn').click( function () { modalAnimate($formLost, $formLogin); });
    $('#lost_register_btn').click( function () { modalAnimate($formLost, $formRegister); });
    $('#register_lost_btn').click( function () { modalAnimate($formRegister, $formLost); });


    
    function modalAnimate ($oldForm, $newForm) {
        var $oldH = $oldForm.height();
        var $newH = $newForm.height();
        $divForms.css("height",$oldH);
        $oldForm.fadeToggle($modalAnimateTime, function(){
            $divForms.animate({height: $newH}, $modalAnimateTime, function(){
                $newForm.fadeToggle($modalAnimateTime);
            });
        });
    }
    
    function msgFade ($msgId, $msgText) {
        $msgId.fadeOut($msgAnimateTime, function() {
            $(this).text($msgText).fadeIn($msgAnimateTime);
        });
    }
    
    function msgChange($divTag, $iconTag, $textTag, $divClass, $iconClass, $msgText) {
        var $msgOld = $divTag.text();
        msgFade($textTag, $msgText);
        $divTag.addClass($divClass);
        $iconTag.removeClass("glyphicon-chevron-right");
        $iconTag.addClass($iconClass + " " + $divClass);
        setTimeout(function() {
            msgFade($textTag, $msgOld);
            $divTag.removeClass($divClass);
            $iconTag.addClass("");
            $iconTag.removeClass($iconClass + " " + $divClass);
        }, $msgShowTime);
    }


//Affichage produits
// var productDataFound = $('#list_produits').attr('product-data-found'); // nombre darticles affiché
// var productDataTotal = $('#list_produits').attr('product-data-total'); // nombre article affichés

//var productDataTotal = $('#list_produits').attr('product-data-total');


//experience
function dataload(){

    var wrapProd = document.getElementById('list_produits');
    //console.log(wrapProd);
    if(wrapProd==null || wrapProd===false){

    }else{
        var productDataIsDisplay = $('#list_produits').attr('product-data-display'); // est ce que la div produits a des produits affichés ?
        var contentHeightProd = wrapProd.offsetHeight;
        var yOffset = window.pageYOffset;
        var y = yOffset + window.innerHeight;

        //console.log("hauteur page : "+yOffset);
        // console.log("hauteur page Inner : "+y);
        //console.log("Hauteur list_produits : "+contentHeightProd);
        //console.log(wrapProd.getClientRects());
        if(yOffset>=wrapProd.getBoundingClientRect().y && productDataIsDisplay=="false"){
            console.log("OK");
            search_products();
        }
    }
      
}

dataload();

window.onscroll = dataload;

$('.commerce-ordering select').on('change', function (e) {
    var optionSelected = $("option:selected", this);
    var valueSelected = this.value;
    console.log(valueSelected);
    $('#list_produits').attr('product-data-order', valueSelected);
    search_products();
    console.log($('.pagination'));
});

//console.log($('.pagination a .page-numbers'));
$('.pagination ').on('click', '.page-numbers', function (e) {
    e.preventDefault();
    var numero = $(this).attr('numero');
    console.log(numero);
    $('#list_produits').attr('product-data-number-page', numero);
    search_products();
    //return false;
});

var productsRelatedContainer = document.getElementById('products-related-container');

if(productsRelatedContainer!=null && productsRelatedContainer!==false){
    //console.log(productsRelatedContainer);
    
    var productRelatedDisplay = $('#products-related-container').attr('product-display');
    if(productRelatedDisplay=="false"){
            console.log("OK");
            search_products_related();
    }

 /*   
A revoir
 function load_detail(){
        var detailYOffset = window.pageYOffset;
        var productRelatedDisplay_one = $('#products-related-container').attr('product-display');
        if(productsRelatedContainer.getBoundingClientRect().y <= detailYOffset){
            if(productRelatedDisplay_one=="false"){
                console.log(productRelatedDisplay);
                console.log(productsRelatedContainer.getBoundingClientRect().y);

            }
        }
    }

    window.onscroll = load_detail;
    */
    
}

//console.log(document.readyState);

/*Ajout au panier*/
$('.add-to-cart-btn').on('click', function(e){
    e.preventDefault();
    var tokenProduit = $(this).attr('id-product');
    //console.log(tokenProduit);
    add_to_cart(tokenProduit,1);
    return false;
});

$('#list_produits ').on('click','.add-to-cart-btn', function(e){
    e.preventDefault();
    var tokenProduit = $(this).attr('id-product');
    //console.log(tokenProduit);
    add_to_cart(tokenProduit,1);
    return false;
});

$('#products-related-container ').on('click','.add-to-cart-btn', function(e){
    e.preventDefault();
    var tokenProduit = $(this).attr('id-product');
    //console.log(tokenProduit);
    add_to_cart(tokenProduit,1);
    return false;
});

// $('.quantity').on('click', '.qty-plus', function(e){
//     e.preventDefault();
//     var inputQuantity = $('.quantite-product-detail').attr('value');
//     parseInt(inputQuantity);
//     console.log( $('.quantite-product-detail').val() );
//     console.log( $('.quantite-product-detail') );
// });



//page product detail ajout au panier
$("#produit-detail-form").on('submit', function(e){
    e.preventDefault();
    var tokenProduit = $('.token-product-detail').attr('value');
    var nbreProduit = $('.quantite-product-detail').val();
    console.log( tokenProduit );
    console.log( nbreProduit );

    add_to_cart(tokenProduit,nbreProduit); 

    return false;
});

//MODIFICATION DE PANIER
$("#cart-content-panier").on('submit',function(e){
    e.preventDefault();
    //console.log(linkToUpdateToCart);
    update_cart($(this).serialize());
    
    //console.log(linkToUpdateToCart);
    return false;
});

//SUPPRIMER PRODUIT DE PANIER
$('.table').on('click', '.remove-product-cart', function(e){ // j'ai essayer avec un id sur un form mais ça pas marché, l'element n'etait pas retrouvé
    e.preventDefault();
    var tokenProduit = $(this).attr('id-product');
    //console.log(tokenProduit);
     Swal({
      title: 'Êtes vous sure ?',
      text: 'Voulez vous retirer ce produit de votre panier ?',
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#2ecc71',
      cancelButtonColor: '#d33',
      confirmButtonText: 'OK',
      cancelButtonText: 'Annuler'
    }).then((result) => {
      if (result.value) {
        delete_to_cart(tokenProduit,"panier");
      }
    });
    return false;
});

//SUPPRIMER PRODUIT DE PANIER depuis le recap panier dans lentete

$('.widget-shopping-cart-content').on('click', '.remove-product-cart', function(e){ // j'ai essayer avec un id sur un form mais ça pas marché, l'element n'etait pas retrouvé
    e.preventDefault();
    var tokenProduit = $(this).attr('id-product');
    //console.log(tokenProduit);
     Swal({
      title: 'Êtes vous sure ?',
      text: 'Voulez vous retirer ce produit de votre panier ?',
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#2ecc71',
      cancelButtonColor: '#d33',
      confirmButtonText: 'OK',
      cancelButtonText: 'Annuler'
    }).then((result) => {
      if (result.value) {
        
        var view = "header-panier";
        if (document.querySelector('#cart-content-panier') !== null) { // verifie si on est pas sur la page de panier
            console.log( $('#cart-content-panier') );
            view = "panier";
        }
        delete_to_cart(tokenProduit,view);
      }
    });
    return false;
});

//Shipping
$('#select-shipping-destination').on( 'change', function(){
    console.log( $('#select-shipping-destination .'+this.value).attr('shipping-amount') );
    var amount = $('#select-shipping-destination .'+this.value).attr('shipping-amount');

    $('#frais-livraison').attr('montant-livraison',amount);
    $('#frais-livraison').html(amount+' F');

    var shipping_fees = parseInt( $('#frais-livraison').attr('montant-livraison') );
    var sous_total_cart = parseInt( $('#sous-total-vue-panier').attr('sous-total-cart') );
    var total_amount_cart = parseInt(sous_total_cart) + shipping_fees;
    $('#total-vue-panier').html(total_amount_cart+' F'); ////modifier le total montant du panier

});

/*Function de suppression de produit du panier*/
function delete_to_cart(tokenProduit,vue="header-panier"){
    console.log('Oui je veux suprimer ' + tokenProduit);
    $.ajax({
        type: "POST",
        dataType: "json",
        url: linkToDeleteToCart,
        data: {tokenProduit:tokenProduit},
        success: function (data, textStatus, jqXHR) {
           console.log(data);
           if(data.error === 'non'){
            //console.log(data.error_text);
                $('.mini-cart-icon').attr('data-count', data.cart.total_nbre);
                $('.mini-cart-total').html(data.cart.total_amount+' F');
                $('.widget-shopping-cart-content .total .amount').html(data.cart.total_amount+' F');

                Swal({
                  title: data.error_text,
                  text: data.error_text_second,
                  type: 'success',
                  showCancelButton: false,
                  confirmButtonColor: '#2ecc71',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'OK'
                }).then((result) => {
                  if (result.value) {
                    // verifier si le panier est vide et actualiser la page
                    if(data.cart.IsEmpty === true){
                        location.reload(true); //actualiser la page
                    }
                    /////panier page/////
                    if(vue === "panier"){
                        $('.table .'+tokenProduit).fadeOut(500, function() {  //suppression de la ligne produit
                            if( $(this).hasClass('cart-item-info-responsive') ){
                                $(this).removeClass('cart-item-info-responsive'); //supprimer la classe pour la ligne responsivité
                            }
                            $(this).remove(); //suppression de la ligne produit
                        });
                        
                        $('#sous-total-vue-panier').html(data.cart.total_amount+' F'); //modifier le sous total du panier
                        
                        var shipping_fees = parseInt( $('#frais-livraison').attr('montant-livraison') );
                        var total_amount_cart = parseInt(data.cart.total_amount) + shipping_fees;
                        $('#total-vue-panier').html(total_amount_cart+' F'); ////modifier le total montant du panier
                    }
                    /////panier entete////
                    // supprimer (ou cacher) la ligne du produit
                    $('.widget-shopping-cart-content .'+tokenProduit).fadeOut(500, function() {  //suppression de la ligne produit
                            $(this).remove(); //suppression de la ligne produit
                    }); 

                  }
                });

           }           
           //$('#products-related-container').html(data.produits_liste_html).fadeIn(500); 
        },
        error: function(jqXHR) {
          console.log(jqXHR.responseText);
          //console.log(jqXHR.responseJSON);
          if(jqXHR.responseJSON.error === 'oui'){
                Swal({
                  type: 'error',
                  title: jqXHR.responseJSON.error_text,
                  text: jqXHR.responseJSON.error_text_second
                });
          }

        }

    });
}


/* Fonction modification de panier */
function update_cart(products){ // $products est le seriliaze d'un formulaire
    console.log(products);
    $.ajax({
        type: "POST",
        dataType: "json",
        url: linkToUpdateToCart,
        data: products,
        success: function (data, textStatus, jqXHR) {
           
           if(data.error === 'non'){
            //console.log(data.error_text);
                Swal({
                  title: data.error_text,
                  text: data.error_text_second,
                  type: 'success',
                  showCancelButton: false,
                  confirmButtonColor: '#2ecc71',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'OK'
                }).then((result) => {
                  if (result.value) {
                    location.reload(true);
                  }
                });
           }           
           //$('#products-related-container').html(data.produits_liste_html).fadeIn(500); 
        },
        error: function(jqXHR) {
          console.log(jqXHR.responseText);
          //console.log(jqXHR.responseJSON);
          if(jqXHR.responseJSON.error === 'oui'){
                Swal({
                  type: 'error',
                  title: jqXHR.responseJSON.error_text,
                  text: jqXHR.responseJSON.error_text_second
                });
          }
        }
    });

}

/*Fonction d'ajout au panier*/
function add_to_cart(tokenProduit,nbreProduit){
    console.log(tokenProduit+" "+ nbreProduit);
    $.ajax({
        type: "POST",
        dataType: "json",
        url: linkToAddToCart,
        data: {tokenProduit:tokenProduit,nbreProduit:nbreProduit},
        success: function (data, textStatus, jqXHR) {
           console.log(data.cart);
           if(data.cart.IsEmpty === true){ // Verifie si le panier est vide et initialise son contenu
                $('.cart-list ').html('');
           }
           
           if(data.cart.product.isNewInCart === true){
            var newProductCart_html = '<li class="'+data.cart.product.token+'" id-product="'+data.cart.product.token+'"><a href="#" class="remove">×</a>';
                    newProductCart_html +=' <a href="'+data.cart.product.link_to_details+'">';
                        newProductCart_html +=' <img src="'+data.cart.product.link_to_image+'" alt="" /> '+data.cart.product.nom+' &nbsp;';
                    newProductCart_html +=' </a>';
                    newProductCart_html +=' <span class="quantity"><span class="nbre-cart-product">'+data.cart.product.qtite_cart+'</span> x <span class="amount-cart-product">'+data.cart.product.prix_qtite_unit+'</span> F</span>';
                newProductCart_html +=' </li>';
                //console.log(newProductCart_html);
                $('.cart-list ').prepend(newProductCart_html);
           }else{
                //console.log("ancien produit");
                //console.log($('.'+data.cart.product.token+' .quantity .nbre-cart-product').html());
                $('.'+data.cart.product.token+' .quantity .nbre-cart-product').html(data.cart.product.qtite_cart);
           }

           $('.mini-cart-icon').attr('data-count', data.cart.total_nbre);
           $('.mini-cart-total').html(data.cart.total_amount+' F');
           $('.widget-shopping-cart-content .total .amount').html(data.cart.total_amount+' F');

           if(data.error === 'non'){
            //console.log(data.error_text);
            //location.reload(true);
                Swal({
                  title: data.error_text,
                  text: data.error_text_second,
                  type: 'success',
                  showCancelButton: false,
                  confirmButtonColor: '#2ecc71',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'OK'
                }).then((result) => {
                  if (result.value) {
                    //location.reload(true);
                  }
                });
           }
           
           //$('#products-related-container').html(data.produits_liste_html).fadeIn(500); 
        },
        error: function(jqXHR) {
          //console.log(jqXHR.responseText);
          console.log(jqXHR.responseText);
          if(jqXHR.responseJSON.error === 'oui'){
                Swal({
                  type: 'error',
                  title: jqXHR.responseJSON.error_text,
                  text: jqXHR.responseJSON.error_text_second
                });
          }

        }
    });
}

/* Fonction de recuperation de produit relatif a un produit particulier*/
function search_products_related(){

    var productDataCategory = $('#products-related-container').attr('product-data-category'); // filtre category

    $.ajax({
        type: "POST",
        dataType: "json",
        url: linkToProductRelated,
        data: {productDataCategory:productDataCategory},
        success: function (data, textStatus, jqXHR) {
           //console.log(data);
           if(data.productDataDisplay==true){
                $('#products-related-container').attr('product-display','true');
           }
           $('#products-related-container').html(data.produits_liste_html).fadeIn(500);
           
        },
        error: function(jqXHR) {
          //console.log(jqXHR.responseText);
          //alert('<div>'+jqXHR.responseText+'</div>');
          console.log(jqXHR);
        }
    });
}


function search_products(){

    var productDataSearch = $('#list_produits').attr('product-data-search'); // critere de recherce
    var productDataCategory = $('#list_produits').attr('product-data-category'); // filtre category
    var productDataNumberPage= $('#list_produits').attr('product-data-number-page'); //numero de la page courante
    var productDataOrder= $('#list_produits').attr('product-data-order'); // ordonnancement du plus... au moins...

    $.ajax({
        type: "POST",
        dataType: "json",
        url: linkToProductList,
        data: {productDataSearch:productDataSearch,productDataCategory:productDataCategory,productDataNumberPage:productDataNumberPage,productDataOrder:productDataOrder},
        success: function (data, textStatus, jqXHR) {
           // console.log(data);
           if(data.productDataDisplay==true){
                $('#list_produits').attr('product-data-display','true');
                $('#list_produits').attr('product-data-search', data.productDataSearch);
                $('#list_produits').attr('product-data-category', data.productDataCategory);
                $('#list_produits').attr('product-data-number-page', data.productDataNumberPage);
                $('#list_produits').attr('product-data-order', data.productDataOrder);
                //productDataIsDisplay='true';
                
                $('.pagination').html(data.pagination_html).fadeIn(50);
           }
           $('#list_produits').html(data.produits_liste_html).fadeIn(500);
           //
           //window.location.replace(UrlToEspacePerso);
           //location.reload(true);
        },
        error: function(jqXHR) {
          // $('#errorLoginForm').prepend(jqXHR.responseJSON['error_html']);
          // $("#login-button-valide").val("Patientez...");
          //$('#list_produits').prepend(jqXHR.responseText);
          console.log(jqXHR.responseText);
          //console.log(data);
        }
    });
}

// for (var product in data.cart.products_list) {
           //      if (data.cart.products_list.hasOwnProperty(product)) {
           //          //console.log(product);
           //      }
           //  }

           //  Object.keys(data.cart.products_list).forEach(function(key) {
           //      console.log(data.cart.products_list[key].nom);
           //  });

})(window.jQuery);
