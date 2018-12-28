<div class=" volunteer-single">

        <!-- start page-title -->    
        <section class="page-title espace-personnel-title">
            <div class="page-title-bg"></div>
            <div class="container">
                <h2 class="hidden">Page title</h2>
            </div> <!-- end container -->
        </section>
        <!-- end page-title -->


        <!-- start volunteer-single-section -->  
        <section class="volunteer-single-section">
            <div class="container">
                <div class="row">
                    <div class="col col-xs-12">
                        <div class="volunteer-profile-title">
                            <div class="img-holder">
                                <img src="<?php echo WEBROOT_URL; ?>images/volunteer-single/volunteers/membre_default_new.jpg" alt class="img img-responsive">
                            </div>
                            <div>
                                <h3><?php echo $_SESSION['user']['nom'].' '.$_SESSION['user']['prenom']; ?></h3>
                                <p><span><?php echo $poste->designation; ?></span>, 
                                    <?php echo $descriptStatutMbre[$_SESSION['user']['statut']]; 
                                    //debug($descriptStatutMbre);
                                    //debug($_SESSION['user']['statut']);
                                    ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row volunteer-content">
                    <div class="col col-md-3">
                        <div class="info">
                            <div class="box-title">
                                <h3><i class="fa fa-pencil"></i> Infos </h3>
                            </div>
                            <ul class="info-details">
                                
                                <li>
                                    <span>Telephone</span>
                                    <span><?php echo $_SESSION['user']['tel']; ?></span>
                                </li>
                                <li>
                                    <span>EMail</span>
                                    <span><?php echo $_SESSION['user']['email']; ?></span>
                                </li>
                                <li>
                                    <span>Pays</span>
                                    <span><?php echo $pays->nom; ?></span>
                                </li>
                                <li>
                                    <span>Ville</span>
                                    <span><?php echo isset($_SESSION['user']['ville']) ? $_SESSION['user']['ville'] : '' ; ?></span>
                                </li>
                                <li>
                                    <span>Métier</span>
                                    <span><?php echo $metier->designation; ?></span>
                                </li>
                                <li>
                                    <span>Numero de Membre</span>
                                    <span><?php echo $_SESSION['user']['numero_membre']; ?></span>
                                </li>
                            </ul>
                            
                            <!--<div class="social">
                                <span>social</span>
                                
                            </div>-->
                        </div>
                    </div>

                    <div class="col col-md-9">
                        <!--<div class="bio">
                            <div class="box-title">
                                <h3><i class="fa fa-pencil"></i> Bio</h3>
                            </div>
                            <p>Neque porro quisquam est, q quia non numquaerat voluptatem.</p>
                            <p>Ut enim ad minima veninisi ut aliquid ex ea commodi.</p>
                        </div>-->
                        <div class="similar-profile">
                            <div class="box-title">
                                <h3><i class="fa fa-list"></i> Liste des cotisations</h3>
                            </div>
                            
                            <style>
                            #customers {
                                font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                                border-collapse: collapse;
                                width: 100%;
                            }

                            #customers td, #customers th {
                                border: 1px solid #ddd;
                                padding: 8px;
                            }

                            #customers tr:nth-child(even){background-color: #f2f2f2;}

                            #customers tr:hover {background-color: #ddd;}

                            #customers th {
                                padding-top: 12px;
                                padding-bottom: 12px;
                                text-align: left;
                                background-color: #ffbb00;
                                color: white;
                            }
                            </style>
                            <?php 
                                $cotis_nbre = count($list_cotis);
                                $tble_nbre = $cotis_nbre + 1;

                            ?>

                            <div class="table-responsive">
                                <table class="table" id="customers">
                                  <tr>
                                    <th>#</th>
                                    <th>Type</th>
                                    <th>Mois</th>
                                    <th>Montant</th>
                                    <th>Date Paiement</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                  </tr>
                                  <?php foreach ($list_cotis as $coti): ?>
                                      <tr>
                                        <td><?php echo $tble_nbre--; ?></td>
                                        <td>Cotisation</td>
                                        <td><?php echo $coti->mois.' '.$coti->annee; ?></td>
                                        <td><?php echo $coti->montant.' F CFA'; ?></td>
                                        <?php
                                            $date_paiement = '--';
                                            $statut = 'Impayé';
                                            $action = 'Payer';
                                            $couleur = 'danger';
                                            $icon = 'credit-card';
                                            $desccriptStatut = '';
                                            $payed = false;
                                            foreach ($paiements_cotis as $pc){
                                                if($pc->id_cotisation == $coti->id){
                                                    $payed = true;
                                                    $date_paiement = $pc->date_modification;
                                                    $statutContent = getStatus($pc->statut_id);
                                                    $statut = $statutContent['titre'];
                                                    $action = $statutContent['action'];
                                                    $couleur = $statutContent['couleur'];
                                                    $icon = $statutContent['icon'];
                                                    $desccriptStatut = $statutContent['description'];
                                                }
                                            } 
                                        ?>
                                        <td><?php echo $date_paiement; ?></td>
                                        <td>
                                            <span class="label label-<?php echo $couleur; ?>">
                                                <?php echo $statut; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="#" class="" data-toggle="tooltip" data-placement="top" 
                                            title="<?php echo $desccriptStatut; ?>">
                                                <span class="glyphicon glyphicon-<?php echo $icon; ?>"></span>
                                                <?php echo $action; ?>
                                            </a>
                                            <!--<button type="button" class="btn btn-secondary" 
                                                    data-toggle="tooltip" data-placement="top" title="Tooltip on top">
                                              Tooltip on top
                                            </button>-->
                                        </td>
                                      </tr>                                  
                                  <?php endforeach ?>
                                  
                                  <tr>
                                    <td>1</td>
                                    <td><?php echo ($signUp->type == 1) ? 'Inscription' : 'Cotisation'; ?></td>
                                    <td>--</td>
                                    <td><?php echo $signUp->transaction_amount.' F CFA'; ?></td>
                                    <td><?php echo $signUp->date_creation; ?></td>
                                    <td>
                                        <span class="label label-<?php echo $statutPaiement['couleur']; ?>">
                                            <?php echo $statutPaiement['titre']; ?>
                                        </span>
                                    </td>
                                    
                                    <td>
                                        <a href="#" class="" data-toggle="tooltip" data-placement="top" 
                                            title="<?php echo $statutPaiement['description']; ?>">
                                            <span class="glyphicon glyphicon-<?php echo $statutPaiement['icon']; ?>"></span>
                                            <?php echo $statutPaiement['action']; ?>
                                        </a>
                                    </td>
                                  </tr>
                                  
                                </table>
                            </div>

        </section>
        <!-- end volunteer-single-section -->


         <!-- start footer -->  
        
        <!-- end footer -->
    </div>

<style type="text/css">
    
    /*MODAL PAYMENT ERROR*/
    .modalConfirmFail {
        font-family: 'Varela Round', sans-serif;
    }
    .modalConfirmFail {        
        color: #636363;
        width: 500px;
    }
    .modalConfirmFail .modal-content {
        padding: 20px;
        border-radius: 5px;
        border: none;
        text-align: center;
        font-size: 14px;
    }
    .modalConfirmFail .modal-header {
        border-bottom: none;   
        position: relative;
    }
    .modalConfirmFail h4 {
        text-align: center;
        font-size: 26px;
        margin: 30px 0 -10px;
    }
    .modalConfirmFail .close {
        position: absolute;
        top: -5px;
        right: -2px;
    }
    .modalConfirmFail .modal-body {
        color: #999;
    }
    .modalConfirmFail .modal-footer {
        border: none;
        text-align: center;     
        border-radius: 5px;
        font-size: 13px;
        padding: 10px 15px 25px;
    }
    .modalConfirmFail .modal-footer a {
        color: #999;
    }       
    .modalConfirmFail .icon-box {
        width: 80px;
        height: 80px;
        margin: 0 auto;
        border-radius: 50%;
        z-index: 9;
        text-align: center;
        border: 3px solid #f15e5e;
    }
    .modalConfirmFail .icon-box i {
        color: #f15e5e;
        font-size: 46px;
        display: inline-block;
        margin-top: 13px;
    }
    .modalConfirmFail .btn {
        color: #fff;
        border-radius: 4px;
        background: #60c7c1;
        text-decoration: none;
        transition: all 0.4s;
        line-height: normal;
        min-width: 120px;
        border: none;
        min-height: 40px;
        border-radius: 3px;
        margin: 0 5px;
        outline: none !important;
    }
    .modalConfirmFail .btn-info {
        background: #c1c1c1;
    }
    .modalConfirmFail .btn-info:hover, .modalConfirmFail .btn-info:focus {
        background: #a8a8a8;
    }
    .modalConfirmFail .btn-danger {
        background: #f15e5e;
    }
    .modalConfirmFail .btn-danger:hover, .modalConfirmFail .btn-danger:focus {
        background: #ee3535;
    }
    .trigger-btn {
        display: inline-block;
        margin: 100px auto;
    }

    /*MODAL PAYMENT SUCCES*/
    .modalConfirmSucces {
        font-family: 'Varela Round', sans-serif;        
        color: #636363;
        width: 500px;
    }
    .modalConfirmSucces .modal-content {
        padding: 20px;
        border-radius: 5px;
        border: none;
    }
    .modalConfirmSucces .modal-header {
        border-bottom: none;   
        position: relative;
    }
    .modalConfirmSucces h4 {
        text-align: center;
        font-size: 26px;
        margin: 30px 0 -15px;
    }
    .modalConfirmSucces .form-control, .modalConfirmSucces .btn {
        min-height: 40px;
        border-radius: 3px; 
    }
    .modalConfirmSucces .close {
        position: absolute;
        top: -5px;
        right: -5px;
    }   
    .modalConfirmSucces .modal-footer {
        border: none;
        text-align: center;
        border-radius: 5px;
        font-size: 13px;
    }   
    .modalConfirmSucces .icon-box {
        color: #fff;        
        position: absolute;
        margin: 0 auto;
        left: 0;
        right: 0;
        top: -70px;
        width: 95px;
        height: 95px;
        border-radius: 50%;
        z-index: 9;
        background: #82ce34;
        padding: 15px;
        text-align: center;
        box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.1);
    }
    .modalConfirmSucces .icon-box i {
        font-size: 58px;
        position: relative;
        top: 3px;
    }
    .modalConfirmSucces.modal-dialog {
        margin-top: 80px;
    }
    .modalConfirmSucces .btn {
        color: #fff;
        border-radius: 4px;
        background: #82ce34;
        text-decoration: none;
        transition: all 0.4s;
        line-height: normal;
        border: none;
        margin-top: 60px;
    }
    .modalConfirmSucces .btn:hover, .modalConfirmSucces .btn:focus {
        background: #6fb32b;
        outline: none;
    }
    .trigger-btn {
        display: inline-block;
        margin: 100px auto;
    }

</style>


<?php
    $errorToDisplay = '';
    $succesToDisplay = '';
    if(isset($_SESSION['paymentReturn'])){
        if($_SESSION['paymentReturn']['status']){
            $errorToDisplay = 'resultPaymentDisplay';
        }else{
            $succesToDisplay = 'resultPaymentDisplay';
        }
    }
?> 



<!-- Modal  HTML -->
<div id="<?php echo $errorToDisplay; ?>" class="modal fade">
    <div class="modal-dialog modalConfirmFail">
        <div class="modal-content">
            <div class="modal-header-echec">
                <div class="icon-box">
                    <i class="material-icons">&#xE5CD;</i>
                </div>              
                <h4 class="modal-title"> ERREUR !</h4>  
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <p>
                    <?php 
                        if(isset($_SESSION['paymentReturn']) && $_SESSION['paymentReturn']['status']==true){
                            echo $_SESSION['paymentReturn']['description'];
                            unset($_SESSION['paymentReturn']);
                        }
                    ?>
                </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal HTML SUCCES PAYMENT -->
<div id="<?php echo $succesToDisplay; ?>" class="modal fade ">
    <div class="modal-dialog modalConfirmSucces">
        <div class="modal-content">
            <div class="modal-header-succes">
                <div class="icon-box">
                    <i class="material-icons">&#xE876;</i>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body text-center">
                <h4> PAIEMENT EFFECTUE AVEC SUCCES! </h4> 
                <p>
                    <?php 
                        if(isset($_SESSION['paymentReturn'])){
                            //echo $_SESSION['paymentReturn']['description'];
                            unset($_SESSION['paymentReturn']);
                        }
                    ?>

                </p>
                <button class="btn btn-success" data-dismiss="modal"><span>Mes Infos</span> <i class="material-icons">&#xE5C8;</i></button>
            </div>
        </div>
    </div>
</div>


