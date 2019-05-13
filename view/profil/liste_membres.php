<div class="volunteer-single">


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
                        <div class="reporting-view-title">
                            <div>
                                <h3>Les Membres</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row volunteer-content reporting-view-stat">
                    <div class="col col-md-12">
                        <div class="info">
                            <div class="box-title">
                                <h3><i class="fa fa-line-chart"></i> Statistiques </h3>
                            </div>
                            <div class="col-md-12 stat-tools">
                                <div class="col-md-4">
                                    <button class="btn btn-warning" type="button">
                                      Total <span class="badge"><?php echo $total; ?></span>
                                    </button>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-success" type="button">
                                      Actifs <span class="badge"><?php echo $actifs; ?></span>
                                    </button>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-danger" type="button">
                                      Non Actifs <span class="badge"><?php echo $nonActifs; ?></span>
                                    </button>   
                                </div>
                            </div>
                          
                        </div>
                    </div>
                </div>

                <div class="row volunteer-content reporting-view-table">
                    <div class="col col-md-12">
                        <div class="bio">
                            <div class="box-title">
                                <h3><i class="fa fa-th-list"></i> Liste des membres</h3>
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
                               //$cotis_nbre = count($list_cotis);
                               $nbre_mbre = $total;

                            ?>

                            <div class="table-responsive">
                                <table class="table" id="customers">
                                  <tr>
                                    <th>#</th>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                    <th>Sexe</th>
                                    <th>Tel</th>
                                    <th>Pays</th>
                                    <th>Metier</th>
                                    <th>Statut</th>
                                    <th>Carte Membre</th>
                                    <th>Numero Membre</th>
                                    <th>Actions</th>
                                  </tr>
                                  <?php foreach ($membres as $m): ?>
                                      <tr>
                                        <td><?php echo $total--; ?></td>
                                        <td><?php echo $m->nomMembre; ?></td>
                                        <td><?php echo $m->prenom; ?></td>
                                        <td><?php echo ($m->sexe == 1) ? 'Homme' : 'Femme'; ?></td>
                                        <td><?php echo $m->tel; ?></td>
                                        <td><?php echo $m->nomPays; ?></td>
                                        <td><?php echo $m->nomMetier; ?></td>
                                        <td><?php echo ($m->statut == 1) ? 'Actif' : 'Non actif'; ?></td>
                                        <td><?php echo ($m->isCarte == 1) ? 'Délivré' : 'Non Délivré'; ?></td>
                                        <td><?php echo $m->nmrMbre; ?></td>
                                        <td><?php echo '' ?></td>
                                      </tr>                                  
                                  <?php endforeach ?>
                                  
                                  
                                  
                                </table>
                            </div>

                        </div>
                    </div>
                </div>


            </div> <!-- end container -->


        </section>
        <!-- end volunteer-single-section -->


    </div>


