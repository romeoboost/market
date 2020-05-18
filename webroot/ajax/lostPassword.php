<?php
include 'connectDB.php';
include 'fonction.php';
if (empty(session_id())) {
    session_start();
    $_SESSION['menu'] = 'Nous_Rejoindre';
}

$error_statut = false;
$error_text = '';
$error_html = '';
$retour = array();
$retour['connected'] = 'non';

if ($_POST) {
    
    $post_element_normal = array('lost_email');
    $post_element_orig = array();
    $post_element_orig = array_keys($_POST); //nom des inputs venant du form
    $result = array_diff($post_element_normal, $post_element_orig);
    $error_text = '';
    $error_html = '
<div class="col-sm-12 alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <span class="">' . $error_text . '</span>
                                </div>        
';
    if (empty($result)) {//si les noms des input sont corrects
        // var_dump($_POST);
        // die();
        foreach ($_POST as $n => $v) {
            if (empty($v)) {//verifie si les champs text ne sont pas vides
                $error_statut = true;
                $error_text = "Aucun champs ne doit être vide.";
            }
        }
        if (!$error_statut) {
            extract($_POST);
            // debugger( $_POST );
            $lost_email = trim($lost_email);
            $req = $pdo->prepare("SELECT * FROM clients WHERE email=:email "); //':email' => $user_login,
            $req->execute( array( ':email' => $lost_email) );
            
            $client = current($req->fetchAll(PDO::FETCH_OBJ));
            // debugger( $client );
            if (empty($client)) {
                if(isset($_SESSION['user'])){ unset($_SESSION['user']); }
                $error_statut = true;
                $error_text = "L'adresse e-mail n'est pas correct."; //, réessayez avec les acces corrects
            } else {
                if($client->statut==1){ // verifie si le client est actif
                    //Génération du token de réinitialisation de mot de passe
                    $time = time(); $token_one = md5( $time ); $token_two = md5( $lost_email ); 
                    $token = $token_one.$token_two;
                    // debugger( $token );
                    //Insertion en base 
                    $date = date("Y-m-d H:i:s");
                    $update_req = $pdo->prepare("   UPDATE clients 
                                                    SET token_password_reinit = :token_password_reinit, 
                                                        token_password_reinit_status = :token_password_reinit_status,
                                                        is_password_reinit = :is_password_reinit,
                                                        date_token_reinit_password = :date_token_reinit_password,
                                                        date_modification = :date_modification
                                                    WHERE id = :id "
                                                ); 
                    $update_req->execute( 
                                            array( 
                                                ':token_password_reinit' => $token,
                                                ':token_password_reinit_status' => 3,
                                                ':is_password_reinit' => 3,
                                                ':date_token_reinit_password' => $date,
                                                ':date_modification' => $date,
                                                ':id' => $client->id
                                            ) 
                                        );
                    //Envoi de mail
                    $to = htmlentities($client->email);
                    $Subject = 'REINITIALISATION DE MOT DE PASSE';
                    $message = get_reinit_password_mail_body (htmlentities($client->nom), $token, SITE_BASE_URL.'accueil/index/'.htmlentities($client->email) );
                    $reponse_send_mail = send_mail($to, $Subject, $message);
                    // debugger( $reponse_send_mail );
                    if( $reponse_send_mail ){
                        //reponse HTML de message de succès  <span class="glyphicon glyphicon-ok">
                        $message_succes = " Vous avez réussi la prémière étape de réinitialisation de votre mot de passe.<br>
                                            Prière consulter votre boîte e-mail <b> $to </b> et cliquer sur le 
                                            lien qui vous a été envoyé afin de finaliser l'action.";
                        $retour['html_succes'] = ' <div class="col-sm-12 col-md-12">
                                                        <div class="alert alert-success">
                                                            <i class="fa fa-check"></i></span> <strong>Succès</strong>
                                                            <hr class="message-inner-separator">
                                                            <p>'.$message_succes.'</p>
                                                        </div>
                                                    </div>';
                    }else{
                        $error_statut = true;
                        $error_text = " L'envoi du mail de réinitialisation à $to a échoué.<br>
                                        Veuillez vérifier votre adresse e-mail ou contacter l'administrateur.";
                    }
                    //mise à jour reponse envoi de mail
                    $date = date("Y-m-d H:i:s");
                    $update_req = $pdo->prepare("   UPDATE clients 
                                                    SET reponse_envoi_email = :reponse_envoi_email,
                                                        date_modification = :date_modification
                                                    WHERE id = :id "
                                                ); 
                    $update_req->execute( 
                                            array( 
                                                ':reponse_envoi_email' => $reponse_send_mail,
                                                ':date_modification' => $date,
                                                ':id' => $client->id
                                            ) 
                                        );
                    
                }else{
                    $error_statut = true;
                    $error_text = "Ce compte n'est pas actif. Contactez l'administrateur du site.";
                }
                                
            }
        }
    } else {
        $error_statut = true;
        $error_text = 'Veuillez remplir correctement le formulaire ci-dessous.';
    }
} else {
    $error_statut = true;
    $error_text = 'Votre requete ne peut aboutir';
}
if ($error_statut) {
    $error_html = '<div class="col-sm-12 small alert alert-danger"><a href="" class="close" data-dismiss="alert" aria-label="close">&times;</a><span class=""><b>Erreur</b> ! ' . $error_text . '</span></div>';
    header('401 unauthorized', true, 401);
    $retour['error'] = 'oui';
    $retour['error_html'] = $error_html;
}
$retour_json = json_encode($retour);

echo $retour_json;

### ACTION SUR BASE DE DONNEE (17-05-2020) ###
/* 
    ALTER TABLE `clients` ADD `date_password_reinit` DATETIME NULL DEFAULT NULL AFTER `date_modification`, 
    ADD `token_password_reinit` VARCHAR(255) NULL DEFAULT NULL AFTER `date_password_reinit`, 
    ADD `reponse_envoi_email` TEXT NULL DEFAULT NULL AFTER `token_password_reinit`, 
    ADD `token_password_reinit_status` INT(1) NULL DEFAULT '0' AFTER `reponse_envoi_email`, 
    ADD `is_password_reinit` INT(1) NULL DEFAULT '0' AFTER `token_password_reinit_status`;

    ALTER TABLE `clients` ADD `date_token_reinit_password` DATETIME NULL AFTER `is_password_reinit`;
*/




