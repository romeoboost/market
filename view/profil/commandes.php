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
                        <li>Mes commandes</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


    <div class="section pt-5 mb-12">

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
                    <div class="row user-data-info-box pt-1 pl-1 pr-1 pb-1">
                        <table class="list-commands">
                            <thead>
                                <tr>
                                        <th>#</th>
                                        <th>Identifiant</th>
                                        <th>Montant HT</th>
                                        <th>Frais Livraison</th>
                                        <th>Montant total</th>
                                        <th>Statut</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                </tr>
                            </thead>                            
                            <tbody>
                                <?php if( empty( $users_commands ) ) { ?>
                                    <div class="col-sm-12 text-center">
                                        <div class="commerce">
                                            <p class="cart-empty"> Votre panier est vide.</p>
                                            <a class="organik-btn small" href="<?php echo BASE_URL.DS.'produit/liste'; ?>"> Retourner au marché </a>
                                        </div>
                                    </div>
                                <?php }else{ ?>
                                    <?php $cmd_number= count($users_commands); ?>
                                        <?php foreach ($users_commands as $command) : ?>
                                            <tr>
                                                <td data-label="#"><?php echo $cmd_number-- ; ?></td>
                                                <td data-label="Identifiant" class="token-command">
                                                    <span class="token-command-value"><?php echo $command->token; ?></span>
                                                    
                                                </td>
                                                <td data-label="Montant HT"><?php echo number_format($command->montant_ht, 0, '', ' '); ?></td>
                                                <td data-label="Frais Livraison"><?php echo number_format($command->frais_livraison, 0, '', ' '); ?></td>
                                                <td data-label="Montant total"><?php echo number_format($command->montant_total, 0, '', ' '); ?></td>
                                                <td data-label="Statut" class="command-status">
                                                    <span class="badge badge-<?php echo $command_status_desc[$command->statut]['color']; ?>">
                                                        <?php echo $command_status_desc[$command->statut]['libele']; ?>
                                                    </span>
                                                </td>
                                                <td data-label="Date"><?php echo dateFormat($command->date_creation); ?></td>
                                                <td data-label="Actions">
                                                    <a token-command="<?php echo $command->token; ?>"
                                                        data-toggle="tooltip" data-placement="top" title="Voir les détails de la commandes."
                                                        href="<?php echo BASE_URL.DS.'profil/details_commande/'. $command->token; ?>" class="details-commande float-left">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <?php if( $command->statut == 0){ ?>
                                                        <a token-command="<?php echo $command->token; ?>" 
                                                           data-toggle="tooltip" data-placement="bottom" title="Annuler la commande." 
                                                           href="#" class="annuler-commande float-right">
                                                            <i class="fa fa-times-circle-o"></i>
                                                        </a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>
            
