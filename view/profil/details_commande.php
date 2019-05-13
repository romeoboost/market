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
                        <li><a href="<?php echo BASE_URL.DS.'profil/commandes'; ?>">Mes Commandes</a></li>
                        <li>Détails Commandes</li>
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
                            <li class=""><a href="<?php echo BASE_URL.DS.'profil/modif_password'; ?>">Modifier mot de passe</a></li>
                            <li class="actif"><a href="<?php echo BASE_URL.DS.'profil/commandes'; ?>">Mes commandes</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="row user-data-info-box">
                        <div class="command-details">
                            <div class="col-sm-12 command-details-title mt-1 pl-2">
                                <span>DETAILS DE LA COMMANDE</span>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-12 float-sm-left pt-1 pb-2">Identifiant : 
                                    <span class="user-data-info sexe"><?php echo $command->token; ?></span>
                                </div>
                                <div class="col-sm-12 float-sm-left pb-2">Statut : 
                                    <span class="user-data-info badge
                                     badge-<?php echo $command_status['color']; ?>">
                                        <?php echo $command_status['libele']; ?>
                                    </span>
                                </div>
                                <div class="col-sm-12 float-sm-left pb-2">Montant HT : 
                                    <span class="user-data-info nom">
                                        <?php echo number_format($command->montant_ht, 0, '', ' '); ?> F
                                    </span>
                                </div>
                                <div class="col-sm-12 float-sm-left pb-2">Frais Livraison : 
                                    <span class="user-data-info prenoms">
                                        <?php echo number_format($command->frais_livraison, 0, '', ' '); ?> F
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-12 float-sm-left pt-1 pb-2">Montant total : 
                                    <span class="user-data-info tel">
                                        <?php echo number_format($command->montant_total, 0, '', ' '); ?> F
                                    </span>
                                </div>
                                <div class="col-sm-12 float-sm-left pb-2">Date de création : 
                                    <span class="user-data-info email">
                                        <?php echo dateFormat($command->date_creation); ?>
                                    </span>
                                </div>
                                <?php if( $command->statut == 4){ ?>
                                     <div class="col-sm-12 float-sm-left pb-2">Motif du rejet : 
                                        <span class="user-data-info statut"></span>
                                    </div>           
                                <?php } ?>
                                <?php if( $command->statut == 1){ ?>
                                     <div class="col-sm-12 float-sm-left pb-2">Date de livraison : 
                                        <span class="user-data-info"></span>
                                    </div>          
                                <?php } ?>
                                
                            </div>
                        </div>
                        <div class="shipping-details">
                            <div class="col-sm-12 shipping-details-title mt-1 pl-2">
                                <span>DETAILS DU LIEU DE LIVRAISON</span>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-12 float-sm-left pt-1 pb-2">Nom : 
                                    <span class="user-data-info sexe">
                                        <?php echo $shipping->receiver_name; ?>
                                    </span>
                                </div>
                                <div class="col-sm-12 float-sm-left pb-2">Prénom : 
                                    <span class="user-data-info tel">
                                        <?php echo $shipping->receiver_lastname; ?>
                                    </span>
                                </div>
                                <div class="col-sm-12 float-sm-left pb-2">Teléphone : 
                                    <span class="user-data-info nom">
                                        <?php echo $shipping->receiver_tel; ?>
                                    </span>
                                </div>
                                <div class="col-sm-12 float-sm-left pb-2">Email : 
                                    <span class="user-data-info prenoms">
                                        <?php echo $shipping->receiver_email; ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-12 float-sm-left pb-1 pt-1"> Commune : 
                                    <span class="user-data-info tel">
                                        <?php echo strtoupper( $shipping->dest_commune ); ?>
                                    </span>
                                </div>
                                <div class="col-sm-12 float-sm-left pt-1 pb-2">Quartier : 
                                    <span class="user-data-info email">
                                        <?php echo ucfirst( $shipping->receiver_quartier ); ?>
                                    </span>
                                </div>
                                <div class="col-sm-12 float-sm-left pb-2">Description lieu de livraison : 
                                    <p class="user-data-info statut">
                                        <?php echo $shipping->receiver_description; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="shipping-details">
                            <div class="col-sm-12 shipping-details-title mt-1 pl-2">
                                <span>LISTE DES PRODUITS</span>
                            </div>
                            <div class="col-sm-12 pt-1 pb-1">
                                <table class="list-produits-commands">
                                    <thead>
                                        <tr>
                                            <th>Nom</th>
                                            <th>Nombre</th>
                                            <th>Quantité unitaire vendue</th>
                                            <th>Unité de mésure</th>
                                            <th>Prix quantitié unitaire</th>
                                            <th>Quantité totale</th>
                                            <th>Prix total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($produits as $produit) : ?>
                                            <tr>
                                                <td data-label="Nom"><?php echo ucfirst( $produit->nom_produit ); ?></td>
                                                <td data-label="Nombre"><?php echo $produit->nbre_cmd; ?></td>
                                                <td data-label="Quantité unitaire vendue"><?php echo $produit->qtte_unitaire_cmd; ?></td>
                                                <td data-label="Unité de mésure"><?php echo $unites[$produit->id_unite]; ?></td>
                                                <td data-label="Prix quantitié unitaire"><?php echo number_format( $produit->prix_qtte_unitaire_cmd, 0, '', ' ') ; ?></td>
                                                <td data-label="Quantité totale">
                                                    <?php echo number_format( $produit->nbre_cmd*$produit->qtte_unitaire_cmd, 0, '', ' ') ; ?>
                                                </td>
                                                <td data-label="Prix total">
                                                    <?php 
                                                        echo number_format( $produit->nbre_cmd*$produit->prix_qtte_unitaire_cmd, 0, '', ' ');
                                                    ?>
                                                </td>
                                                
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
</div>
            
