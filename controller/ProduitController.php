<?php
class ProduitController extends Controller {

	public function liste($categorie=null, $value_categorie=null, $search=null, $search_value=null){
		$this->loadmodel('Produit');
		$_SESSION['menu'] = 'Marche';
    // debug($_SESSION);
        //$d['categorie_active'] = 'jjhshgfcbcjhj45hhd';
    $d['produits_plus_vendus'] = $this->Produit->findJoin(array(
        'fieldsmain' => array('id_produit'),
        'fieldstwo' => array('nom AS nom_produit','token AS token_produit','quantite_unitaire as qtite_unit', 'id_unite as unite',
            'prix_quantite_unitaire as prix_qtite_unit','slug as slug','nouveau as isnew','promo as ispromo','pourcentage_promo as percent_promo',
            'image as image'),
        'fields' => array(array('main' => 'id_produit','second' => 'id')),
        'group' => 'commandes_produits.id_produit',
        'count' => array('champs' => 'commandes_produits.id' , 'alias' => 'nbre'),
        'order' => array('champs' => 'nbre' , 'param' => 'desc'),
        'limit' => '0,3'
      ),'commandes_produits','produits');

    if(empty($d['produits_plus_vendus'])){
      $d['produits_plus_vendus'] = $this->Produit->findJoin(array(
           'fieldsmain' => array('id AS id','nom AS nom_produit','token AS token_produit','quantite_unitaire as qtite_unit', 'id_unite as unite',
            'prix_quantite_unitaire as prix_qtite_unit','slug as slug','nouveau as isnew','promo as ispromo','pourcentage_promo as percent_promo',
            'image as image'),
            'fieldstwo' => array('nom AS categorie'),
            'fieldsthree' => array('nom AS taille'),
            'fields' => array(
              array(
                'main' => 'id_categorie_produit',
                'second' => 'id'
                )
              ),
              'condition' => 'produits.statut=1 AND categories_produits.statut=1',
              'order' => array('champs' => 'prix_quantite_unitaire','param' => 'ASC'),
              'limit' => '0,3'
            ),'produits','categories_produits');
    }


    

    $d['filter'] = array();
    $d['filter']['status'] = false;
    if(isset($categorie) && isset($value_categorie) && !empty($categorie) && !empty($value_categorie) && 
      strtolower( $value_categorie ) != 'all' ){
      $catName=strtolower($categorie);
      $cat = current($this->Produit->find(array(
          'condition' => array(
            'statut' => 1,
            'token' => $value_categorie
            )
        ),'categories_produits'));
      if(!empty($cat)){
        $d['filter']['categorie']['nom'] = $cat->nom;
        $d['filter']['categorie']['token'] = $cat->token;
        $d['filter']['status'] = true;
      }
    }

    if(isset($search) && isset($search_value) && !empty($search) && !empty($search_value) ){
        $d['filter']['search']['element'] = $search_value;
        $d['filter']['status'] = true;
    }

    $unites_from_bd = $this->Produit->find(array(
          'fields' => array('id','libelle','symbole')
        ),'unites');
      $d['unites'] = array();
      foreach ($unites_from_bd as $u) {
        $d['unites'][$u->id] = $u->symbole;
      }

        $this->set($d);
	}


  public function NbreProduitCateg(){
    $this->loadmodel('Produit');
    $result = $this->Produit->find(array(
          'group' => 'id_categorie_produit',
          'fields' => 'COUNT(id) as nbre, id_categorie_produit'
        ),'produits');
    $d['nbre_produit_categorie'] = array();
    foreach ($result as $u) {
      $d['nbre_produit_categorie'][$u->id_categorie_produit] = $u->nbre;
    }

    return $d['nbre_produit_categorie'];
  }


	public function details($slug=null){
		$this->loadmodel('Produit');
		$_SESSION['menu'] = 'Marche';
		$d = array();
		if( !isset($slug) || empty($slug) ){
			header('Location: '.BASE_URL.DS.'produit/liste');
		}else{
			$d['produit'] = current($this->Produit->findJoin(array(
           'fieldsmain' => array('id AS id','nom AS nom_produit','token AS token_produit','description AS description', 'quantite_unitaire as qtite_unit', 'id_unite as unite',
            'prix_quantite_unitaire as prix_qtite_unit','slug as slug','nouveau as isnew','promo as ispromo','pourcentage_promo as percent_promo',
            'image as image'),
            'fieldstwo' => array('nom AS categorie', 'token AS token_cat'),
            'fields' => array(
              array(
                'main' => 'id_categorie_produit',
                'second' => 'id'
                )
              ),
              'condition' => 'produits.slug="'.$slug.'"'
            ),'produits','categories_produits'));
			
			if( empty($d['produit']) ){
				header('Location: '.BASE_URL.DS.'produit/liste');
			}else{
				$unites_from_bd = $this->Produit->find(array(
				  'fields' => array('id','libelle','symbole')
				),'unites');
				$d['unites'] = array();
				foreach ($unites_from_bd as $u) {
					$d['unites'][$u->id] = $u->symbole;
				}

       $req = [
              'fieldsmain' => ['id as id_avis','id_client as id_c','nom as nom_avis', 'token as token',
              'prenoms as prenoms_avis','email as email_avis', 'contenu as contenu','localisation as localisation', 'date_reponse as date_reponse',
              'statut as statut','page_accueil as page_accueil','date_creation as date_creation','date_modification as date_modification','reponse_admin_contenu as reponse_admin_contenu'],
              'fieldstwo' => ['nom as produit'],
              'fields' => 
                  array( 
                    array(  'main' => 'id_produit',  'second' => 'id' )
                  ),
                'order' => array('champs' => 'avis.id','param' => 'DESC'),
                'condition' => 'produits.token="'.$d['produit']->token_produit.'"'
            ];    
        $d['avis']['list'] = $this->Produit->findJoin( $req, 'avis', 'produits') ;
        $d['avis']['nbre'] = count($d['avis']['list']);
				
			}	
			
		}
		// debug($d['avis']);
	 //    die();			
		$this->set($d);
	}

  public function panier($numeroPanier=null){
    $this->loadmodel('Produit');
    $_SESSION['menu'] = 'Marche';
    $d = array();
    // sdebug($_SESSION);
    // die();
    // $d['list_shipping_destination'] = $this->Produit->find(array(),'livraison_destinations');
    $this->set($d);
  }
	
}

