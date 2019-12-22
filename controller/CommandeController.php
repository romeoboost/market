<?php
class CommandeController extends Controller {

	public function liste($categorie=null, $value_categorie=null){
    conf::redir();
		$this->loadmodel('Produit');
		$_SESSION['menu'] = 'Marche';

    //$d['categorie_active'] = 'jjhshgfcbcjhj45hhd';
    
    $d['filter'] = array();
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


	public function details(){
		$this->loadmodel('Produit');
		$_SESSION['menu'] = 'Marche';
		
    $d['list_shipping_destination'] = $this->Produit->find(array(),'livraison_destinations');
    $this->set($d);
	}

  public function panier($numeroPanier=null){
    $this->loadmodel('Produit');
    $_SESSION['menu'] = 'Marche';
    
    $d['list_shipping_destination'] = $this->Produit->find(array(),'livraison_destinations');
    $this->set($d);
  }

  public function getShippingDestination(){
    $this->loadmodel('Produit');
		
    $list_shipping_destination = $this->Produit->find(array(),'livraison_destinations');
    return $list_shipping_destination;
  }
	
}

