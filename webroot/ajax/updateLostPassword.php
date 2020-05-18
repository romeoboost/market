<?php
include 'connectDB.php';
include 'fonction.php';

if (empty(session_id())) {
    session_start();
    //$_SESSION['menu'] = 'Nous_Rejoindre';
}
$error_statut = false;
$error_text = '';
$field_error ='none';
$retour = array();
$retour['enregistrement'] = 'non';
$error_text = "<b>Oups, Erreur !</b>";
$error_text_second = '';

if(!isset($_POST) || empty($_POST) ){
  $error_statut = true;
  $error_text = "Oups, Erreur !";
  $error_text_second = 'Veuillez ne pas modifier la page. Tous les paramètres sont obligatoires';
}else{
  extract($_POST);
  
  //verifier si les champs existe
  if( !isset($email) || !isset($token_reinit) || !isset($password) || !isset($confirm_password) ) //verifie si tous les champs existent
  {
    $error_statut = true;
    $error_text_second = 'Aucun Champs ne doit manquer.';
  }else{
    //verifier si les champs obligatoires ne sont pas vides
    if( empty($email) || empty($token_reinit) || empty($password) || empty($confirm_password) ) //verifie si les champs obligatoires sont pas vides
    {
      $error_statut = true;
      $error_text_second = 'Veuillez remplir correctement le formulaire. Aucun champs obligatoire ne doit être vide.';
    }else{
        // debugger($_POST);
        $email = trim($email);
        $token_reinit = trim($token_reinit);
        $password = trim($password);
        $confirm_password = trim($confirm_password);

        //Verifier si les champs password et confirm_password contiennent les mêmes valeurs
        if( $password !== $confirm_password ){
          $error_statut = true;
          $error_text_second = 'Le nouveau mot de passe et la confirmation doivent être identiques.';
        }else{
          $md5_password = md5($password);
          $req_recup = $pdo->prepare('SELECT * FROM clients 
                                      WHERE email = :email and token_password_reinit = :token_password_reinit 
                                      ORDER BY id DESC'); 
          $req_recup->execute( array( 
              ':email' => $email,
              ':token_password_reinit' => $token_reinit
            ) );
          $client = current( $req_recup->fetchAll(PDO::FETCH_OBJ) );

          //verifier si l'ancien mot de passe est correct
          //debugger($clients->password, $md5_old_password);
          if( empty( $client ) ){
            $error_statut = true;
            $error_text_second = "L'e-mail ou le token est incorrect.";
          }else{
            //Verifier si le token est toujours valide , procedure de reinitialisation en cours
            if( $client->token_password_reinit_status == 3 ){
              //Mettre à jour les champs 
              $md5_new_password = md5($password);
              $date = date("Y-m-d H:i:s");
              $update_req = $pdo->prepare("   UPDATE clients 
                                              SET password = :password, 
                                                  date_modification = :date_modification,
                                                  date_password_reinit = :date_password_reinit,
                                                  token_password_reinit_status = :token_password_reinit_status,
                                                  is_password_reinit = :is_password_reinit
                                              WHERE id = :id "
                                          ); 
              $update_req->execute( 
                                      array( 
                                          ':password' => $md5_new_password,
                                          ':date_modification' => $date,
                                          ':date_password_reinit' => $date,
                                          ':token_password_reinit_status' => 1,
                                          ':is_password_reinit' => 1,
                                          ':id' => $client->id
                                      ) 
                                  );

              $message_succes = " Votre mot de passe a été réinitialisé avec succès. 
              Merci d'utiliser le nouveau mot de passe pour vous connecter.";
              $retour['html_succes'] = ' <div class="col-sm-12 col-md-12">
                                              <div class="alert alert-success">
                                                  <i class="fa fa-check"></i></span> <strong>Succès</strong>
                                                  <hr class="message-inner-separator">
                                                  <p>'.$message_succes.'</p>
                                              </div>
                                          </div>';

            }else{
              $error_statut = true;
              $error_text_second = " Le token de reinitialisation n'est plus valide. 
              Merci de reprendre le processus de réinitialisation de mot de passe.";
            } 

          }
        }

    }
  }
  
}
//echo 'ALL <pre>';print_r($_POST);echo '</pre>';

$retour['error_text'] = $error_text;
$retour['error_text_second'] = $error_text_second;

if ($error_statut) {
    $error_html = '
                    <div class="col-sm-12 alert alert-danger alert-dismissible " role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                        <span class="">' . $error_text . '</span><br> 
                        <span class="">' . $error_text_second . '</span>
                    </div>  ';
    $retour['error'] = 'oui';
    $retour['error_html'] = $error_html;
    $retour['field_error'] = $field_error;
    header("Une erreur s'est produite", true, 503);
    //die($error_html);
}
$retour_json = json_encode($retour);

echo $retour_json;



