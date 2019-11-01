<!doctype html>
<html lang="fr-FR">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <link rel="shortcut icon" href="<?php echo WEBROOT_URL; ?>images/favicon.ico"/>
    <title><?php echo APPLI_NAME; ?> &#8211; <?php echo isset($_SESSION['menu']) ? strtoupper($_SESSION['menu']) : APPLI_NAME; ?>  
        
    </title>

    <link rel="stylesheet" href="<?php echo WEBROOT_URL; ?>css/bootstrap.min-1.css" type="text/css" media="all"/>
    <link rel="stylesheet" href="<?php echo WEBROOT_URL; ?>css/bootstrap_select.min.css" type="text/css" media="all"/>
    <link rel="stylesheet" href="<?php echo WEBROOT_URL; ?>css/font-awesome.min.css" type="text/css" media="all" />
    <link rel="stylesheet" href="<?php echo WEBROOT_URL; ?>css/ionicons.min.css" type="text/css" media="all" />
    <link rel="stylesheet" href="<?php echo WEBROOT_URL; ?>css/owl.carousel.css" type="text/css" media="all"/>
    <link rel="stylesheet" href="<?php echo WEBROOT_URL; ?>css/owl.theme.css" type="text/css" media="all"/>
    <link rel='stylesheet' href='<?php echo WEBROOT_URL; ?>css/prettyPhoto.css' type='text/css' media='all'/>
    <link rel='stylesheet' href='<?php echo WEBROOT_URL; ?>css/slick.css' type='text/css' media='all'/>
    <link rel="stylesheet" href="<?php echo WEBROOT_URL; ?>css/settings-<?php echo VERSION; ?>.css" type="text/css" media="all"/>
    <link rel="stylesheet" href="<?php echo WEBROOT_URL; ?>css/style-<?php echo VERSION; ?>.css" type="text/css" media="all"/>
    <link rel="stylesheet" href="<?php echo WEBROOT_URL; ?>css/loading-<?php echo VERSION; ?>.css" type="text/css" media="all"/>
    <link rel="stylesheet" href="<?php echo WEBROOT_URL; ?>css/custom-<?php echo VERSION; ?>.css" type="text/css" media="all"/>
    <link rel="stylesheet" href="<?php echo WEBROOT_URL; ?>css/sweetalert2.min-<?php echo VERSION; ?>.css" type="text/css" media="all">
    <link rel="stylesheet" href="<?php echo WEBROOT_URL; ?>css/font-awesome.min-<?php echo VERSION; ?>.css" type="text/css" media="all">
    

    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"/> -->
    <link href="http://fonts.googleapis.com/css?family=Great+Vibes%7CLato:100,100i,300,300i,400,400i,700,700i,900,900i" rel="stylesheet"/>
    <link rel="stylesheet" href="<?php echo WEBROOT_URL; ?>css/flaticon-<?php echo VERSION; ?>.css" type="text/css" media="all">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
    <?php //$categories = $this->request('Accueil', 'getCategoryProduit'); ?>
    <?php //die(debug($categories)); ?>
    <?php //if(isset($_SESSION['cart'])){ unset($_SESSION['cart']); } ?>
 
    <div class="noo-spinner">
        <div class="spinner">
            <div class="cube1"></div>
            <div class="cube2"></div>
        </div>
    </div>

    <div id="menu-slideout" class="slideout-menu hidden-md-up">
            <div class="mobile-menu">
                <div class="header-mobile-menu  mb-2">
                    <div class="mobile-menu-logo">
                        <img class="logo-image" src="<?php echo WEBROOT_URL; ?>images/logo-1.png" 
                                                alt="logo <?php echo APPLI_NAME; ?>" />
                    </div>
                    <div class="mobile-menu-actions-enter">
                        <ul class="topbar-menu menu">
                            <li class=" <?php echo isset($_SESSION['user']) ? 'dropdown' : ''; ?> ">
                                
                                <a id="<?php echo isset($_SESSION['user']) ? 'dropdown-user' : 'login-btn'; ?>" href="#" 
                                    class="" role="" data-toggle="modal" 
                                data-target="#<?php echo isset($_SESSION['user']) ? '' : 'login-modal'; ?>">
                                    <?php echo isset($_SESSION['user']) ? ''.$_SESSION['user']['nom'] : 'Se connecter'; ?>                                           
                                
                                <?php if (isset($_SESSION['user'])){ ?>
                                  <i class="sub-menu-toggle fa fa-angle-down"></i>  
                                <?php } ?>

                                </a>
                                <?php if (isset($_SESSION['user'])){ ?>
                                    <ul id="user-sub-menu" class="sub-menu sub-menu-close">
                                        
                                        <li class=""><a href="<?php echo BASE_URL.DS.'profil/liste'; ?>">Mes Infos</a></li>
                                        <li class=""><a href="<?php echo BASE_URL.DS.'profil/modif_password'; ?>">Mot de passe</a></li>
                                        <li class=""><a href="<?php echo BASE_URL.DS.'profil/commandes'; ?>">Mes commandes</a></li>
                                        
                                        <li><a href="<?php echo BASE_URL.DS.'accueil/deconnect'; ?>">Deconnexion</a></li>
                                    </ul>
                                <?php } ?>
                            </li>
                            <?php if (!isset($_SESSION['user'])){ ?>
                            <li><a id="create-account-btn" class="" role="" data-toggle="modal" href="#" 
                                data-target="#login-modal" >
                                S'inscrire</a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <ul id="mobile-menu" class="menu">
                    <li>
                        <a href="<?php echo BASE_URL.DS.'accueil/index'; ?>"> <i class="fa fa-home" aria-hidden="true"></i>  Accueil</a>
                    </li>
                    <li class="dropdown">
                        <a href="<?php echo BASE_URL.DS.'produit/liste'; ?>">
                            <!-- <i class="fa fa-lemon-o" aria-hidden="true"></i>  -->
                            <i class="glyph-icon flaticon-basket"></i>
                            Le marché
                        </a>

                        <i class="sub-menu-toggle fa fa-angle-down"></i>
                        <ul class="sub-menu">
                            <?php $categories = $this->request('Accueil', 'getCategoryProduit'); ?>
                            <?php foreach ($categories as $c): ?>
                                <li>
                                    <a href="<?php echo BASE_URL.DS.'produit/liste/categorie/'.$c->token; ?>">
                                        <i class="glyph-icon flaticon-<?php echo $c->icon; ?>"></i>
                                        <?php echo ucfirst($c->nom); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>

                    <li>
                        <a href="<?php echo BASE_URL.DS.'apropos/index'; ?>"> 
                            <i class="fa fa-arrows-alt"></i> 
                            A propos
                        </a>
                    </li>
                    
                    <li>
                        <a href="<?php echo BASE_URL.DS.'contact/index'; ?>"><i class="fa fa-envelope"></i> Contacts</a>
                    </li>
                </ul>

            </div>
        </div>
        
        <div class="site">

            <div class="topbar">
                <div class="container">
                    <div class="row">
                        <span id="linkToEspPerso" class="hidden"><?php echo BASE_URL.DS.'membre/espace_personnel'; ?></span>
                        <span id="linkToLogin" class="hidden"><?php echo WEBROOT_URL.'ajax/logIn.php'; ?></span>
                        <span id="linkToAddMember" class="hidden"><?php echo WEBROOT_URL.'ajax/addMember.php'; ?></span>
                        <span id="linkToProductList" class="hidden"><?php echo WEBROOT_URL.'ajax/produitsList.php'; ?></span>
                        <span id="linkToProductRelated" class="hidden"><?php echo WEBROOT_URL.'ajax/produitsRelated.php'; ?></span>
                        <span id="linkToAddToCart" class="hidden"><?php echo WEBROOT_URL.'ajax/ajoutPanier.php'; ?></span>
                        <span id="linkToUpdateToCart" class="hidden"><?php echo WEBROOT_URL.'ajax/modifPanier.php'; ?></span>
                        <span id="linkToDeleteToCart" class="hidden"><?php echo WEBROOT_URL.'ajax/supprimerPanier.php'; ?></span>
                        <span id="linkToAddMessage" class="hidden"><?php echo WEBROOT_URL.'ajax/sendMessage.php'; ?></span>
                        <span id="linkToShippingDest" class="hidden"><?php echo WEBROOT_URL.'ajax/setShippingDestination.php'; ?></span>
                        <span id="linkToOrder" class="hidden"><?php echo WEBROOT_URL.'ajax/placeOrder.php'; ?></span>
                        <span id="linkToUpdateInfosUser" class="hidden"><?php echo WEBROOT_URL.'ajax/updateInfosUser.php'; ?></span>
                        <span id="linkToUpdatePassword" class="hidden"><?php echo WEBROOT_URL.'ajax/updatePassword.php'; ?></span>
                        <span id="linkToCancelledOrder" class="hidden"><?php echo WEBROOT_URL.'ajax/cancelledOrder.php'; ?></span>
                        <span id="RooTlinkToSearch" class="hidden"><?php echo SITE_BASE_URL.'produit/liste/categorie/all/search/'; ?></span>

                        <?php 
                            $idLoginButton = isset($_SESSION['user']) ? 'dropdownMenuButton' : 'loginButton';
                            //var_dump($_SESSION['user']);
                        ?>

                        <div class="col-md-12 topbar-menu-desktop">
                            <div class="topbar-menu">
                                <ul class="topbar-menu">
                                    <li class="<?php echo isset($_SESSION['user']) ? 'dropdown' : ''; ?> ">
                                        
                                        <a href="#" class="" role="" data-toggle="modal" 
                                        data-target="#<?php echo isset($_SESSION['user']) ? '' : 'login-modal'; ?>">
                                            <?php echo isset($_SESSION['user']) ? 'Bonjour '.$_SESSION['user']['nom'] : 'Se connecter'; ?>                                           
                                        </a>
                                        <?php if (isset($_SESSION['user'])){ ?>
                                            <ul class="sub-menu">
                                                <li><a href="<?php echo BASE_URL.DS.'profil/liste'; ?>">Mon compte</a></li>
                                                <li><a href="<?php echo BASE_URL.DS.'accueil/deconnect'; ?>">Deconnexion</a></li>
                                            </ul>
                                        <?php } ?>
                                    </li>
                                    <?php if (!isset($_SESSION['user'])){ ?>
                                    <li><a id="create-account-btn" class="" role="" data-toggle="modal" href="#" 
                                        data-target="#login-modal" >
                                        S'inscrire</a>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <header id="header" class="header header-desktop header-1">
                <div class="top-search">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <form class="search_product_form" method="POST" action="#">
                                    <input type="search" class="top-search-input" name="element" 
                                    placeholder="Saisissez le produit que vous recherchez et tapez Entrée" />
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-sm-11">

                            <!-- <div class="header-left">
                                <div class="widget">
                                    <div class="header-call">
                                        <div class="text">
                                            CALL US NOW
                                            <span>0122 333 8889</span>
                                        </div>
                                        <div class="icon">
                                            <i class="ion-ios-telephone-outline"></i>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!-- <i class="glyph-icon flaticon-basket"></i> -->
                            <div class="header-center">
                                <nav class="menu">
                                    <ul class="main-menu">
                                        <li class="<?php echo ($_SESSION['menu']=='Accueil') ? 'active' : ''; ?>">
                                            <a href="<?php echo BASE_URL.DS.'accueil/index'; ?>">Accueil</a>
                                        </li>

                                        <li class="dropdown mega-menu <?php echo ($_SESSION['menu']=='Marche') ? 'active' : ''; ?>">
                                            <a href="<?php echo BASE_URL.DS.'produit/liste'; ?>">Le marché</a>
                                            <ul class="sub-menu">
                                                <li>
                                                    <div class="mega-menu-content">
                                                        <div class="row">               
                                                            <div class="col-sm-6">
                                                                <div class="pt-4 pb-4">
                                                                    <!-- <h3>Best Seller</h3> -->
                                                                    
                                                                    <ul>
                                                                        <?php $categories = $this->request('Accueil', 'getCategoryProduit'); ?>
                                                                        <?php foreach ($categories as $c): ?>
                                                                            <li>
                                                                                <a href="<?php echo BASE_URL.DS.'produit/liste/categorie/'.$c->token; ?>">
                                                                                    <?php echo ucfirst($c->nom); ?> 
                                                                                </a>
                                                                            </li>
                                                                        <?php endforeach; ?>

                                                                        <?php //die(debug($this)); ?>

                                                                        
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-6">
                                                                <div class="pt-4 pb-4">
                                                                    <img src="<?php echo WEBROOT_URL; ?>images/megamenu_ads.jpg" alt="" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </li>

                                        <!-- <li>
                                            <a href="shortcodes.html">Panier</a>
                                        </li> -->
                                        <li id="branding-logo">
                                            <a href="<?php echo BASE_URL.DS.'accueil/index'; ?>" id="logo">
                                                <img class="logo-image" src="<?php echo WEBROOT_URL; ?>images/logo-1.png" 
                                                alt="logo <?php echo APPLI_NAME; ?>" />
                                            </a>
                                        </li>
                                        <!-- <li>
                                            <a href="shortcodes.html">PAIEMENT</a>
                                        </li> -->

                                        <li class="<?php echo ($_SESSION['menu']=='Apropos') ? 'active' : ''; ?>">
                                            <a href="<?php echo BASE_URL.DS.'apropos/index'; ?>" >A PROPOS</a>
                                        </li>
                                        
                                        <li <?php echo BASE_URL.DS.'contact/index'; ?> class="<?php echo ($_SESSION['menu']=='Contact') ? 'active' : ''; ?>">
                                            <a href="<?php echo BASE_URL.DS.'contact/index'; ?>">Contact</a>
                                        </li>
                                        <li class="top-search-btn">
                                            <a href="javascript:void(0);">
                                                <i class="ion-search"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="header-right mini-cart-wrap">
                                <div class="mini-cart">
                                    <?php $NbreCart= isset( $_SESSION['cart']['total_nbre'] ) ? $_SESSION['cart']['total_nbre'] : "0" ?>
                                    <div class="mini-cart-icon" data-count="<?php echo $NbreCart ?>">
                                        <i class="organik-basket"></i>
                                    </div>
                                    <div class="mini-cart-text">
                                        Mon panier
                                        <div class="mini-cart-total">
                                            <?php echo isset( $_SESSION['cart']['total_amount'] ) ? $_SESSION['cart']['total_amount'] : "0" ?> F
                                        </div>
                                    </div>
                                </div>
                                <div class="widget-shopping-cart-content">
                                    <ul class="cart-list">
                                        <?php if( !isset($_SESSION['cart']['products_list']) || empty($_SESSION['cart']['products_list']) ) { ?>
                                            <div class="empty-cart text-center col-md-12"> 
                                                Votre panier est vide 
                                            </div>
                                        <?php }else{ ?>
                                            <?php foreach ($_SESSION['cart']['products_list'] as $token => $p): ?>
                                                <li class="<?php echo $token; ?>" id-product="<?php echo $token; ?>" >
                                                    <!-- <a href="#" class="remove">×</a> -->
                                                    <a href="" class="remove remove-product-cart" id-product="<?php echo $token; ?>">×</a>
                                                    <a href="<?php echo $p['link_to_details']; ?>">
                                                        <img src="<?php echo $p['link_to_image']; ?>" alt="" />
                                                        <?php echo $p['nom']; ?> &nbsp;
                                                    </a>
                                                    <span class="quantity">
                                                        <span class="nbre-cart-product"><?php echo $p['qtite_cart']; ?></span> x
                                                        <span class="amount-cart-product"><?php echo $p['prix_qtite_unit']; ?></span> F
                                                    </span>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php } ?>
                                    </ul>
                                    <p class="total">
                                        <strong>Sous Total:</strong> 
                                        <span class="amount">
                                            <?php echo isset( $_SESSION['cart']['total_amount'] ) ? $_SESSION['cart']['total_amount'] : "0" ?> F
                                        </span>
                                    </p>
                                    <?php //if( isset($_SESSION['cart']['products_list']) && !empty($_SESSION['cart']['products_list']) ) { ?>
                                        <p class="buttons">
                                            <a href="<?php echo BASE_URL.DS.'produit/panier'; ?>" class="view-cart">Le Panier</a>

                                            <?php if ( isset($_SESSION['user']) ): ?>
                                                <a href="<?php echo BASE_URL.DS.'commande/details'; ?>" class="checkout">
                                                    Commander
                                                </a>
                                            <?php else: ?>
                                                <a href="#" role="" data-toggle="modal" data-target="#login-modal" class="checkout">
                                                    Commander
                                                </a>
                                            <?php endif; ?>
                                        </p>
                                    <?php //} ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <header class="header header-mobile">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-2">
                            <div class="header-left">
                                <div id="open-left"><i class="ion-navicon"></i></div>
                            </div>
                        </div>
                        <div class="col-xs-8">
                            <div class="header-center">
                                <a href="<?php echo BASE_URL.DS.'accueil/index'; ?>" id="logo-2">
                                    <img class="logo-image" src="<?php echo WEBROOT_URL; ?>images/logo-1.png" alt="logo <?php echo APPLI_NAME; ?>" />
                                </a>
                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="header-right">
                                <div class="mini-cart-wrap open">
                                    <a href="<?php echo BASE_URL.DS.'produit/panier'; ?>">
                                        <div class="mini-cart">
                                            <div class="mini-cart-icon" data-count="<?php echo $NbreCart ?>">
                                                <i class="ion-bag"></i>
                                            </div>
                                        </div>
                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>      

        <?php
        
        
            echo $contain_for_layout;                      
        ?>


        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog ">
            <div class="modal-content ">
                <div class="modal-header" align="center">
                    <!-- <img class="img-circle" id="img_logo" src="http://bootsnipp.com/img/logo.jpg"> -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <!-- <span class="glyphicon glyphicon-remove" aria-hidden="true"></span> -->
                        <i class="fa fa-times-circle"></i>
                        <!-- <i class="far fa-times-circle"></i> -->

                    </button>
                </div>
                
                <!-- Begin # DIV Form -->
                <div id="div-forms" class="xxauth-modal-content">
                
                    <!-- Begin # Login Form -->
                    <form id="login-form" method="POST" action="" style="">
                        <div class="modal-body">

                            <div class="login-form-title col-md-12 text-center">
                                <i class="fa fa-user"></i> <span> CONNEXION</span>
                            </div>
                            <div id="errorLoginForm" class="col-md-12 text-center"></div>                         
                            
                            <input id="login_username" name="user_login" class="form-control" type="text" placeholder="Tel ou email" required>
                            <input id="login_password" name="user_password" class="form-control" type="password" placeholder="Mot de passe" required>
                            <div class="checkbox">
                                <label>
                                    <input id="show-password-checbox-login" type="checkbox"> Afficher mot de passe
                                </label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="login-form-valide">
                                <button id="login-button-valide" type="submit" class="btn btn-success btn-lg btn-block">Valider</button>
                            </div>
                            <div class="login-form-other-actions">
                                <button id="login_lost_btn" type="button" class="btn btn-link">Mot de passe oublié?</button>
                                <button id="login_register_btn" type="button" class="btn btn-link">S'inscrire</button>
                            </div>
                        </div>
                    </form>
                    <!-- End # Login Form -->
                    
                    <!-- Begin | Lost Password Form -->
                    <form id="lost-form" style="display:none;">
                        <div class="modal-body">
                            
                            <div class="login-form-title col-md-12 text-center">
                                <i class="fa fa-unlock"></i> <span> MOT DE PASSE OUBLIE</span>
                            </div>
                            <input id="lost_email" class="form-control" type="text" placeholder="E-mail" required>
                        </div>
                        <div class="modal-footer">
                            <div>
                                <button type="submit" class="btn btn-success btn-lg btn-block">Envoyer</button>
                            </div>
                            <div class="login-form-other-actions">
                                <button id="lost_login_btn" type="button" class="btn btn-link">Se connecter</button>
                                <button id="lost_register_btn" type="button" class="btn btn-link">s'inscrire</button>
                            </div>
                        </div>
                    </form>
                    <!-- End | Lost Password Form -->
                    
                    <!-- Begin | Register Form -->
                    <form id="register-form" style="display:none;">
                        <div class="modal-body">
                            <div class="login-form-title col-md-12 text-center">
                                <i class="fa fa-user-plus"></i> <span> CREER VOTRE COMPTE</span>
                            </div>
                            <div id="errorRegisterForm" class="col-md-12 text-center"></div>  
                            <div class="checkbox">
                                <!-- <span>Sexe*</span><br> -->
                                <label>
                                    <input type="radio" class="" name="register_sexe" value="F" checked> Femme*
                                </label>
                                <label>
                                    <input type="radio" name="register_sexe" value="H"> Homme*
                                </label>
                            </div>
                            <!-- .input-error // pour lorsqu'un champs n'a pas la bonne valeur -->
                            <input id="register_name" name="register_nom" class="form-control" type="text" placeholder="Nom*" required>
                            <input id="register_username" name="register_prenom" class="form-control" type="text" placeholder="prenom*" required>
                            <input id="register_tel" name="register_tel" class="form-control" type="text" placeholder="Tel*" maxlength="8" required>
                            <input id="register_email" name="register_email" class="form-control" type="text" placeholder="E-Mail" >
                            <input id="register_password" name="register_password" class="form-control" type="password" 
                            placeholder="Mot de passe*" required>
                            <input id="register_confirm_password" name="register_confirm_password" class="form-control" type="password" 
                            placeholder="Confirmer Mot de passe*" required>

                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="register_cond" value="1"> conditions générales
                                </label>
                            </div>
                            <div class="champs-obligatoires">
                                <span>(*) Champs obligatoires</span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div>
                                <button type="submit" class="btn btn-success btn-lg btn-block">Valider</button>
                            </div>
                            <div>
                                <button id="register_login_btn" type="button" class="btn btn-link">Se connecter</button>
                                <button id="register_lost_btn" type="button" class="btn btn-link">Mot de passe oublié?</button>
                            </div>
                        </div>
                    </form>
                    <!-- End | Register Form -->
                    
                </div>
                <!-- End # DIV Form -->
                
            </div>
        </div>
    </div>


        <footer class="footer">
            <!-- <div class="container">
                <div class="row">
                    <div class="col-md-5">
                        <img src="<?php echo WEBROOT_URL; ?>images/footer_logo.png" class="footer-logo" alt="" />
                        <p>
                            Welcome to Organik. Our products are freshly harvested, washed ready for box and finally delivered from our family farm right to your doorstep.
                        </p>
                        <div class="footer-social">
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Pinterest"><i class="fa fa-pinterest"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="fa fa-instagram"></i></a>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="widget">
                            <h3 class="widget-title">Infomation</h3>
                            <ul>
                                <li><a href="#">New Products</a></li>
                                <li><a href="#">Top Sellers</a></li>
                                <li><a href="#">Our Blog</a></li>
                                <li><a href="#">About Our Shop</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="widget">
                            <h3 class="widget-title">Useful Link</h3>
                            <ul>
                                <li><a href="#">Our Team</a></li>
                                <li><a href="#">Our Blog</a></li>
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Secure Shopping</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="widget">
                            <h3 class="widget-title">Subscribe</h3>
                            <p>
                                Enter your email address for our mailing list to keep yourself updated.
                            </p>
                            <form class="newsletter">
                                <input type="email" placeholder="Your email address" required="" />
                                <button><i class="fa fa-paper-plane"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div> -->
        </footer>
        
        <div class="copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        Copyright © 2019 <a href="<?php echo BASE_URL.DS.'accueil/index'; ?>">
                        <?php echo APPLI_NAME; ?></a> - Tous droits reservés.
                    </div>
                    <div class="col-md-4">
                        <!-- <img src="<?php echo WEBROOT_URL; ?>images/footer_payment.png" alt="" /> -->
                        <div class="footer-social">
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Facebook"><i class="fa fa-facebook"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Twitter"><i class="fa fa-twitter"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Pinterest"><i class="fa fa-pinterest"></i></a>
                            <a href="#" data-toggle="tooltip" data-placement="top" title="Instagram"><i class="fa fa-instagram"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="backtotop" id="backtotop"></div>
        </div>

    </div>
    <script type="text/javascript" src="<?php echo WEBROOT_URL; ?>js/jquery.min-<?php echo VERSION; ?>.js"></script>
    
    <script type="text/javascript" src="<?php echo WEBROOT_URL; ?>js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo WEBROOT_URL; ?>js/bootstrap_select.min.js"></script>
    <script type="text/javascript" src="<?php echo WEBROOT_URL; ?>js/modernizr-2.7.1.min.js"></script>
    <script type="text/javascript" src="<?php echo WEBROOT_URL; ?>js/owl.carousel.min.js"></script>
    <script type="text/javascript" src="<?php echo WEBROOT_URL; ?>js/imagesloaded.pkgd.min.js"></script>
    <script type="text/javascript" src="<?php echo WEBROOT_URL; ?>js/isotope.pkgd.min.js"></script>
    <script type="text/javascript" src="<?php echo WEBROOT_URL; ?>js/jquery.isotope.init.js"></script>

    <script type='text/javascript' src='<?php echo WEBROOT_URL; ?>js/jquery.prettyPhoto.js'></script>
    <script type='text/javascript' src='<?php echo WEBROOT_URL; ?>js/jquery.prettyPhoto.init.min.js'></script>
    <script type='text/javascript' src='<?php echo WEBROOT_URL; ?>js/slick.min.js'></script>

    <script type="text/javascript" src="<?php echo WEBROOT_URL; ?>js/script-<?php echo VERSION; ?>.js"></script>
    <script type="text/javascript" src="<?php echo WEBROOT_URL; ?>js/own-script-<?php echo VERSION; ?>.js"></script>

    <script type="text/javascript" src="<?php echo WEBROOT_URL; ?>js/jquery.themepunch.tools.min.js"></script>
    <script type="text/javascript" src="<?php echo WEBROOT_URL; ?>js/jquery.themepunch.revolution.min.js"></script>
    <script type="text/javascript" src="<?php echo WEBROOT_URL; ?>js/extensions/revolution.extension.video.min.js"></script>
    <script type="text/javascript" src="<?php echo WEBROOT_URL; ?>js/extensions/revolution.extension.slideanims.min.js"></script>
    <script type="text/javascript" src="<?php echo WEBROOT_URL; ?>js/extensions/revolution.extension.actions.min.js"></script>
    <script type="text/javascript" src="<?php echo WEBROOT_URL; ?>js/extensions/revolution.extension.layeranimation.min.js"></script>
    <script type="text/javascript" src="<?php echo WEBROOT_URL; ?>js/extensions/revolution.extension.kenburn.min.js"></script>
    <script type="text/javascript" src="<?php echo WEBROOT_URL; ?>js/extensions/revolution.extension.navigation.min.js"></script>
    <script type="text/javascript" src="<?php echo WEBROOT_URL; ?>js/extensions/revolution.extension.migration.min.js"></script>
    <script type="text/javascript" src="<?php echo WEBROOT_URL; ?>js/extensions/revolution.extension.parallax.min.js"></script>

    <script type="text/javascript" src="<?php echo WEBROOT_URL; ?>js/core.min.js"></script>
    <script type="text/javascript" src="<?php echo WEBROOT_URL; ?>js/widget.min.js"></script>
    <script type="text/javascript" src="<?php echo WEBROOT_URL; ?>js/mouse.min.js"></script>
    <script type="text/javascript" src="<?php echo WEBROOT_URL; ?>js/slider.min.js"></script>
    <script type="text/javascript" src="<?php echo WEBROOT_URL; ?>js/jquery.ui.touch-punch.js"></script>
    <script type="text/javascript" src="<?php echo WEBROOT_URL; ?>js/price-slider-<?php echo VERSION; ?>.js"></script>
    <script type="text/javascript" src="<?php echo WEBROOT_URL; ?>js/sweetalert2.min.js"></script>
</body>

</html>
