<?php
class MembreController extends Controller {
    
    public function inscription(){
      $this->loadmodel('Membre');
      $_SESSION['menu'] = 'Nous_Rejoindre';
      $d['list_pays'] = $this->Membre->find(array(
               'condition' => array('actif' => 1)
      ),'pays');
      
      $d['list_metiers'] = $this->Membre->find(array(),'metiers');
      // debug($d['list_metiers']);
      // die();
      $this->set($d);
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



    public function liste_cotisations(){
      $this->loadmodel('Membre');
      $_SESSION['menu'] = 'Nous_Rejoindre';
      $d['list_cotis'] = $this->Membre->find(array( //recupere la liste des cotisations
               'order' => array(
                  'champs' => 'id',
                  'param' => 'DESC')
               ),'cotisations');
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

    private function getStatusDescript($statut){

        $statutPaiement[0]['titre']='Echec';
        $statutPaiement[0]['action']='Reprendre';
        $statutPaiement[0]['description']='Votre précédente transaction a éechoué. veuillez cliquer sur le bouton pour la reprendre.';

        $statutPaiement[1]['titre']='Payé';
        $statutPaiement[1]['action']='';
        $statutPaiement[1]['description']='';

        $statutPaiement[2]['titre']='Echec';
        $statutPaiement[2]['action']='Reprendre';
        $statutPaiement[2]['description']='Votre précédente transaction a éechoué pour insuffisance de fond sur votre solde.
         veuillez cliquer sur le bouton pour la reprendre.';

        $statutPaiement[3]['titre']='Traitement En cours';
        $statutPaiement[3]['action']='Actualiser';
        $statutPaiement[3]['description']='Le traitement de votre transaction est en cours de traitement.';

        $statutPaiement[5]['titre']='Echec';
        $statutPaiement[5]['action']='Reprendre';
        $statutPaiement[5]['description']='Votre précédente transaction n\'a pas abouti. veuillez cliquer sur le bouton pour la reprendre.';

        $statutPaiement[10]['titre']='En attente';
        $statutPaiement[10]['action']='Reprendre';
        $statutPaiement[10]['description']='Votre précédente transaction n\'a pas abouti. veuillez cliquer sur le bouton pour la reprendre.';

        return $statutPaiement[$statut];

    }

    public function deconnecter(){
      unset($_SESSION['user']);
      $_SESSION['menu'] = 'Accueil';
      header('Location: '.BASE_URL.'/accueil/index');
    }

    
    public function getInfo(){
        $this->loadmodel('Choice');
        $d['ecole'] = current($this->Choice->find(array(
               'condition' => array('id' => 1),
               'fields' => 'nom_ecole'
        ),'info'));
        $d['annee'] = current($this->Choice->find(array(
           'condition' => array('statut' => 1),
           'fields' => 'annee'
        ),'annee')); 
        return $d;
    }
    
   
    
}