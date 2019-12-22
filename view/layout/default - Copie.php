<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Charity++ Responsive HTML Template">
    <meta name="author" content="themexriver">

    <!-- Page Title -->
    <title>AIESAEA </title>

    <!-- Favicon and Touch Icons -->
    <link href="<?php echo WEBROOT_URL; ?>images/favicon.png" rel="shortcut icon" type="image/png">
    <link href="<?php echo WEBROOT_URL; ?>images/apple-touch-icon.png" rel="apple-touch-icon">
    <link href="<?php echo WEBROOT_URL; ?>images/apple-touch-icon-72x72.png" rel="apple-touch-icon" sizes="72x72">
    <link href="<?php echo WEBROOT_URL; ?>images/apple-touch-icon-114x114.png" rel="apple-touch-icon" sizes="114x114">
    <link href="<?php echo WEBROOT_URL; ?>images/apple-touch-icon-144x144.png" rel="apple-touch-icon" sizes="144x144">

    <!-- Icon fonts -->
    <link href="<?php echo WEBROOT_URL; ?>css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="<?php echo WEBROOT_URL; ?>css/flaticon.css" rel="stylesheet"> 

    <!-- Bootstrap core CSS -->
    <link href="<?php echo WEBROOT_URL; ?>css/bootstrap.min.css" rel="stylesheet">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="<?php echo WEBROOT_URL; ?>css/bootstrap-select.min.css"> 

    <!-- Plugins for this template -->
    <link href="<?php echo WEBROOT_URL; ?>css/animate.css" rel="stylesheet">
    <link href="<?php echo WEBROOT_URL; ?>css/owl.carousel.css" rel="stylesheet">
    <link href="<?php echo WEBROOT_URL; ?>css/owl.theme.css" rel="stylesheet">
    <link href="<?php echo WEBROOT_URL; ?>css/owl.transitions.css" rel="stylesheet">
    <link href="<?php echo WEBROOT_URL; ?>css/slick.css" rel="stylesheet">
    <link href="<?php echo WEBROOT_URL; ?>css/slick-theme.css" rel="stylesheet">
    <link href="<?php echo WEBROOT_URL; ?>css/jquery.fancybox.css" rel="stylesheet">
    <!--<link rel="stylesheet" type="text/css" href="http://localhost/mareussite/webroot/css/datepicker.css">
    <!-- Custom styles for this template -->
    <link href="<?php echo WEBROOT_URL; ?>css/jquery.classycountdown.css" rel="stylesheet">
    <link href="<?php echo WEBROOT_URL; ?>css/style-<?php echo VERSION; ?>.css" rel="stylesheet">
    

<!-- Custom styles Table 
    <link href="<?php //echo WEBROOT_URL; ?>css/jquery-ui.css" rel="stylesheet">
    <link href="<?php //echo WEBROOT_URL; ?>css/dataTables.jqueryui.min.css" rel="stylesheet"> --> 

<!--===============================TABLE STYLE======================================-->
    <!--<link rel="stylesheet" type="text/css" href="<?php //echo WEBROOT_URL; ?>table/vendor/perfect-scrollbar/perfect-scrollbar.css">

    <link rel="stylesheet" type="text/css" href="<?php ///echo WEBROOT_URL; ?>css/util.css">
    <link rel="stylesheet" type="text/css" href="<?php //echo WEBROOT_URL; ?>css/main_test-13.css"> --> 

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <!-- start page-wrapper -->
    <div class="page-wrapper">

        <!-- start preloader --> 
        <div class="preloader">
            <div class="middle">
                <!--<i class="fi flaticon-animal"></i>--> 
                <h2 id="linkToEspPerso" class="hidden"><?php echo BASE_URL.DS.'membre/espace_personnel'; ?></h2>
                <h2 id="linkToLogin" class="hidden"><?php echo WEBROOT_URL.'ajax/logIn.php'; ?></h2>
                <h2 id="linkToAddMember" class="hidden"><?php echo WEBROOT_URL.'ajax/addMember.php'; ?></h2>
            </div>
        </div>
        <!-- end preloader -->   

        <!-- Start header -->
        <header id="header">

            <!-- start-topbar -->
            <div class="top-bar">
                <div class="container">
                    <div class="row">
                        <div class="col col-sm-4 logo-holder">
                            <a class="logo" href="<?php echo BASE_URL.DS.'accueil/index'; ?>"><img src="<?php echo WEBROOT_URL; ?>images/own/logo.png" class="img img-responsive" alt></a>
                        </div>
                        <div class="col col-sm-8">
                            <div class="contact-info">
                                <div class="box">
                                    <div class="details">
                                        <h5><img src="<?php echo WEBROOT_URL; ?>images/email_icon-1.png" alt> Email</h5>
                                        <p>info@aiesaea.org</p>
                                        <?php //echo $_SESSION['menu']; ?>
                                    </div>
                                </div>
                                <div class="box">
                                    <div class="details">
                                        <h5> <img src="<?php echo WEBROOT_URL; ?>images/phone-icon-new.png" alt> Téléphone</h5>
                                        <p>+1-(192)-8222 974</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end container -->
            </div>
            <!-- end topbar -->

            <nav class="navigation navbar navbar-default" id="main-navigation">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="open-btn">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse navbar-left">
                        <button class="close-navbar"><i class="fa fa-close"></i></button>
                        <ul class="nav navbar-nav">
                            <li class="<?php echo ($_SESSION['menu'] == 'Accueil') ? 'current' : ' '; ?>">
                                <a href="<?php echo BASE_URL.DS.'accueil/index'; ?>">Accueil</a>    
                            </li>
                            <li class="">
                                <a href="#">Missions</a>
                            </li>
                            <li class="<?php echo ($_SESSION['menu'] == 'evenement') ? 'current' : ' '; ?>">
                                <a href="<?php echo BASE_URL.DS.'evenement/liste'; ?>">Evenements</a>
                            </li> 
                            <li class="<?php echo ($_SESSION['menu'] == 'Nous_Rejoindre') ? 'current' : ' '; ?>">
                                <a href="<?php echo BASE_URL.DS.'membre/inscription'; ?>">Nous rejoindre</a>
                            </li>
                            
                            <li><a href="#">Contacts</a></li>
                        </ul>
                    </div><!-- end of nav-collapse -->



                    <div class="navbar-right ">

                        <!--<div class="col-sm-6 social-links-mini-cart">
                            <ul class="social-links ">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>-->

                        <div class="col-sm-12">
                           
                           <?php 
                                $idLoginButton = isset($_SESSION['user']) ? 'dropdownMenuButton' : 'loginButton';


                           ?>
                           <!--<button id="<?php //echo $idLoginButton; ?>" class="btn theme-btn-s2"><i class="fi flaticon-black">
                           </i> Se connecter</button>-->
                           


                    <ul class="mini-cart-wrapper">
                            <li>
                        <a id="<?php echo $idLoginButton; ?>" href="#" class="<?php echo isset($_SESSION['user']) ? 'mini-cart-btn' : ''; ?>">
                                    <?php 
                                        //isset($_SESSION['user']) ? 'dropdownMenuButton' : 'loginButton';<i class="fi flaticon-black">
                                        if(isset($_SESSION['user'])){
                                            echo '<i class="fi flaticon-black"></i> Bienvenu '.$_SESSION['user']['nom'];
                                        }else{
                                            echo '<i class="fi flaticon-black"></i> Se connecter';
                                        }
                                    ?>
                                </a>
                                <ul class="mini-cart">
                                    <li class="item" type="button">
                                            <a href="<?php echo BASE_URL.DS.'membre/espace_personnel'; ?>">
                                                <i class="fi flaticon-black"></i>
                                                <span class="glyphicon glyphicon"></span>
                                                 Mon Profil
                                             </a>
                                    </li>
                                    <?php 
                                        $profil = isset($_SESSION['user']['id_profil']) ? $_SESSION['user']['id_profil'] : 1;

                                        if($profil==1 || $profil==2){ ?>

                                            <li class="item" type="button">
                                                <a href="<?php echo BASE_URL.DS.'membre/liste_membres'; ?>">
                                                    <i class="fi flaticon-profile"></i>
                                                    <span class="glyphicon glyphicon"></span>
                                                     Liste des Membres
                                                 </a>
                                            </li>
                                            <li class="item" type="button">
                                                <a href="<?php echo BASE_URL.DS.'membre/liste_cotisations'; ?>">
                                                    <i class="fi flaticon-list"></i>
                                                    <span class="glyphicon glyphicon-list-alt"></span>
                                                     Liste des cotisations
                                                 </a>
                                            </li>
                                            <li class="item" type="button">
                                                <a href="<?php echo BASE_URL.DS.'membre/liste_paiements'; ?>">
                                                    <i class="fi flaticon-money"></i>
                                                    <span class="glyphicon glyphicon"></span>
                                                     Liste des paiements
                                                 </a>
                                            </li>
                                    <?php
                                        }
                                     ?>

                                    <li class="minicart-price-total">
                                        <a href="<?php echo BASE_URL.DS.'membre/deconnecter'; ?>">
                                        <!--<i class="fi flaticon-profile"></i> -->
                                            <span class="glyphicon glyphicon-log-out"></span>
                                            Se deconnecter
                                        </a>
                                    </li>
                                </ul>
                            </li>
                    </ul> <!-- end mini-cart -->
                           <!--<a href="#" class="btn theme-btn-s2"><i class="fi flaticon-black"></i> Se connecter</a> 
                                <button type="button" class="btn btn-default btn-lg" id="myBtn">Login</button>
                            -->
                        </div>
                       

                    </div>
                </div><!-- end of container -->
            </nav>
        </header>
        <!-- end of header -->


        <?php

            
         echo '' ;  
         echo $contain_for_layout;
         echo '';
                                          
        ?>

        

<!-- Modal   //########ORGANISER  LE MODAL DE PAIEMENT #########""""//  -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog ">
        
          <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="padding:8px 22px;">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h5><span class="glyphicon glyphicon-download-alt"></span> Vos informations ont été enrégistrées.</h5>
            </div>
            <div class="body-init-payment">
            </div>
          </div>
          
        </div>
    </div>
<!-- end Modal paiement -->

    <style>
      .modalConnection .modal-header, h4, .close {
          background-color: #357c06;
          color:white !important;
          text-align: center;
          font-size: 30px;
      }
      #loginSubmit{
        background-color: #357c06;
        color:white !important;
      }
      .modalConnection .modal-footer {
          background-color: #f9f9f9;

      }
      .modalConnection .error {
          color: #e20f0d;
          font-weight: 100;
      }


    </style>

    <div class="modal fade" id="loginModal" role="dialog">
        <div class="modal-dialog modalConnection">
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header" style="padding:35px 50px;">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4><span class="glyphicon glyphicon-user"></span> Connexion </h4>
            </div>
            <div class="modal-body" style="padding:40px 50px;">
              <form class="form" role="form" id="login-form">
                <div id="errorLoginForm" class="col-md-12 "></div>
                <div class="form-group">
                  <label for="user_tel"><span class="glyphicon glyphicon-phone"></span> Telephone </label>
                  <input type="text" name="user_tel" maxlength="8" class="form-control" id="user_tel" required 
                  placeholder="Entrez votre numero de Telephone">
                </div>
                <div class="form-group">
                  <label for="user_password"><span class="glyphicon glyphicon-lock"></span> Mot de passe</label>
                  <input type="password" name="user_password" class="form-control" id="user_password" required 
                  placeholder="Entrez votre mot de passe">
                </div>
                  <button type="submit" id="loginSubmit" class="btn btn-block"><span class="glyphicon glyphicon-off"></span> valider </button>
              </form>
            </div>
            <div class="modal-footer">
              <button class="btn btn-default btn-default pull-left" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Fermer </button>
             <p class="modal-signup text-align-left"><a href="#"></a></p>
              <p class="modal-forgot-password text-align-left"><a href="#"></a></p>
            </div>
          </div>
          
        </div>
    </div>
    
    


        <!-- start footer -->  
        <footer>
            <div class="container">
                <div class="row upper-footer">
                    <div class="col col-md-5 col-xs-6">
                        <div class="widget about-widget">
                            <div class="logo">
                                <img src="<?php echo WEBROOT_URL; ?>images/own/logo.png" alt class="img img-responsive">
                            </div>

                            <div class="details">
                                <p>
                                    Une association dediée exclusivement à la protection sociale des artisans et aux emplois des jeunes
                                </p>
                                <p class="copyright">
                                    2018 &copy; Tous droit reservés à <span><a href="#">AIESAEA</a></span>
                                </p>
                                <ul class="social-links">
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col col-md-2 col-xs-6">
                        <div class="widget">
                            <h3>AIESAEA</h3>
                            <ul>
                                <li><a href="#">Qui sommes nous</a></li>
                                <li><a href="#">Metiers</a></li>
                                <li><a href="#">Notre Cible</a></li>
                                
                            </ul>
                        </div>
                    </div>

                    <div class="col col-md-2 col-xs-6">
                        <div class="widget">
                            <h3>Aide</h3>
                            <ul>
                                <li><a href="#">FAQ</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                                <li><a href="#">Support Utilisateurs</a></li>
                                <li><a href="#">Regulations</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="col col-md-3 col-xs-6">
                        <div class="widget contact-widget">
                            <h3>Nous Contacter</h3>
                            <div>
                                <form action="#" class="form">
                                    <div>
                                        <input type="text" class="form-control" placeholder="Votre nom" required>
                                    </div>
                                    <div>
                                        <input type="email" class="form-control" placeholder="votre addresse email " required>
                                    </div>
                                    <div>
                                        <textarea placeholder="Votre méssage"></textarea>
                                    </div>
                                    <div>
                                        <button class="btn theme-btn" type="submit">Envoyer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> 
                <!-- end upper-footer -->
            </div> 
            <!-- end container -->

           <div class="row lower-footer">
                <div class="col col-xs-12">
                    <p>Fait avec <span><i class="fa fa-heart"></i></span> par <a href="#">AIESAEA</a></p>
                </div>
            </div>
        </footer>
        <!-- end footer -->
    </div>
    <!-- end of page-wrapper -->


    <!-- All JavaScript files
    ================================================== -->
    <script src="<?php echo WEBROOT_URL; ?>js/jquery.min-2.js"></script>
    
    <script src="<?php echo WEBROOT_URL; ?>js/bootstrap.min-2.js"></script>
    
    <!-- Latest compiled and minified JavaScript -->
    <script src="<?php echo WEBROOT_URL; ?>js/bootstrap-select.min-1.js"></script> 

    <!-- Plugins for this template -->
    <script src="<?php echo WEBROOT_URL; ?>js/jquery-plugin-collection-7.js"></script>

    <!-- Custom script for this template -->
    <script src="<?php echo WEBROOT_URL; ?>js/script-<?php echo VERSION; ?>.js"></script>

    <script src="<?php echo WEBROOT_URL; ?>js/own/counter-<?php echo VERSION; ?>.js"></script>
    <!---<script src="<?php echo WEBROOT_URL; ?>table/js/main.js"></script>-->

    <!--- <script src="http://localhost/mareussite/webroot/js/bootstrap-datepicker.js"></script>-->
    <script type="text/javascript">
          
    </script>


<div class="callcenter btn_crc" id="btncallcenter" style="background: rgb(245, 245, 247); width: 90px; margin-top: 100px; top: 25%; position: fixed; left: 410px; z-index: 10000;">
                <a style="color: black" href="">
                    <!-- <img src="images/179.jpg" width="100%"> -->
                    COMMANDE RAPIDE
                </a>
            </div>

            <div id="callcentercontent" style="width: 410px; top: 20%; position: fixed; left: 0px; z-index: 10000;">
                <!-- Preoccupation CRC  -->
                <div id="live_support" style="float: right;width: 410px">
                    <div style="min-height: 150px;background: #FFF;border: solid 1px #e06b1c;">
                    <p style="text-align: center;color: #FFF;font-weight: bold;font-size: 15px;background: #e06b1a;height: 40px;padding: 10px;margin: 0px;">VOTRE PREOCCUPATION
                        <a id="close_q" class="btn_crc" href="#" style="color: #FFF;float:right;margin-right: 10px"> X </a>        
                    </p>
                    <hr style="border: solid gray 1px;margin:0px">
                    <form style="width: 350px ; margin: 10px auto">
                        <fieldset id="mailsenderf" class="foremailp" style="display: block;">
                        <input type="hidden" id="customer_identifier" name="customer_identifier">
                        <span id="msg_fieldset" class="msg_fieldset" style="display: block;color:#E06B19;margin: -5px 0 5px;">Pièce jointe autorisée: Pdf - Jpeg - Png - Gif | 2MB/fichier</span>
                        <div class="form-group col-sm-12">
                            <h6 style="color: #E06B19;">Votre adresse email *</h6>
                            <input type="text" name="destinataire" autocomplete="off" placeholder="Veuillez renseigner votre email" maxlength="40" class="form-control requiredField email emailReg" style="border: solid #c5c3c3 3px; height: 0;">
                        </div><!-- /.form-group -->
                        <div class="form-group col-sm-12" style="margin-top: -10px;">
                            <h6 style="color: #E06B19;">Votre Numéro de téléphone *</h6>
                            <input type="text" name="numero_tel" onkeypress="return event.charCode >= 48 &amp;&amp; event.charCode <= 57" placeholder="Veuillez renseigner votre numéro" autocomplete="off" maxlength="8" class="form-control requiredField telReg" style="border: solid #c5c3c3 3px; height: 0;">
                        </div><!-- /.form-group -->
                        <div class="form-group col-sm-12" style="margin-top: -10px;">
                            <h6 style="color: #E06B19;">Votre Objet *</h6>
                            <input type="text" name="objet" autocomplete="off" placeholder="Motif de votre préoccupation" maxlength="50" class="form-control requiredField charReg4" style="border: solid #c5c3c3 3px; height: 0;">
                        </div><!-- /.form-group -->
                        <div class="form-group col-sm-12" style="margin-top: -10px;">
                            <h6 style="color: #E06B19;">Votre message *</h6>
                            <textarea id="messagep" rows="3" style="width:100%;border: solid #c5c3c3 3px;" placeholder="Entrer votre message" class="requiredField" name="message"></textarea>
                        </div><!-- /.form-group -->
                        <div id="id_nok" class="form-group col-sm-7" style="margin-top: -10px;">
                            <h6 style="color:#e06b1a">Joindre un fichier</h6>
                            <input type="file" name="msg_attachment_init" style="margin: 0px;width: 100%;border: dashed 1px #e06b1a">
                        </div>
                        <div id="id_ok" class="row" style="margin: -10px 0 0;display: none;">
                            <div class="form-group col-sm-6">
                            <h6 style="color:#e06b1a">Pièce d’identité *</h6>
                            <input type="file" name="msg_attachment" class="requiredField" style="margin: 0px;width: 100%;border: dashed 1px #e06b1a">
                            </div>
                            <div class="form-group col-sm-6">
                            <h6 style="color:#e06b1a">Facture *</h6>
                            <input type="file" name="msg_bill_attachment" class="requiredField" style="margin: 0px;width: 100%;border: dashed 1px #e06b1a">
                            </div>
                        </div>
                        <a id="sendemailp" class="submitF" href="" style="background: #E06B19;display: inline-block;color: #FFF;font-size: 20px;font-weight: bold;border-radius:5px;border: none;float: right;padding: 5px 20px;margin-right: 20px;margin-bottom: 20px;margin-top:10px">Envoyer</a>
                        </fieldset>
                        <div id="result_response" style="display: none">
                        <h4 id="result_txt"></h4>
                        <div style="clear: both;margin-bottom: 30px"></div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>



</body>
</html>
