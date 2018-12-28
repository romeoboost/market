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
                                <h3>Les Cotisations</h3>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row volunteer-content reporting-view-table">
                    <div class="col col-md-12">
                        <div class="bio">
                            <div class="box-title">
                                <h3><i class="fa fa-th-list"></i> Liste des cotisations</h3>
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
                               $nbre_mbre = $cotis_nbre;

                            ?>

                            <div class="table-responsive">
                                <table class="table" id="customers">
                                  <tr>
                                    <th>#</th>
                                    <th>Mois</th>
                                    <th>Annee</th>
                                    <th>Montant</th>
                                    <th>Date de création</th>
                                    <th>Actions</th>
                                  </tr>
                                  <?php foreach ($list_cotis as $c): ?>
                                      <tr>
                                        <td><?php echo $nbre_mbre--; ?></td>
                                        <td><?php echo $c->mois; ?></td>
                                        <td><?php echo $c->annee; ?></td>
                                        <td><?php echo $c->montant; ?></td>
                                        <td><?php echo $c->date_creation; ?></td>
                                        <td></td>
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


