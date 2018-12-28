(function($) {

	"use strict";

    //$("#myModal").modal();
    var UrlToAddMember = $("#linkToAddMember").html();
    var UrlToLogin = $("#linkToLogin").html();
    var UrlToEspacePerso = $("#linkToEspPerso").html();
    var linkToProductList = $("#linkToProductList").html();



     //console.log($("#linkToAddMember").html());
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
                var $rg_email=$('#register_email').val();
                var $rg_password=$('#register_password').val();
                if ($rg_username == "ERROR") {
                    msgChange($('#div-register-msg'), $('#icon-register-msg'), $('#text-register-msg'), "error", "glyphicon-remove", "Register error");
                } else {
                    msgChange($('#div-register-msg'), $('#icon-register-msg'), $('#text-register-msg'), "success", "glyphicon-ok", "Register OK");
                }
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
           console.log(data);
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

})(window.jQuery);
