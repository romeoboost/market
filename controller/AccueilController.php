<?php
class AccueilController extends Controller {
    
    public function index($email_reinit=null, $token_reinit=null){
      $this->loadmodel('Accueil');
      $_SESSION['menu'] = 'Accueil';

      $date = date("Y-m-d H:i:s");
      $d['pubs'] = $this->Accueil->find(array(
           'condition' => " statut=1 and date_debut < '$date' and  date_fin > '$date' ",
           'order' => array('champs' => 'position','param' => 'ASC')
        ),'publicites');
      // die(debug($d['pubs']));

      $d['products'] = $this->Accueil->findJoin(
	  array(
			   'fieldsmain' => array('id AS id','nom AS nom_produit','token AS token_produit','quantite_unitaire as qtite_unit', 'id_unite as unite',
				'prix_quantite_unitaire as prix_qtite_unit','slug as slug','nouveau as isnew','promo as ispromo','pourcentage_promo as percent_promo',
				'image as image'),
				'fieldstwo' => array('nom AS categorie'),
				'fieldsthree' => array('nom AS taille'),
				'fields' => array
					(
					  array(
    						'main' => 'id_categorie_produit',
    						'second' => 'id'
  						)
				  ),
				'condition' => 'produits.statut=1 AND produits.page_accueil=1 AND categories_produits.statut=1',
				'order' => array('champs' => 'prix_quantite_unitaire','param' => 'ASC'),
				'limit' => '0,8'
    ),'produits','categories_produits');
      // die(debug($d['products']));

      $d['avis'] = $this->Accueil->find(array(
          'fields' => array('nom','prenoms','contenu','localisation'),
          'condition' => array('page_accueil' => 1),
        ),'avis');
      //die(debug($d['avis']));

      $unites_from_bd = $this->Accueil->find(array(
          'fields' => array('id','libelle','symbole')
        ),'unites');
      $d['unites'] = array();
      foreach ($unites_from_bd as $u) {
        $d['unites'][$u->id] = $u->symbole;
      }
      $d['client'] = array();

      if(isset($email_reinit) && isset($token_reinit) && !empty($email_reinit) && !empty($token_reinit) ){
        $d['client'] = current($this->Accueil->find(array(
          'condition' => array(
            'email' => $email_reinit,
            'token_password_reinit' => $token_reinit,
            'token_password_reinit_status' => 3
          )
        ),'clients'));
        
      }
      // debug($_SESSION);
      $this->set($d);

    }  

    public function index_old(){
        $this->loadmodel('Accueil');
        $d['annee'] = current($this->Accueil->find(array(
           'condition' => array('statut' => 1)
        ),'annee'));
        $_SESSION['annee'] = $d['annee']->annee;
       if($d['annee']->validate == 0){
          header('Location: '.BASE_URL.'/verrou/authentification'); 
       }
        $d['error'] = '';        
        if(isset($_POST['submit'])){
          if($_POST['login'] && $_POST['pwd']){
              
              $check = current($this->Accueil->find(array(
                  'condition' => array('login' => $_POST['login'])
              ),'users'));
              if(empty($check)){
                 $d['error'] = 'Login ou mot de passe incorrect,<br/> réessayez avec les acces corrects'; 
                 $_SESSION['flash']['danger'] = '<strong>ERROR!!<strong> Login ou mot de passe incorrect, réessayez avec les accès corrects';
              }else{
                  if($check->passwd === $_POST['pwd']){                      
                      $_SESSION['username'] = $check->login; 
                      $_SESSION['userprofil'] = $check->profil;
                      $_SESSION['id_prof'] = $check->id_prof;
                      $_SESSION['id_user'] = $check->id;
                      if($check->profil === 'admin'){   
                          $_SESSION['flash']['success'] = "Vous êtes à présent connecté";
                           header('Location: '.BASE_URL.'/adminClasse/index'); // a ameliorer avec $check[0]->profil
                           exit;
                      }elseif($check->profil === 'utilisateur'){
                           header('Location: '.BASE_URL.'/utilisateur/classe/index');
                      }elseif($check->profil === 'professeur') {
                           header('Location: '.BASE_URL.'/classe/index');
                      }
                  }else{
                    $d['error'] = 'Login ou mot de passe incorrect,<br/> réssayez avec les acces corrects';  
                    $_SESSION['flash']['danger'] = '<strong>ERROR!!<strong> Login ou mot de passe incorrect, réssayez avec les accès corrects';
                  }
              }
          }else{
              $d['error'] = 'Veuillez remplir tous les champs,<br/> s\'il vous plait';
              $_SESSION['flash']['danger'] = '<strong>ERROR!!<strong> Veuillez remplir tous les champs s\'il vous plait';
          }  
        }
       //debug($d);
        $this->set($d);
        
    }
    
    public function deconnect(){
        if(isset($_SESSION['user'])){ 
          unset($_SESSION['user']); 
        }
        header('Location: '.BASE_URL.'/accueil/index');
    }

    public function getCategoryProduit(){
      $this->loadmodel('Accueil');
      $result = $this->Accueil->find(array(
          'condition' => array('statut' => 1)
        ),'categories_produits');
            
      return $result;
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
