<div id="main">

    <div class="section section-bg-10 pt-4 pb-10">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h2 class="page-title text-center">Mon Compte</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="section border-bottom pt-2 pb-2">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <ul class="breadcrumbs">
                        <li><a href="<?php echo BASE_URL.DS.'accueil/index'; ?>">Accueil</a></li>
                        <li><a href="<?php echo BASE_URL.DS.'profil/liste'; ?>">Mon Compte</a></li>
                        <li>Mes Infos</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="section pt-5 pb-10">
        <div class="container">
            <div class="row">
                <div class="col-sm-3 pb-2 desktop-sous-menu-profil">
                    <div class="sous-menu-profil">
                        <ul>
                            <li class="actif"><a href="<?php echo BASE_URL.DS.'profil/liste'; ?>">Mes Infos</a></li>
                            <li class=""><a href="<?php echo BASE_URL.DS.'profil/modif_password'; ?>">Modifier mot de passe</a></li>
                            <li class=""><a href="<?php echo BASE_URL.DS.'profil/commandes'; ?>">Mes commandes</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="row user-data-info-box">
                        <div class="user-data-info-box-contain">
                            <div class="col-sm-6">
                                <?php
                                    $date_c = new DateTime($user_infos->date_creation);
                                    $date_creation = $date_c->format('d-m-Y H:i');

                                    $date_m = new DateTime($user_infos->date_modification);
                                    $date_date_modification = $date_m->format('d-m-Y H:i');
                                 ?>
                                <div class="col-sm-12 float-sm-left pt-1 pb-2">Sexe : 
                                    <span class="user-data-info sexe"><?php echo ($user_infos->sexe==1) ? 'Homme' : 'Femme'; ?></span>
                                </div>
                                <div class="col-sm-12 float-sm-left pb-2">Nom : 
                                    <span class="user-data-info nom"><?php echo ucfirst($user_infos->nom); ?></span>
                                </div>
                                <div class="col-sm-12 float-sm-left pb-2">Prénoms : 
                                    <span class="user-data-info prenoms"><?php echo ucfirst($user_infos->prenoms); ?></span>
                                </div>
                                <div class="col-sm-12 float-sm-left pb-2">Téléphone : 
                                    <span class="user-data-info tel"><?php echo $user_infos->tel; ?></span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-12 float-sm-left pt-1 pb-2">Email : 
                                    <span class="user-data-info email"><?php echo $user_infos->email; ?></span>
                                </div>
                                <div class="col-sm-12 float-sm-left pb-2">Statut : 
                                    <span class="user-data-info statut"><?php echo ($user_infos->statut==1) ? 'ACTIF' : 'NON ACTIF'; ?></span>
                                </div>
                                <div class="col-sm-12 float-sm-left pb-2">Date création : 
                                    <span class="user-data-info"><?php echo $date_creation; ?></span>
                                </div>
                                <div class="col-sm-12 float-sm-left pb-2">Date dernière modification : 
                                    <span class="user-data-info"><?php echo $date_date_modification; ?></span>
                                </div>
                            </div>
                            <div class="col-sm-10 user-data-info-action pt-1 pb-2">
                                <button type="button" class="btn btn-success btn-lg btn-block">
                                    Modifier Mes informations
                                </button>
                                <!-- <button type="button" class="btn btn-outline-success">Success</button> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="modal-update-info-perso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" 
      aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h6 class="modal-title text-uppercase" id="exampleModalLongTitle"> Modifier mes infos personnelles </h6>
      </div>
      <form id="form-update-info-perso">
      <div class="modal-body order-confirmation-body">
        <div class="row">
            <div class="col-sm-12 shipping-confirmation-details">
                    <div class="error-text col-sm-12"></div>
                    <div class="col-sm-12 cntr">
                        <label for="opt1" class="radio">
                            <input type="radio" name="sexe" id="opt1" class="hidden" value="M" />
                            <span class="label"></span>Homme
                        </label>
                          
                        <label for="opt2" class="radio">
                            <input type="radio" name="sexe" id="opt2" class="hidden" value="F" />
                            <span class="label"></span>Femme
                        </label>
                    </div>
                    <div class="col-sm-6 pt-1">
                        <label data-error="wrong" data-success="right" for="name">Nom*</label>
                        <input type="text" name="name" id="name" class="form-control validate" required>
                    </div>
                    <div class="col-sm-6 pt-1">
                        <label data-error="wrong" data-success="right" for="lastname">Prénoms*</label>
                        <input type="text" name="lastname" id="lastname" class="form-control validate" required>
                    </div>
                    <div class="col-sm-6 pt-2">
                        <label data-error="wrong" data-success="right" for="tel">Téléphone*</label>
                        <input type="text" name="tel" id="tel" class="form-control validate" required>
                    </div>
                    <div class="col-sm-6 pt-2 pb-1">
                        <label data-error="wrong" data-success="right" for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control validate">
                    </div>
                
            </div>
        </div>
      </div>
      <div class="modal-footer text-center">
        <!-- <button type="button" class="btn organik-btn-cancel" data-dismiss="modal">ANNULER</button> -->
        <button type="submit" id="confirm-update-info-btn" class="btn organik-btn text-center">Confirmer</button>
      </div>
      </form>

    </div>
  </div>
</div>
    
</div>
            
