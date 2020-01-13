<?php
include 'connectDB.php';
include 'fonction.php';

if (empty(session_id())) {
    session_start();
    //$_SESSION['menu'] = 'Nous_Rejoindre';
}

$error_statut = false;
$error_text = '';
$error_text_second = '';
$field_error ='none';
$retour = array();
//$retour['enregistrement'] = 'non';

if(!isset($_POST) || empty($_POST) ){
  $error_statut = true;
  $error_text = "Oups, Erreur !";
  $error_text_second = 'Veuillez ne pas modifier la page';
}else{
  // debugger($_FILES);
  extract($_POST);
  extract($_FILES);

  // userT=00000000&nom=test&prenoms=etsts&tel=0244444&email=ghedcf&description_commande=zcsduchgsdu&
  // lieu_livraison=mooc45dddcddd&quartier=Texas%20Grillz%2C%20Abidjan%2C%20C%C3%B4te%20d'Ivoire&
  // description_lieu_livraison=GETE&loc_lat=5.3485508&loc_long=-3.9769608999999946'

  if( !isset($userT) || !isset($nom) || !isset($prenoms) || !isset($tel) || !isset($email) || !isset($lieu_livraison) || !isset($quartier)
   || !isset($description_lieu_livraison) || !isset($loc_lat) || !isset($loc_long) || !isset($description_commande) 
   || !isset($image_list)) //verifie si tous les champs existent
  {
    $error_statut = true;
    $error_text = "Oups, Erreur !";
    $error_text_second = 'Veuillez ne pas modifier la page. Tous les paramètres sont obligatoires';
    // debugger($_FILES);
  }else{
    if( empty($userT) || empty($nom) || empty($prenoms) || empty($tel) || empty($email) || empty($lieu_livraison) 
    || empty($quartier) || ( strlen($description_commande)==0 && empty($image_list['name']) ) )
    {
      $error_statut = true;
      $error_text = "Oups, Erreur !";
      $error_text_second = 'Veuillez remplir correctement le formulaire. Aucun champs obligatoire ne doit être vide.';
      if( strlen($description_commande)==0 && strlen($image_list['name'])==0 ){
        $error_text_second = 'Les champs "Description de la Commande" et "Image de liste de Produits" ne peuvent être vide tous les deux. Au moins un champs doit être renseigné.';
      }
      
    }else{
      // debugger('je suis passé');
      //vérification Image
      $image_good = true;
      //Verifie si une nouvelle image a été chargée
      if( empty($image_list['name']) ){ // si non
          $image_good = true; // dire que c'est ok pour les images
          $image_name = "";
      }else{  // si oui
        // debugger($_FILES); 
        $image_finale = upload( $image_list, 300, 300 ); 
        // verifie que l'image est au bon format
        if( !$image_finale ){ //si non 
            $error_statut = true; //renvoi erreur 
            $error_text = "Oups, Erreur !"; //renvoi erreur 
            $error_text_second = "Veuillez entrer une image valable."; //renvoi erreur 
            $image_good = false; //dire que c'est pas ok pour l'image
        }else{ //si oui
            $time = time();
            $image_name = md5( $time );

            //image principale du produit
            imagejpeg($image_finale, WEBROOT_FRONT_DIR. 'images/quick_order/' . $image_name . '.jpg'); //copie les images sur le serveur

            //image thumbs du produit
            $image_finale_thumbs = upload( $image_list, 180, 180 );
            imagejpeg($image_finale_thumbs, WEBROOT_FRONT_DIR. 'images/quick_order/thumb/' . $image_name . '.jpg'); //copie les images sur le serveur

            //image Large du produit
            $image_finale_large = upload( $image_list, 570, 570 );
            imagejpeg($image_finale_large, WEBROOT_FRONT_DIR. 'images/quick_order/large/' . $image_name . '.jpg'); //copie les images sur le serveur
            $image_good = true; // dire que c'est ok pour l'image 
        }
      }

      if( $image_good ){
         //verification lieu de livraison (commune)
        $lieu_livraison = trim($lieu_livraison);
        $req_recup = $pdo->prepare('SELECT * FROM livraison_destinations WHERE token = :token ORDER BY id DESC LIMIT 0,1'); 
        $req_recup->execute( array( ':token' => $lieu_livraison ) );
        $lieu_shipping = current($req_recup->fetchAll(PDO::FETCH_OBJ));

        if( empty($lieu_shipping) ){
            $error_statut = true;
            $error_text = "Oups, Erreur !";
            $error_text_second = 'Veuillez choisir une commune de livraison dans la liste.';
        }else{
          //verifier que le client existe en base
          
          $req_recup = $pdo->prepare('SELECT * FROM clients WHERE token = :token ORDER BY id DESC LIMIT 0,1'); 
          $req_recup->execute( array( ':token' => $userT ) );
          $client = current($req_recup->fetchAll(PDO::FETCH_OBJ));

          $id_client = empty($client) ? 0 : $client->id;
          // debugger($id_client);
          $montant_cmde_HT = 0;
          $montant_cmde_TT = 0;
          $frais_livraison = 0;

          $date = date("Y-m-d H:i:s");

          //generation de token de commande rapide
          $req = $pdo->prepare(" SHOW TABLE STATUS LIKE 'rapide_commandes' ");
          $req->execute( array() ); $Mbre_actuel_Obj = current( $req->fetchAll() );
          $Nbre_Product_Actuel = isset($Mbre_actuel_Obj['Auto_increment']) ? intval( $Mbre_actuel_Obj['Auto_increment'] ) - 1 : 0;
                              
          $token_cmde = getCmdeNumber($Nbre_Product_Actuel, 'QCD');

          //insertion du produit en base
          $req_prepare['fields'] = array('token', 'id_client', 'statut', 'montant_ht', 'frais_livraison', 'montant_total',
          'image_link', 'description_commande', 'id_livraison_destination', 'date_creation', 'date_modification');
          $req_prepare['values'] = array(
                              'token' => $token_cmde,
                              'id_client' => $id_client,
                              'statut' => 0,
                              'montant_ht' => $montant_cmde_HT,
                              'frais_livraison' => $frais_livraison,
                              'montant_total' => $montant_cmde_TT,
                              'image_link' => $image_name,
                              'description_commande' => $description_commande,
                              'id_livraison_destination' => $lieu_shipping->id,
                              'date_creation' => $date,
                              'date_modification' => $date
                          );
          insert($pdo, $req_prepare, 'rapide_commandes');

          //récupération de l'id de la commande
          $req_recup = $pdo->prepare('SELECT id FROM rapide_commandes WHERE token = :token ORDER BY id DESC LIMIT 0,1'); 
          $req_recup->execute( array( ':token' => $token_cmde ) );
          $cmde_inserted = current($req_recup->fetchAll(PDO::FETCH_OBJ));

          //-- insertion dans la table shipping_infos
          $date = date("Y-m-d H:i:s");
          $loc_lat = strlen($loc_lat) == 0 ? 0 : $loc_lat ;
          $loc_long = strlen($loc_long) == 0 ? 0 : $loc_long ;
          
          $req_prepare = array();
          $req_prepare['fields'] = array('id_client', 'id_commande_rapide', 'nom', 'prenoms', 'tel', 'email','id_destination',
            'quartier', 'longitude', 'lagitude', 'description', 'date_creation', 'date_modification');

          $req_prepare['values'] = array(
            'id_client' => $id_client,
            'id_commande_rapide' => $cmde_inserted->id,
            'nom' => $nom,
            'prenoms' => $prenoms,
            'tel' => $tel,
            'email' => $email,
            'id_destination' => $lieu_shipping->id,
            'quartier' => trim( $quartier ),
            'longitude' => $loc_lat,
            'lagitude' => $loc_long,
            'description' => $description_lieu_livraison,
            'date_creation' => $date,
            'date_modification' => $date
          );
          
          insert($pdo, $req_prepare, 'shipping_infos');

          $error_text = 'Commande enregistrée avec Succès. <br>Numero de commande : '.$token_cmde;
          $error_text_second = 'Vous serez livré dans un délais de 24H.';

        }

      }

    }
  }
  
}
//echo 'ALL <pre>';print_r($_POST);echo '</pre>';

$retour['error_text'] = $error_text;
$retour['error_text_second'] = $error_text_second;

$retour['error'] = 'non';
$retour['error_html'] = '';

if ($error_statut) {
    $error_html = '
                    <div class="col-sm-12 alert alert-danger alert-dismissible " role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <span class="">' . $error_text . '</span>
                    </div>  ';
    $retour['error'] = 'oui';
    //$retour['error_html'] = $error_html;
    $retour['field_error'] = $field_error;
    header('Operation echouée', true, 400);
    //die($error_html);
}
$retour_json = json_encode($retour);

echo $retour_json;

/**
 * Modification sur la bd (11-12-2019)
 * ALTER TABLE `shipping_infos` ADD `longitude` VARCHAR(255) NOT NULL AFTER `quartier`;
 * ALTER TABLE `shipping_infos` ADD `lagitude` VARCHAR(255) NOT NULL AFTER `quartier`;
 * ALTER TABLE `shipping_infos` CHANGE `lagitude` `lagitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0', CHANGE `longitude` `longitude` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0';
 * 
 * 
 * Modification sur la bd (17-12-2019)
 * ALTER TABLE `shipping_infos` CHANGE `id_commande` `id_commande` INT(100) NULL;
 * ALTER TABLE `shipping_infos` ADD `id_commande_rapide` INT(100) NULL AFTER `id_commande`;
 */



