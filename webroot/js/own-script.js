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
    var linkToAddMessage = $("#linkToAddMessage").html();
    var linkToShippingDest = $("#linkToShippingDest").html();
    var linkToOrder = $("#linkToOrder").html();
    var linkToQuickOrder = $("#linkToQuickOrder").html();
    var linkToUpdateInfosUser = $("#linkToUpdateInfosUser").html();
    var linkToUpdatePassword = $("#linkToUpdatePassword").html();
    var linkToCancelledOrder = $("#linkToCancelledOrder").html();

    /** QUICK MENU ORDER HANDLE */

    var fixmeTop = $('.quick-menu-sidebar').offset().top;
    $(window).scroll(function() {
        var currentScroll = $(window).scrollTop();
        // console.log(currentScroll);

        if (currentScroll >= 89) {
          // console.log(currentScroll);
            $('.quick-menu-sidebar').css({
                position: 'fixed',
                top: '90'
                // ,left: '0'
            });
        } 
        // else {
        //     $('.quick-menu-sidebar').css({
        //         position: 'static'
        //     });
        // }
    });

    $('.quick-menu-sidebar').on('click', '.quick-menu-sidebarBtn', function() {        
        
        if( $('.quick-menu-sidebarBtn-icon i').hasClass('fa-cart-plus') ){
          $('.quick-menu-sidebarBtn-icon').append('<i class="fa fa-times-circle"></i>');
          $('.quick-menu-sidebarBtn-icon i.fa-cart-plus').remove();
        }else{
          $('.quick-menu-sidebarBtn-icon').append('<i class="fa fa-cart-plus"></i>');
          $('.quick-menu-sidebarBtn-icon i.fa-times-circle').remove();
        }

        $('.quick-menu-sidebar').toggleClass('quick-menu-sidebar-active');

    });

    //SUPPRIMER PRODUIT DE PANIER
    $('.quick-menu-sidebar-form').on('submit', function(e){ 
      e.preventDefault();
      // var self = $(this).serialize();
      var form = $('.quick-menu-sidebar-form')[0]; // You need to use standard javascript object here
      var formData = new FormData(form);
      console.log($(this).serialize());
      Swal({
        title: 'Confirmation !',
        text: 'Confirmez vous votre commande ?',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#2ecc71',
        cancelButtonColor: '#d33',
        confirmButtonText: 'OK',
        cancelButtonText: 'Annuler'
      }).then((result) => {
        if (result.value) {
          place_quick_order(formData);
        }
      });
      return false;
    });

    /*** END MENU ORDER HANDLE */
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

    $('#dropdown-user').click(function(){
        $('.header-mobile-menu').toggleClass('extend'); //
        // setTimeout(function() {
        //   $('#user-sub-menu').toggleClass('sub-menu-close');//your code to be executed after 1 second
        // }, 500);
        $('#user-sub-menu').toggleClass('sub-menu-close'); //
    });
   


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

    $('#create-account-btn-web').on('click', function() {
        //console.log('create');
        $('#menu-slideout').removeClass( "open" );
        $('.site').removeClass( "open" );

        $('#login-form').hide();
        $('#register-form').show();
        //modalAnimate($formLogin, $formRegister);
    });

    $('#create-account-btn').on('click', function() {
        //console.log('create');
        $('#menu-slideout').removeClass( "open" );
        $('.site').removeClass( "open" );

        $('#login-form').hide();
        $('#register-form').show();
        //modalAnimate($formLogin, $formRegister);
    });

    $('#login-btn-web').on('click', function() {
        $('#menu-slideout').removeClass( "open" );
        $('.site').removeClass( "open" );
        $('#login-form').show();
        $('#register-form').hide();
    });

    $('#login-btn').on('click', function() {
      $('#menu-slideout').removeClass( "open" );
      $('.site').removeClass( "open" );
      $('#login-form').show();
      $('#register-form').hide();
  });

    $('#errorRegisterForm').on('click', '.close', function() {
        // console.log('svdf');
        $('#errorRegisterForm .alert-danger').hide();
        //modalAnimate($formLogin, $formRegister);
    });

    $(".search_product_form").on('submit', function(e){
        e.preventDefault();
        var url_process = $('#RooTlinkToSearch').html();
        var element = $(".search_product_form input[name='element']").val();
        element = element.replace(' ','-');
        console.log(url_process+element);
        // window.location(url_process+element);
        window.location.replace(url_process+element);
        return false;
    });

    $(".form-search-product-list").on('submit', function(e){
        e.preventDefault();
        // var url_process = $('#RooTlinkToSearch').html();
        var element = $(".form-search-product-list input[name='element']").val();
        element = element.replace(' ','-');
        $('#list_produits').attr('product-data-search', element);
        search_products();
        return false;
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
// function dataload(){
//     var wrapProd = document.getElementById('list_produits');
//     if(wrapProd==null || wrapProd===false){
//     }else{
//         var productDataIsDisplay = $('#list_produits').attr('product-data-display'); // est ce que la div produits a des produits affichés ?
//         var contentHeightProd = wrapProd.offsetHeight;
//         var yOffset = window.pageYOffset;
//         var y = yOffset + window.innerHeight;
//         if(yOffset>=wrapProd.getBoundingClientRect().y && productDataIsDisplay=="false"){
//             console.log("OK");
//             // search_products();
//         }
//     }     
// }
// dataload();
// window.onscroll = dataload;

var readyStateCheckInterval = setInterval(function() {
  if (document.readyState === "complete") {
      clearInterval(readyStateCheckInterval);
      var productDataIsDisplay = $('#list_produits').attr('product-data-display');
      if( productDataIsDisplay=="false" ){
          // console.log("OK");
          search_products();
      }
  }
}, 1000);


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



// var productsRelatedContainer = document.getElementById('products-related-container');

// console.log( $(".products-related-container").attr('product-display') );
if($(".products-related-container").attr('product-display') !== 'undefined' ){
    //console.log(productsRelatedContainer);
    // console.log( $(".products-related-container").attr('product-display') );
    var productRelatedDisplay = $('.products-related-container').attr('product-display');
    if(productRelatedDisplay=="false"){
            console.log("OK");
            search_products_related();
    }

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


//page product detail ajout au panier
$("#produit-detail-form").on('submit', function(e){
    e.preventDefault();
    var tokenProduit = $('.token-product-detail').attr('value');
    var nbreProduit = $('.quantite-product-detail').val();
    // console.log( tokenProduit );
    // console.log( nbreProduit );

    add_to_cart(tokenProduit,nbreProduit); 

    return false;
});

//POST COMMENT IN PRODUCT DETAIL
$(".comment-form").on('submit', function(e){
    
    e.preventDefault();
    var self = $(this);
    var url_process = $('#linkToWebroot').html()+$('#linkToAddElement').html();
    // console.log(url_process);
    $(this).find("#confirm_btn").addClass('disabled');
    $(this).find("#confirm_btn").addClass('running');
    var post_data = $(this).serialize();
    add_element_default( post_data, self, url_process );

    return false;
});

function add_element_default( add_data, self, url_process ){
        $.ajax({
            type: "POST",
            dataType: "json",
            url: url_process,
            data: add_data,
            success: function (data, textStatus, jqXHR) {
                self.find("#confirm_btn").removeClass('disabled');
                self.find("#confirm_btn").removeClass('running');
                // self[0].reset();
                // console.log(data);
                Swal({
                  title: data.error_text,
                  text: data.error_text_second,
                  type: 'success',
                  showCancelButton: false,
                  confirmButtonColor: '#0aa89e',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'OK'
                }).then((result) => {
                  if (result.value) {
                    location.reload(true);
                  }
                });
            },
            error: function(jqXHR) {
                // console.log(jqXHR.responseText);
                self.find("#confirm_btn").removeClass('disabled');
                self.find("#confirm_btn").removeClass('running'); 
                // $('#errorForm').prepend(jqXHR.responseJSON['error_html']);
                if( typeof jqXHR.responseJSON['error_html'] !== 'undefined' ){
                    $('#errorForm').prepend(jqXHR.responseJSON['error_html']);
                }
            }
        });
    }

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
    // console.log( $('#select-shipping-destination .'+this.value).attr('shipping-amount') );
    // var amount = $('#select-shipping-destination .'+this.value).attr('shipping-amount');

    // $('#frais-livraison').attr('montant-livraison',amount);
    // $('#frais-livraison').html(amount+' F');

    // var shipping_fees = parseInt( $('#frais-livraison').attr('montant-livraison') );
    // var sous_total_cart = parseInt( $('#sous-total-vue-panier').attr('sous-total-cart') );
    // var total_amount_cart = parseInt(sous_total_cart) + shipping_fees;
    // $('#total-vue-panier').html(total_amount_cart+' F CFA'); ////modifier le total montant du panier

    var Token = this.value;
    // console.log(Token);
    set_shipping_destination(Token); // parametre les frais de livraison et la destination dans la session

});


//ENVOYER MESSAGE CONTACT
$(".contact-form").on('submit', function(e){
    e.preventDefault();
    var form_contact_data = $(this).serialize();
    // console.log(form_contact_data);
    sendMessages(form_contact_data);
    return false;
});

//Valider la commande
$(".checkout-payment").on('click', '#commandeur-btn', function(e){
    e.preventDefault();
    //console.log($('#shipping-form').serialize());
    
    var error = false;
    $('#shipping-form input, #shipping-form select, #shipping-form textarea').each(function(){
        //console.log(this.name+' = '+this.value);
        if( this.name != 'email' && this.name != 'description_lieu_livraison' && this.value == '' && this.name != 'loc_lat' && this.name != 'loc_long'){
            if(this.name !== '' && this.value == ''){
                var HtmlError ='<div class="col-sm-12 alert alert-danger alert-dismissible " role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>';
                HtmlError += '</button><span class=""> Le champs ' + this.name + ' ne pas être vide.</span></div>';
                // console.log(HtmlError);
                $('.shipping-info .error-text').html(HtmlError);
                error = true;
                return false;
            }            
        }

    });
    if(!error){
        //var amount = $('#select-shipping-destination .'+this.value).attr('shipping-amount');
        var amount_order = parseInt( $('#total-vue-panier').html() );
        $('.order-info .order-amount').html(amount_order+ ' F CFA');

        var shipping_name= $('#shipping-form input[name="nom"]').val()  + ' ' + $('#shipping-form input[name="prenoms"]').val() ;
        var shipping_tel= $('#shipping-form input[name="tel"]').val();
        var shipping_email= $('#shipping-form input[name="email"]').val();
        var shipping_commune= $('#shipping-form select option:selected').text();
        var shipping_quartier= $('#shipping-form input[name="quartier"]').val();
        var shipping_quartier_long= $('#shipping-form input[name="loc_lat"]').val();
        var shipping_quartier_lag= $('#shipping-form input[name="loc_long"]').val();
        var shipping_decript= $('#shipping-form textarea').val();

        $('.shipping-confirmation-details .shipping-name').html(shipping_name);
        $('.shipping-confirmation-details .shipping-tel').html(shipping_tel);
        $('.shipping-confirmation-details .shipping-email').html(shipping_email);
        $('.shipping-confirmation-details .shipping-commune').html(shipping_commune);
        $('.shipping-confirmation-details .shipping-quartier').html(shipping_quartier);

        $('.shipping-confirmation-details .shipping-detail-lieu').html(shipping_decript);

        $('#confirm-order-modal').modal('show');
        // console.log( shipping_decript );
    }
    
});

if( document.getElementById("search_input") ){
  googleMapLibrary("search_input", "loc_long", "loc_lat");
}

if( document.getElementById("search_input_quick_order") ){
  googleMapLibrary("search_input_quick_order", "loc_long_quick_order", "loc_lat_quick_order");
}


function googleMapLibrary(main_field, long_field, lat_field){
  var searchInput = main_field;
		
		var sessionToken = new google.maps.places.AutocompleteSessionToken();
		
		$(document).ready(function () {
			var autocomplete;
			autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
				types: ['geocode','establishment'],
				componentRestrictions: {
					country: "CIV"
				}
			});
			
			google.maps.event.addListener(autocomplete, 'place_changed', function () {
				var near_place = autocomplete.getPlace();
				document.getElementById(lat_field).value = near_place.geometry.location.lat();
				document.getElementById(long_field).value = near_place.geometry.location.lng();
				
				// document.getElementById('latitude_view').innerHTML = near_place.geometry.location.lat();
				// document.getElementById('longitude_view').innerHTML = near_place.geometry.location.lng();
			});
		});
		
		$(document).on('change', '#'+searchInput, function () {
			document.getElementById(long_field).value = '';
			document.getElementById(lat_field).value = '';
			
			// document.getElementById('latitude_view').innerHTML = '';
			// document.getElementById('longitude_view').innerHTML = '';
		});
}

/*click sur bouton confirmation de commande*/
$('#confirm-order-modal').on('click','#confirm-command-btn',function(){
    var shipping_quartier= $('#shipping-form input[name="quartier"]').val();
    var shipping_decript= $('#shipping-form textarea').val();
    //console.log($('#shipping-form').serialize())
    var shipping_form = $('#shipping-form').serialize();
    $('#confirm-order-modal').hide();
    place_order( shipping_form );
});

/*Click pour modifier ses infos persos*/
$('.user-data-info-box-contain').on('click','.user-data-info-action',function(){
    var user_sexe = $('.user-data-info-box-contain span.user-data-info.sexe ').html().trim().toLowerCase();
    var user_name = $('.user-data-info-box-contain span.user-data-info.nom ').html();
    var user_lastname = $('.user-data-info-box-contain span.user-data-info.prenoms ').html();
    var user_tel = $('.user-data-info-box-contain span.user-data-info.tel ').html();
    var user_email = $('.user-data-info-box-contain span.user-data-info.email ').html();
    // console.log( user_sexe+' '+user_tel+' '+user_lastname );

    if(user_sexe === 'homme'){
        $("#opt1").attr('checked', true);
    }else{
        $("#opt2").attr('checked', true);
    }
    $('#modal-update-info-perso #name').val(user_name);
    $('#modal-update-info-perso #lastname').val(user_lastname);
    $('#modal-update-info-perso #tel').val(user_tel);
    $('#modal-update-info-perso #email').val(user_email);

    $('#modal-update-info-perso').modal('show');
});


$('#form-update-info-perso').on('submit',function(e){
    e.preventDefault();
    var form_user_info_data = $(this).serialize();
    // console.log( form_user_info_data );
    update_personnal_infos(form_user_info_data);
});

/*AFFICHER MOT DE PASSE Form modif mot de passe*/
$('#show-password-checbox').on('change',function(e){
    
    var old_password = document.getElementById('old_password');
    var new_password = document.getElementById('new_password');
    var confirm_new_password = document.getElementById('confirm_new_password');
    // console.log( document.getElementById('show-password-checbox').checked );
    if( document.getElementById('show-password-checbox').checked ){
        
        old_password.type="text";
        new_password.type="text";
        confirm_new_password.type="text";
    }else{
        old_password.type="password";
        new_password.type="password";
        confirm_new_password.type="password";
    }
});

/*AFFICHER MOT DE PASSE Form connexion*/
$('#show-password-checbox-login').on('change',function(e){
    var login_password = document.getElementById('login_password');
    //console.log( document.getElementById('show-password-checbox-login').checked );
    if( document.getElementById('show-password-checbox-login').checked ){        
        login_password.type="text";
    }else{
        login_password.type="password";
    }
});

/*MODIFICATION DE MOT DE PASSE*/
$('#form-update-password').on('submit',function(e){
    e.preventDefault();
    var form_update_password = $(this).serialize();
    //update_personnal_infos(form_update_password);
    Swal({
      title: 'Êtes vous sure ?',
      text: 'Vous êtes sur le point de modifier votre mot de passe.',
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#2ecc71',
      cancelButtonColor: '#d33',
      confirmButtonText: 'OK',
      cancelButtonText: 'Annuler'
    }).then((result) => {
      if (result.value) {
        //console.log( form_update_password );
        update_password(form_update_password);
      }
    });
    return false;

});

//Cliquer sur le bouton pour annuler une commande
$('table.list-commands').on('click', '.annuler-commande', function(e){ // j'ai essayer avec un id sur un form mais ça pas marché, l'element n'etait pas retrouvé
    e.preventDefault();
    var self = $(this);
    // console.log(self);
    var tokenCommande = $(this).attr('token-command');
    var html_status_initial = $(this).parent().siblings("td.command-status").html();
    // console.log(tokenCommande);
     Swal({
      title: 'Êtes vous sure ?',
      text: 'Voulez allez annuler cette commande.',
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#2ecc71',
      cancelButtonColor: '#d33',
      confirmButtonText: 'OK',
      cancelButtonText: 'Annuler'
    }).then((result) => {
      if (result.value) {
        cancelled_order(tokenCommande, self);
        //console.log(html_status);
        //console.log( $(this).parent().siblings("td.command-status").html() );
        //$(this).parent().siblings("td.command-status").html( html_status );
      }
    });
    // console.log('OK 2');
    return false;
});

/*Function annulation commande*/
function cancelled_order(token, self){
    
    $.ajax({
        type: "POST",
        dataType: "json",
        url: linkToCancelledOrder,
        data: {tokenCommande:token},
        success: function (data, textStatus, jqXHR) {
          //  console.log(data);       
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
                //return data.error_html; // retourne le html du nouveau statut de la commande
                console.log(self);
                self.parent().siblings("td.command-status").html( data.error_html );
                self.hide();
              }
            });
        },
        error: function(jqXHR) {
          // console.log(jqXHR.responseText);
          //$('.contact-form .error-text').html(jqXHR.responseJSON.error_html);
          if(jqXHR.responseJSON.error === 'oui'){
                //$('#confirm-order-modal').hide();
                Swal({
                  type: 'error',
                  title: jqXHR.responseJSON.error_text,
                  text: jqXHR.responseJSON.error_text_second
                });
                //return html_status_initial;
          }

        }
    });

}

/*Function modification mot de passe*/
function update_password(form_update_password){
    $.ajax({
        type: "POST",
        dataType: "json",
        url: linkToUpdatePassword,
        data: form_update_password,
        success: function (data, textStatus, jqXHR) {
           
          //  console.log(data);
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
           
        },
        error: function(jqXHR) {
          // console.log(jqXHR.responseText);
          $('#form-update-password .error-text').html(jqXHR.responseJSON.error_html);
        }
    });
}

/*Function modification infos personnelles*/
function update_personnal_infos(form_user_info_data){
    $.ajax({
        type: "POST",
        dataType: "json",
        url: linkToUpdateInfosUser,
        data: form_user_info_data,
        success: function (data, textStatus, jqXHR) {
           $('#modal-update-info-perso').modal('hide'); 
          //  console.log(data);
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
           
        },
        error: function(jqXHR) {
          // console.log(jqXHR.responseText);
          $('#form-update-info-perso .error-text').html(jqXHR.responseJSON.error_html);
        }
    });
}


/*Function validation commande RAPIDE ######## A FINALISER #######*/
function place_quick_order(ShippingForm){
    
  $.ajax({
      type: "POST",
      dataType: "json",
      url: linkToQuickOrder,
      data: ShippingForm,
      contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
      processData: false, // NEEDED, DON'T OMIT THIS
      success: function (data, textStatus, jqXHR) {
        //  console.log(data);         
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
      },
      error: function(jqXHR) {
        console.log(jqXHR.responseText);
        //$('.contact-form .error-text').html(jqXHR.responseJSON.error_html);
        if(jqXHR.responseJSON.error){
              Swal({
                type: 'error',
                title: jqXHR.responseJSON.error_text,
                text: jqXHR.responseJSON.error_text_second
              });
        }

      }
  });

}

/*Function validation commande*/
function place_order(ShippingForm){
    
    $.ajax({
        type: "POST",
        dataType: "json",
        url: linkToOrder,
        data: ShippingForm,
        success: function (data, textStatus, jqXHR) {
          //  console.log(data);
           
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
        },
        error: function(jqXHR) {
          console.log(jqXHR.responseText);
          //$('.contact-form .error-text').html(jqXHR.responseJSON.error_html);
          if(jqXHR.responseJSON.error === 'oui'){
                //$('#confirm-order-modal').hide();
                Swal({
                  type: 'error',
                  title: jqXHR.responseJSON.error_text,
                  text: jqXHR.responseJSON.error_text_second
                });

          }

        }
    });

}

/*Function format */
function formatAmount(amount){
    //var number = 15000; //Put your number
    var numstring = amount.toString();

    if(numstring.length > 3){
        var thpos = -3;
        var strgnum = numstring.slice(0, numstring.length+thpos);
        var strgspace = (" " + numstring.slice(thpos));
        numstring = strgnum + strgspace;
    }
    var amountFormated = numstring;
    return amountFormated;
}

/*Fonction parametrage lieu livraison*/
function set_shipping_destination(tokenDestination){
    $.ajax({
        type: "POST",
        dataType: "json",
        url: linkToShippingDest,
        data: {tokenDestination:tokenDestination},
        success: function (data, textStatus, jqXHR) {
          //  console.log(data);
        },
        error: function(jqXHR) {
          // console.log(jqXHR.responseText);
          //$('.contact-form .error-text').html(jqXHR.responseJSON.error_html);
        }
    });
}

/*Fonction d'envoi de messages ou preocupation*/
function sendMessages(formData){
    $.ajax({
        type: "POST",
        dataType: "json",
        url: linkToAddMessage,
        data: formData,
        success: function (data, textStatus, jqXHR) {
           //console.log(data);
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
           
        },
        error: function(jqXHR) {
          // console.log(jqXHR.responseText);
          $('.contact-form .error-text').html(jqXHR.responseJSON.error_html);
        }
    });
}

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

                        $('#frais-livraison').html(data.cart.shipping_dest.frais+' F'); ////modifier le montant des frais sur la vue
                        
                        var shipping_fees = parseInt( $('#frais-livraison').attr('montant-livraison') );
                        var total_amount_cart = parseInt(data.cart.total_amount) + parseInt(data.cart.shipping_dest.frais);
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
          // console.log(jqXHR.responseText);
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
          //  console.log(data.cart);
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

    var productDataCategory = $('.products-related-container').attr('product-data-category'); // filtre category 
    console.log(productDataCategory);

    $.ajax({
        type: "POST",
        dataType: "json",
        url: linkToProductRelated,
        data: {productDataCategory:productDataCategory},
        success: function (data, textStatus, jqXHR) {
           console.log(data);
           if(data.productDataDisplay==true){
                $('.products-related-container').attr('product-display','true');
           }
           $('.products-related-container').html(data.produits_liste_html);
           console.log(data.produits_liste_html);
           var productRelatedContainer = document.querySelector('.products-related-container');
          //  productRelatedContainer.style.opacity = "1";
          //  productRelatedContainer.style.display = "block";
        },
        error: function(jqXHR) {
          //console.log(jqXHR.responseText);
          //alert('<div>'+jqXHR.responseText+'</div>');
          // console.log(jqXHR);
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
          //  console.log(data);
           if(data.productDataDisplay==true){
                $('#list_produits').attr('product-data-display','true');
                $('#list_produits').attr('product-data-search', data.productDataSearch);
                $('#list_produits').attr('product-data-category', data.productDataCategory);
                $('#list_produits').attr('product-data-number-page', data.productDataNumberPage);
                $('#list_produits').attr('product-data-order', data.productDataOrder);

                //productDataIsDisplay='true';
                
                $('.pagination').fadeIn(50).html(data.pagination_html);
           }
           $('#list_produits').fadeIn(500).html(data.produits_liste_html);
           $('.product-nombre-low').html(data.firstElement);
           $('.product-found').html(data.lastElement);
           $('.product-total').html(data.nombreProduits);
           //
           //window.location.replace(UrlToEspacePerso);
           //location.reload(true);
        },
        error: function(jqXHR) {
          // $('#errorLoginForm').prepend(jqXHR.responseJSON['error_html']);
          // $("#login-button-valide").val("Patientez...");
          //$('#list_produits').prepend(jqXHR.responseText);
          // console.log(jqXHR.responseText);
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
