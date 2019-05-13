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
                                <h3>Les Paiements</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row volunteer-content reporting-view-stat-payment">
                    <div class="col col-md-12">
                        <div class="info">
                            <div class="box-title">
                                <h3><i class="fa fa-line-chart"></i> Statistiques </h3>
                            </div>
                            <div class="col-md-12 stat-tools">
                                <div class="col-md-4">
                                    <button class="btn btn-basic" type="button">
                                      Nombre Total succès <span class="badge">
                                      <?php echo $totalSuccesNombre; ?></span>
                                    </button>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-primary" type="button">
                                      Nombre cotisation succès <span class="badge">
                                      <?php echo $cotiSuccesNombre; ?></span>
                                    </button>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-info" type="button">
                                      Nombre Inscription succès <span class="badge">
                                      <?php echo $inscriptSuccesNombre; ?></span>
                                    </button>   
                                </div>
                            </div>

                            <div class="col-md-12 stat-tools">
                                <div class="col-md-4">
                                    <button class="btn btn-basic" type="button">
                                      Montant Total succès <span class="badge">
                                      <?php echo empty($totalMontant) ? '0' : $totalMontant; ?> F CFA</span>
                                    </button>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-primary" type="button">
                                      Montant cotisations succès <span class="badge">
                                      <?php echo empty($inscriptSuccesMontant) ? '0' : $inscriptSuccesMontant; ?> F CFA</span>
                                    </button>
                                </div>
                                <div class="col-md-4">
                                    <button class="btn btn-info" type="button">
                                      Montant Inscriptions succès <span class="badge">
                                      <?php echo empty($cotiSuccesMontant) ? '0' : $cotiSuccesMontant; ?> F CFA</span>
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
                                <h3><i class="fa fa-th-list"></i> Liste des Paiements</h3>
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
                               $total = $totalNombre;

                            ?>

                            <div class="table-responsive">
                                <table class="table" id="customers">
                                  <tr>
                                    <th>#</th>
                                    <th>Membre</th>
                                    <th>Tel</th>                                    
                                    <th>Type</th>
                                    <th>Mois</th>                                    
                                    <th>Montant</th>
                                    <th>N° Transac</th>
                                    <th>Statut</th>
                                    <th>Date</th>
                                  </tr>
                                  <?php foreach ($paiements as $p): ?>
                                      <tr>
                                        <td><?php echo $total--; ?></td>
                                        <td><?php echo $p->nomMembre.' '.$p->prenom; ?></td>
                                        <td><?php echo $p->tel; ?></td>
                                        <td><?php echo ($p->type == 1) ? 'Inscription' : 'Cotisation'; ?></td>
                                        <td><?php echo $p->moisCoti.' '.$p->anneeCoti; ?></td>
                                        <td><?php echo $p->montant; ?></td>
                                        <td><?php echo $p->order_id; ?></td>
                                        <td><?php echo getStatus($p->statut)['titre']; ?></td>
                                        <td><?php echo $p->date; ?></td>
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


