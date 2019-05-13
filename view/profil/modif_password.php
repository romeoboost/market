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
                        <li>Modifier Mot de Passe</li>
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
                            <li class=""><a href="<?php echo BASE_URL.DS.'profil/liste'; ?>">Mes Infos</a></li>
                            <li class="actif"><a href="<?php echo BASE_URL.DS.'profil/modif_password'; ?>">Modifier mot de passe</a></li>
                            <li class=""><a href="<?php echo BASE_URL.DS.'profil/commandes'; ?>">Mes commandes</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="row user-data-info-box">
                        <div class="user-data-info-box-contain user-update-password-box-contain col-sm-7 ">
                            <form id="form-update-password">
                                <div class="form-update-password-inner col-sm-10">
                                    <div class="error-text col-sm-12 mt-1"></div>
                                    <div class="col-sm-12 pt-2 pb-1">
                                        <label data-error="wrong" data-success="right" for="old_password">Ancien Mot de Passe</label>
                                        <input type="password" name="old_password" id="old_password" class="form-control validate" required>
                                    </div>
                                    <div class="col-sm-12 pt-1 pb-1">
                                        <label data-error="wrong" data-success="right" for="new_password">Nouveau Mot de Passe</label>
                                        <input type="password" name="new_password" id="new_password" class="form-control validate" required>
                                    </div>
                                    <div class="col-sm-12 pt-1 pb-1">
                                        <label data-error="wrong" data-success="right" for="confirm_new_password">Confirmer Mot de passe</label>
                                        <input type="password" name="confirm_new_password" id="confirm_new_password" 
                                        class="form-control validate" required>
                                    </div>
                                    <div class="col-sm-12 text-right show-password">
                                        <label>
                                            <input id="show-password-checbox" type="checkbox">  Afficher mot de passe 
                                        </label>
                                    </div>

                                    <div class="col-sm-12 pb-2 text-center">
                                        <button type="submit" id="confirm-update-password-btn" class="btn organik-btn text-center">
                                            Valider
                                        </button>
                                    </div>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    
</div>
            
