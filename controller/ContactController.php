<?php
class ContactController extends Controller {
    
    public function index(){
      $this->loadmodel('Accueil');
      $_SESSION['menu'] = 'Contact';
      //debug($_SERVER);
      //die();
      $d['pubs'] = $this->Accueil->find(array(
           'condition' => array('statut' => 1),
           'order' => array('champs' => 'position','param' => 'ASC')
        ),'publicites');
      //die(debug($d['pubs']));

      //die(debug($d['unites']));
      $this->set($d);

    }  

    

//    public function getAnnee(){
//        $this->loadmodel('Choice');
//        $d['ecole'] = current($this->Choice->find(array(
//               'condition' => array('id' => 1),
//               'fields' => 'nom_ecole'
//        ),'info'));
//        $d['annee'] = current($this->Choice->find(array(
//           'condition' => array('statut' => 1),
//           'fields' => 'annee'
//        ),'annee')); 
//        return $d;
//    }
    
    
}
