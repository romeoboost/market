<?php
class ProfilController extends Controller {
    
    /*Lister les infos du compte du client*/
    public function liste(){
      conf::redir();
      $this->loadmodel('Membre');

      //debug($_SESSION[user]);
      
      $d['user_infos'] = current($this->Membre->find(array(
               'condition' => array('token' => $_SESSION['user']['token'])
               ),'clients'));
      // debug($d['user_infos']);
      // die();
      $this->set($d);
    }

    /*modifier le mot de passe du clients*/
    public function modif_password(){
      conf::redir();
      $this->loadmodel('Membre');
      $d['user_infos'] = current($this->Membre->find(array(
               'condition' => array('token' => $_SESSION['user']['token'])
               ),'clients'));
      // debug($d['user_infos']);
      // die();
      $this->set($d);
    }

    public function commandes(){
      conf::redir();
      $this->loadmodel('Membre');
      //0=en attente ; 1=livré ; 2=annulé ; 3=en cours de livraison; 4=rejeté
      //definition des statuts de commande
      $d['command_status_desc'][0]['libele']='en attente';
      $d['command_status_desc'][0]['color']='info';

      $d['command_status_desc'][1]['libele']='livrée';
      $d['command_status_desc'][1]['color']='success';

      $d['command_status_desc'][2]['libele']='annulée';
      $d['command_status_desc'][2]['color']='danger';

      $d['command_status_desc'][3]['libele']='en cours de livraison';
      $d['command_status_desc'][3]['color']='warning';

      $d['command_status_desc'][4]['libele']='rejetée';
      $d['command_status_desc'][4]['color']='Secondary';

      $user = current($this->Membre->find(array(
               'condition' => array('token' => $_SESSION['user']['token'])
               ),'clients'));      

      //recuperation des commandes
      $d['users_commands'] = $this->Membre->find(array( // recupere la liste des paiements de corisation pour le membre
            'condition' => array( 'id_client' => $user->id ),
            'order' => array( 'champs' => 'id', 'param' => 'DESC')
          ),'commandes');
      
      // debug($d['user_infos']);
      // die();
      $this->set($d);
    }

    public function details_commande($token_commande=null){
      conf::redir();
      $this->loadmodel('Membre');
      $d= array();
      if( !isset($token_commande) || empty($token_commande) ){
        header('Location: '.BASE_URL.DS.'accueil/index');
      }else{
        $token_commande = trim($token_commande);
        // recuperation de la commande
        $d['command'] = current( $this->Membre->find( array( 
            'condition' => array( 'token' => $token_commande ),
            'order' => array( 'champs' => 'id', 'param' => 'DESC')
          ),'commandes') );

        //verifie si la comande existe bien en base
        if( empty($d['command']) ){
          header('Location: '.BASE_URL.DS.'accueil/index');
        }else{
          //recuperation du statut
          $d['command_status'] = $this->getStatusCommand($d['command']->statut);

          $d['shipping'] = current( $this->Membre->findJoin(array(
            'fieldsmain' => array(' id AS receiver_id','nom AS receiver_name','prenoms AS receiver_lastname',
              'tel AS receiver_tel','email AS receiver_email',' quartier AS receiver_quartier',
              'description AS receiver_description'),
            'fieldstwo' => array('token AS dest_token','commune AS dest_commune','frais AS frais_commune'),
            'fields' => array( array('main' => 'id_destination','second' => 'id') ),
            'order' => array('champs' => 'shipping_infos.id' , 'param' => 'desc'),
            'condition' => 'shipping_infos.id_commande='.$d['command']->id,
            'limit' => '0,1'
          ),'shipping_infos','livraison_destinations') );

          //recupération list de produits
          $d['produits'] = $this->Membre->findJoin(array(
            'fieldsmain' => array('id_commande AS id_cmd','quantite AS nbre_cmd','qtte_unitaire AS qtte_unitaire_cmd',
              'prix_qtte_unitaire AS prix_qtte_unitaire_cmd'),
            'fieldstwo' => array( 'id AS id_produit','nom AS nom_produit','token AS token','id_unite as id_unite',
              'quantite_unitaire AS quantite_unitaire_produit','prix_quantite_unitaire AS prix_quantite_unitaire',
              'image AS image','promo AS promo','pourcentage_promo AS pourcentage_promo'),
            'fields' => array( array('main' => 'id_produit','second' => 'id') ),
            'order' => array('champs' => 'commandes_produits.quantite' , 'param' => 'desc'),
            'condition' => 'commandes_produits.id_commande='.$d['command']->id
          ),'commandes_produits','produits');

          //recuperer les unité de mésure
          $unites_from_bd = $this->Membre->find(array(
              'fields' => array('id','libelle','symbole')
            ),'unites');
          $d['unites'] = array();
          foreach ($unites_from_bd as $u) {
            $d['unites'][$u->id] = ($u->symbole == 'NA') ? 'nombre' : $u->symbole;
          }

        }
      }
      //debug($d);
      $this->set($d);

    }

    /*
    *params 
    * @id_status (type=>integer, desc=> status id of command)
    *Response
    * @array of status description and color
    */
    private function getStatusCommand($id_status){
      $d['command_status_desc'][0]['libele']='en attente';
      $d['command_status_desc'][0]['color']='info';

      $d['command_status_desc'][1]['libele']='livrée';
      $d['command_status_desc'][1]['color']='success';

      $d['command_status_desc'][2]['libele']='annulée';
      $d['command_status_desc'][2]['color']='danger';

      $d['command_status_desc'][3]['libele']='en cours de livraison';
      $d['command_status_desc'][3]['color']='warning';

      $d['command_status_desc'][4]['libele']='rejetée';
      $d['command_status_desc'][4]['color']='Secondary';

      return $d['command_status_desc'][$id_status];
    }

    public function espace_personnel(){
      $this->loadmodel('Membre');
      $_SESSION['menu'] = 'Nous_Rejoindre';
      if(isset($_SESSION['user'])){        
        $d['pays'] = current($this->Membre->find(array(
               'condition' => array('id' => $_SESSION['user']['id_pays'])
               ),'pays'));
        $d['metier'] = current($this->Membre->find(array(
               'condition' => array('id' => $_SESSION['user']['id_metier'])
               ),'metiers'));
        $d['poste'] = current($this->Membre->find(array(
               'condition' => array('id' => $_SESSION['user']['id_poste'])
               ),'postes'));

        $id_membre = isset($_SESSION['user']['id']) ? $_SESSION['user']['id'] : 31;
        
        $d['signUp'] = current($this->Membre->find(array(
               'condition' => array(
                  'id_membre' => $id_membre,
                  'type' => 1),
               'order' => array(
                  'champs' => 'id',
                  'param' => 'DESC')
               ),'paiements'));

        $d['statutPaiement'] = getStatus($d['signUp']->statut_id); //recupere la description du statut

        $d['list_cotis'] = $this->Membre->find(array( //recupere la liste des cotisations
               'order' => array(
                  'champs' => 'id',
                  'param' => 'DESC')
               ),'cotisations');


        $d['paiements_cotis'] = $this->Membre->find(array( // recupere la liste des paiements de corisation pour le membre
            'condition' => array(
                  'id_membre' => $id_membre,
                  'type' => 2),
               'order' => array(
                  'champs' => 'id',
                  'param' => 'DESC')
          ),'paiements');

          $d['descriptStatutMbre'][0] = 'Non Actif'; 
          $d['descriptStatutMbre'][1] = 'Actif'; 
          $d['descriptStatutMbre'][3] = 'Non A Jour'; 
          $d['descriptStatutMbre'][4] = 'Desactivé'; //tableau de statut des membre


      }else{
        header('Location: '.BASE_URL.'/accueil/index');
      }
      /*$d['transac'] = current($this->Membre->find(array(
               'condition' => array('order_id' => $order_id)
                ),'paiements'));*/
      /*debug($d);
      die();*/
      $this->set($d);
    }

    public function liste_membres(){
      $this->loadmodel('Membre');
      $_SESSION['menu'] = 'Nous_Rejoindre';
      $d['membres'] = $this->Membre->findJoin(array( //recuperer l'educateur
                        'fieldsmain' => array('id AS idm','nom AS nomMembre','prenom AS prenom','sexe AS sexe', 'date_naissance AS dt_birth',
                                              'ville AS ville', 'email AS email', 'tel AS tel', 'date_creation AS dt_crea',
                                              'statut AS statut', 'id_profil AS idP', 'carte_membre AS isCarte', 'numero_membre AS nmrMbre',
                                              'id_poste AS idPoste'),
                        'fieldstwo' => array('id AS idPays','nom AS nomPays','actif AS isPaysActif'),
                        'fieldsthree' => array('id AS idMetier','designation AS nomMetier','domaine AS domaine'),
                        'fields' => array(array(
                            'main' => 'id_pays',
                            'second' => 'id'),
                            array(
                             'main' => 'id_metier',
                             'third' => 'id'  
                            )),
                        'order' => array(
                            'champs' => 'membres.id',
                            'param' => 'DESC'
                          ),
                        'limit' => '0,100'
                    ),'membres','pays','metiers');

      $d['total'] = $this->Membre->findCountAll('membres');
      $d['actifs'] = $this->Membre->findCount('statut=1','membres');
      $d['nonActifs'] = $this->Membre->findCount('statut !=1','membres');

      /*debug($d);
      die();*/
      $this->set($d);
    }

    public function liste_paiements(){
      $this->loadmodel('Membre');
      $_SESSION['menu'] = 'Nous_Rejoindre';
      $d['paiements'] = $this->Membre->findJoinType(array( //recuperer l'educateur
                        'fieldsmain' => array('id AS idP','order_id AS order_id','transaction_amount AS montant','statut_id AS statut', 'wallet AS wallet',
                                              'type AS type', 'date_modification AS date', 'id_membre AS idm'),
                        'fieldstwo' => array('mois AS moisCoti','annee AS anneeCoti'),
                        'fieldsthree' => array('nom AS nomMembre','prenom AS prenom','tel AS tel'),
                        'fields' => array(array(
                            'main' => 'id_cotisation',
                            'second' => 'id',
                            'type' => 'LEFT JOIN'),
                            array(
                             'main' => 'id_membre',
                             'third' => 'id',
                             'type' => 'INNER JOIN'  
                            )),
                        'order' => array(
                            'champs' => 'paiements.id',
                            'param' => 'DESC'
                          ),
                        'limit' => '0,100'
                    ),'paiements','cotisations','membres');
      
      $d['totalNombre'] = $this->Membre->findCountAll('paiements');
      $d['totalSuccesNombre'] = $this->Membre->findCount('statut_id=1','paiements');
      $d['totalMontant'] = $this->Membre->findSum('statut_id=1', 'transaction_amount', 'paiements');

      $d['inscriptSuccesNombre'] = $this->Membre->findCount('statut_id=1 AND type=1','paiements');      
      $d['inscriptSuccesMontant'] = $this->Membre->findSum('statut_id=1 AND type=1', 'transaction_amount', 'paiements');

      $d['cotiSuccesNombre'] = $this->Membre->findCount('statut_id=1 AND type=2','paiements');      
      $d['cotiSuccesMontant'] = $this->Membre->findSum('statut_id=1 AND type=2', 'transaction_amount', 'paiements');

      /*debug($d);
      die();*/
      $this->set($d);
    }

 
    
    
   
    
}
