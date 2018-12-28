 <!-- start page-title -->    
        <section class="inscription page-title">
            <div class="page-title-bg"></div>
            <div class="container">
                <div class="title-box">
                    <h1>Nous REJOINDRE</h1>
                    <ol class="breadcrumb">
                        <li><a href="#">Inscription</a></li>
                        <li class="active">Formulaire</li>
                    </ol>
                </div>
            </div> <!-- end container -->
        </section>
<!-- end page-title -->

 <!-- start contact-main-content -->
        <section class="inscription-form contact-main-content ">
             <!-- end container -->

            <div class="row map-concate-form">
                <div class="col col-xs-12">
                    <div class="map" id="map"></div>
                </div>
                <div class="contact-form">
                    <div class="container">
                        <div class="row  wow bounceInUp">
                            <div class="col col-md-10 col-md-offset-1 form-inner">
                                <h3>Remplissez le formulaire ci-dessous</h3>
                                <span>Note : Les Frais d'adhésion pour devenir un membre de cette grande association 
                                    s'élève à seulement 6500 FCFA.</span>
                                
                                <form class="form row" id="contact-form" method="POST" action="http://crossroadtest.net:6968/withdraw">
                                    <h5>Les champs avec l'astérix(*) sont des champs obligatoires.</h5>
                                    <div class="col col-md-6">
                                        <input type="text" class="form-control" name="first_name" placeholder="Nom*">
                                    </div>
                                    <div class="col col-md-6">
                                        <input type="text" class="form-control" name="last_name" placeholder="Prénoms*">
                                    </div>
                                    <div class="col col-md-6">
                                        <input type="text" class="form-control number" maxlength="8" name="tel" placeholder="Téléphone*">
                                    </div>
                                    <div class="col col-md-6">
                                        <input type="email" class="form-control" name="email" placeholder="Adresse email">
                                    </div>
                                    <!--  <div class="col col-md-6">
                                        <input type="text" class="form-control" name="country" placeholder="Pays*">
                                    </div>  -->

                                    <div class="col col-md-6">
                                        <select class="form-control required" name="country" placeholder="">
                                            <option value=""> Choisissez votre pays dans la liste* </option>
                                            <?php foreach ($list_pays as $pays): ?>
                                                <option value="<?php echo $pays->id;  ?>"> <?php echo $pays->nom  ?> </option>
                                            <?php endforeach ?>
                                        </select>    
                                    </div>

                                    <div class="col col-md-6">
                                        <input type="text" class="form-control" required name="town" placeholder="Ville*">
                                    </div>
                                    <div class="col col-md-12">
                                        <select class="form-control required" name="work" placeholder="">
                                            <option value=""> Choisissez votre métier dans la liste* </option>
                                            <?php foreach ($list_metiers as $metier): ?>
                                                <option value="<?php echo $metier->id;  ?>"> <?php echo $metier->designation;  ?> </option>
                                            <?php endforeach ?>
                                        </select>    
                                    </div>
                                    <div class="col col-md-12">
                                        <textarea class="form-control" read-only name="work_description" placeholder="description du métier"></textarea>
                                    </div>
                                    <div class="col col-md-6">
                                        <input type="password" class="form-control" name="password" placeholder="Entrez votre mot de passe*">
                                    </div>
                                    <div class="col col-md-6">
                                        <input type="password" class="form-control" name="confirm_password" placeholder="Confirmez mot de passe*">
                                        <input name="operation_token" hidden value="hgdsttdf-b845-78c9-4hg7-74mpoef114ui" type="text"/>
                                        <input name="order" hidden placeholder="montant" value="<?php echo '';  ?>" type="text" />
                                        <input name="jwt" hidden value="<?php echo ''  ?>" type="text" />
                                        <input name="currency" hidden value="XOF" type="text" />
                                        <input name="transaction_amount" hidden placeholder="montant" type="text" />
                                    </div>
                                    <div class="col col-md-12">
                                        <button type="submit" id="sign_up_btn" class="bnt theme-btn">Valider</button>
                                        <span id="loader"><img src="http://localhost/ASSOS/webroot/images/contact-ajax-loader.gif" alt="Loader"></span>
                                    </div>
                                    
                                    <div class="col col-md-12">
                                        <div id="success">Inscription effectuée avec succès</div>
                                        <div id="error">Une erreur est survenue. Veuillez reessayer svp. </div>
                                    </div>
                                </form>
                            </div>
                        </div> <!-- end row -->
                    </div> <!-- end container -->
                </div>
            </div>
        </section>
        <!-- end contact-main-content -->
