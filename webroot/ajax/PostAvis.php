<?php
include 'connectDB.php';
include 'fonction.php';
setlocale(LC_TIME, "fr_FR", "French");
if (empty(session_id())) {
    session_start();
    $_SESSION['menu'] = 'Nous_Rejoindre';
}


$error_statut = false;
$error_text = '';
$error_html = '';
$retour = array();
$result = array();

$conditions_prepare=array();

// sleep(5);
if ($_POST) {
    
    extract($_POST);
    // extract($_FILES)
    // [comment] => TEST ; [author] => TEST ;[email] => test@getdd.ci ;[token] => bbbbbbbbbbb589
    //verifie si tous les champs existent // name_delivrer=TEST&lastname_delivrer=TEST&tel=01040705&email=tst
    if( !isset($comment) || !isset($author) || !isset($email) || !isset($token_produit) ) 
    {
        $error_statut = true;
        $error_text = "Oups, Erreur !";
        $error_text_second = 'Veuillez ne pas modifier la page. Tous les paramètres sont obligatoires';
        //debugger($_POST);
    }else{
        
        //verifie si au moins un champs de filtre est renseigné
        if( empty($comment) || empty($author) || empty($email) || empty($token_produit) )
        {
            $error_statut = true;
            $error_text = "Oups, Erreur !";
            $error_text_second = "Veuillez renseigner correctement les champs obligatoires avant de valider le formulaire"; 
        }else{

            $comment = trim($comment);
            $author = trim($author);
            $email = trim( $email );
            $token_produit = trim( $token_produit );

            //verifie si le produit existe en base
            $req = $pdo->prepare("SELECT * FROM produits WHERE token =:token "); //
            $req->execute( array(':token' => $token_produit ) );
            $product = current($req->fetchAll(PDO::FETCH_OBJ));
            if( empty($product) ){
                $error_statut = true;
                $error_text = "Oups, Erreur !";
                $error_text_second = "Le produit n'existe pas.";
            }else{

                //recupere l'id du produit 
                $id_produit = $product->id;

                //recupere l'id, le nom et prenom du user s'il est en base
                $id_client = isset( $_SESSION['user']['id'] ) ? $_SESSION['user']['id'] : 0;
                $author = isset( $_SESSION['user']['nom'] ) ? $_SESSION['user']['nom'].' '.$_SESSION['user']['prenoms'] : trim($author);
                $email = isset( $_SESSION['user']['email'] ) ? $_SESSION['user']['email'] : trim($email);

                $req = $pdo->prepare(" SHOW TABLE STATUS LIKE 'avis' ");
                $req->execute( array() ); $Mbre_actuel_Obj = current( $req->fetchAll() );
                $Nbre_Product_Actuel = isset($Mbre_actuel_Obj['Auto_increment']) ? intval( $Mbre_actuel_Obj['Auto_increment'] ) : 1;
                //die($Auto_increment);
                $token = getTokenNumber($Nbre_Product_Actuel, 'AM', 'AVS');

                // debugger($token);

                $date = date("Y-m-d H:i:s");

                //insertion du produit en base
                $req_prepare['fields'] = array( 'date_creation', 'date_modification', 'nom', 'prenoms', 'id_client', 'email', 'token', 'contenu', 'id_produit');
                $req_prepare['values'] = array(
                                    'date_creation' => $date,
                                    'date_modification' => $date,
                                    'nom' => $author,
                                    'prenoms' => '',
                                    'id_client' => $id_client,
                                    'email' => $email,
                                    'token' => $token,
                                    'contenu' => $comment,
                                    'id_produit' => $id_produit
                                );
                insert($pdo, $req_prepare, 'avis');

                // debugger($req_prepare);

                // $retour['cmd_id'] = $cmd_id;
                $error_text = ' Succes ! ';
                $error_text_second = "Votre commentaire a été posté. " ;
                $retour['error_text'] = $error_text;
                $retour['error_text_second'] = $error_text_second;
                // $retour['linkToList'] = SITE_BASE_URL.'avis/liste';

            }
            
        }


    }
    
    
}

// debugger($error_statut);
// die();

$retour['error_text'] = $error_text;
$retour['error_text_second'] = $error_text_second;

if ($error_statut) {
    $error_html = '
                    <div class="col-sm-12 alert alert-danger alert-dismissible text-align-center" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <span class="">' . $error_text_second . '</span>
                    </div>  ';
    $retour['error'] = 'oui';
    $retour['error_html'] = $error_html;
    // $retour['field_error'] = $field_error;
    header("Une erreur s'est produite", true, 503);
    //die($error_html);
}
$retour_json = json_encode($retour);

echo $retour_json;
