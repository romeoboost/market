<?php

function get_reinit_password_mail_body($user_name, $token_reinit, $reinit_url_base){
  $body = "
  <h3>REINITIALISATION DE MOT DE PASSE</h3> <br> 
  Bonjour $user_name,<br><br>
  
  Vous avez demandé à réinitialiser votre mot de passe. <br>
  Vous pouvez maintenant valider cette demande en 
  <a href='$reinit_url_base/$token_reinit' > <b>cliquant ici</b></a> ou via le lien 
  ci-dessous : <br> $reinit_url_base/$token_reinit  
  
  <br><br>
  Si vous rencontrez toujours un problème avec votre compte, n'hésitez pas à répondre à cet email ou 
  à nous contacter sur afromart225@gmail.com :-)
  
  <br><br>  
  À bientôt ! <br> 
  L'équipe d'AFROMART.";

  return $body;

}

function send_mail($to, $Subject, $message){
  require_once('../phpmailer/class.phpmailer.php');
  //include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

  $mail             = new PHPMailer();

  // $body             = file_get_contents('contents.html');
  // $body             = "TEST TEST";
  $body             = str_replace("\\",'',$message);

  $mail->IsSMTP(); // telling the class to use SMTP
  // $mail->Host       = "mail.yourdomain.com"; // SMTP server
  $mail->SMTPDebug  = 1;                     // enables SMTP debug information (for testing)
                                             // 1 = errors and messages
                                             // 2 = messages only
  $mail->SMTPAuth   = true;                  // enable SMTP authentication
  $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
  $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
  $mail->Port       = 25;                   // set the SMTP port for the GMAIL server
  //$mail->Username   = "test.ngser@gmail.com";  // GMAIL username
  $mail->Username   = "afromart225@gmail.com"; //"test.application.ngser@gmail.com"; //
  $mail->Password   = "afrovision225@"; //"@dtngser"; //"password2018#"; // GMAIL password

  $mail->SetFrom('service.clients@afromart.com', 'SERVICE CLIENT AFROMART');

  $mail->AddReplyTo("service.clients@afromart.com","SERVICE CLIENT");

  $mail->Subject    = $Subject;

  $mail->AltBody    = "Pour afficher le message, veuillez utiliser un client de méssagerie électronique compatible HTML!"; // optional, comment out and test

  $mail->MsgHTML($body);

  $address = $to;
  $mail->AddAddress($address, $to);

  // $mail->AddAttachment("images/phpmailer.gif");      // attachment
  // $mail->AddAttachment("images/phpmailer_mini.gif"); // attachment

  if(!$mail->Send()) {
    return "Mailer Error: " . $mail->ErrorInfo;
  } else {
    return true;
  }
}



function upload($file, $width, $height) {
  $img = $file['name'];
  $img_tmp = $file['tmp_name'];
  $image = explode('.',$img);
  $image_ext = end($image);
  $error = '';
  if( empty( $img ) ){
     return false;
  }
  if( in_array( strtolower($image_ext),array('png','jpeg','jpg') ) === false ){
      $error = 'veuillez entrer une image valable';
      return false;
  }else{
      $image_size = getimagesize($img_tmp);
      if($image_size['mime'] === 'image/png'){
          $image_src = imagecreatefrompng($img_tmp);
      }elseif($image_size['mime'] === 'image/jpeg'){
          $image_src = imagecreatefromjpeg($img_tmp);
      }elseif($image_size['mime'] === 'image/jpg'){
          $image_src = imagecreatefromjpg($img_tmp);
      }else{
          $image_src = false;
          $error =  'veuillez entrer une image valide';
          return false;
      }
      if($image_src !== false){
          $image_width = $width;
          if($image_size[0] == $image_width){
              $image_finale = $image_src;
          }else{
              $new_width = $image_width;
              $new_height = $height;
              $image_finale= imagecreatetruecolor($new_width,$new_height);
              imagecopyresampled($image_finale,$image_src,0,0,0,0,$new_width,$new_height,
                      $image_size[0],$image_size[1]);
          }
          //imagejpeg($image_finale,'C:\wamp\www\mareussite\webroot\photo\1.jpg');
          return $image_finale;
      }
  }

}

function insert($pdo, $req, $table){
    $sql = ' INSERT INTO '.$table.' (';
    $sql .= implode(', ', $req['fields']).')';
    $sql .= ' VALUE (:'.implode(', :',$req['fields']).')';
    $pre = $pdo->prepare($sql);
    $pre->execute($req['values']);
}

function getTokenNumber($Nbre_Mbre_Actuel, $Abreviation_Pays, $Debut){

  $Identifiant = $Debut;

  $Date_Identifiant = date("Ym"); //
  $Identifiant .= "".$Date_Identifiant;        
  $Numero_Mbre = "".($Nbre_Mbre_Actuel + 0);
  $Taille_Fixe = 4;
  $Numero_Mbre_Good = str_pad($Numero_Mbre, $Taille_Fixe, "0", STR_PAD_LEFT);
  $Identifiant .= $Numero_Mbre_Good;

  //$Abreviation_Pays = 'CI'; // A automatiser
  $Identifiant .= $Abreviation_Pays;

  return $Identifiant;
}

function getFees($pdo, $total_amount_cart){

  $shippingFees = 0; // initie les frais à 0

  //recuperer les frais
  if($total_amount_cart <= 0 ){ //si le montant du panier est 0
    $shippingFees = 0; // retourne 0 comme frais
  }else{
    $req['condition'] = " min <= $total_amount_cart AND max >= $total_amount_cart "; // recupere les frais dans le pallier adequat
    $feeRow = current( sql_select($pdo, $req, 'frais_livraison') );
    // debugger($total_amount_cart);
    if( !empty( $feeRow ) ){
      $shippingFees = $feeRow->frais;
    }else{
      unset($req['condition']);
      $req['order']['champs'] = ' max '; $req['order']['param'] = ' DESC ';
      $TopFeeRow = current( sql_select($pdo, $req, 'frais_livraison') );
      $shippingFees = $TopFeeRow->frais;
    }
  }

  return $shippingFees;
}

//peut prendre les conditions listées dans un tableau ou pas
function sql_select($pdo, $req, $table=null){
   $sql = 'SELECT ';
   //reglage pour les doublons
   if(isset($req['distinct'])){
      $sql .= 'DISTINCT '; 
   }
   //reglage pour les champs
   if(isset($req['fields'])){
      if(is_array($req['fields'])){
          $sql .= implode(', ',$req['fields']); 
       }else {
          $sql .= $req['fields']; 
       }              
   }else{
      $sql .= '*'; 
   } 
   $sql .= ' FROM '.$table;
    //condition
   if(isset($req['condition'])){
       $sql .= ' WHERE ';
       $sql .= $req['condition'];
       
   }
   //group by
   if(isset($req['group'])){
      $sql .= ' GROUP BY '.$req['group'];             
   }

   //reglage order by
   if(isset($req['order'])){
      $sql .= ' ORDER BY '.$req['order']['champs'].' '.$req['order']['param'];              
   }
   //reglage pour LIMIT
   if(isset($req['limit'])){
      $sql .= ' LIMIT '.$req['limit'];              
   }           
   //die ($sql);
   $pre = $pdo->prepare($sql);
   if( isset( $req['array_filter'] ) ){
      $pre->execute($req['array_filter']);  
    }else{
      $pre->execute(); 
    }
   
   if(isset($req['assos'])){
     return $pre->fetchAll(PDO::FETCH_ASSOC);  
   }else{
     return $pre->fetchAll(PDO::FETCH_OBJ);  
   } 
}


function debugger($var, $second_var=null){
  print_r($var);
  print_r(' ');
  print_r($second_var);
  die( header("arret pour debuggage", true, 501) );
  return true;
}

function formatdate($date){
    return implode('-', array_reverse(explode('-', $date)));
}

function formatdatetime($datetime){
   $cup = explode(' ', $datetime);
   $date = $cup[0];
   $time = $cup[1];
   $daterev = implode('-', array_reverse(explode('-', $date)));
   $result = $daterev.' '.$time;
   return $result;
}

function getDuree($date_arrivee, $date_depart){
//    $date1 = formatdatetime($date_arrivee);
//    $date2 = formatdatetime($date_depart);
    $datetime1 = new DateTime($date_arrivee);
    $datetime2 = new DateTime($date_depart);
    $interval = $datetime1->diff($datetime2);
    if($interval->invert != 0){
       return false; 
    }else{
       $resultat = '';
       $resultat .= ($interval->y > 0) ? $interval->y.' Ans ' : ' ';
       $resultat .= ($interval->m > 0) ? $interval->m.' Mois ' : ' ';
       $resultat .= ($interval->d > 0) ? $interval->d.' jour(s) ' : ' ';
       $resultat .= ($interval->h > 0) ? $interval->h.' Heure(s) ' : ' ';
       $resultat .= ($interval->i > 0) ? $interval->i.' Min' : ' ';
       return $resultat;
    }
      
}

function getMemberNumber($Nbre_Mbre_Actuel, $Abreviation_Pays){

        $Identifiant = 'CLI'; //

        $Date_Identifiant = date("Ym"); //
        $Identifiant .= "".$Date_Identifiant;        
        $Numero_Mbre = "".($Nbre_Mbre_Actuel + 1);
        //echo '<pre>';print_r($Identifiant);echo '</pre>';
        $Taille_Fixe = 4;
        $Numero_Mbre_Good = str_pad($Numero_Mbre, $Taille_Fixe, "0", STR_PAD_LEFT);
        $Identifiant .= $Numero_Mbre_Good;

        //$Abreviation_Pays = 'CI'; // A automatiser
        $Identifiant .= $Abreviation_Pays;

        return $Identifiant;
}

function getCmdeNumber($Nbre_Mbre_Actuel, $Abreviation_Pays){

        $Identifiant = 'AM'; //

        $Date_Identifiant = date("Ym"); //
        $Abreviation_Pays .= "".$Date_Identifiant;        
        $Numero_Mbre = "".($Nbre_Mbre_Actuel + 1);
        //echo '<pre>';print_r($Identifiant);echo '</pre>';
        $Taille_Fixe = 4;
        $Numero_Mbre_Good = str_pad($Numero_Mbre, $Taille_Fixe, "0", STR_PAD_LEFT);
        $Abreviation_Pays .= $Numero_Mbre_Good;

        //$Abreviation_Pays = 'CI'; // A automatiser
        $Abreviation_Pays .= $Identifiant;

        return $Abreviation_Pays;
}

function getPaymentParams($name, $service_token){

  $result = array();
  $time = time();
  $base_order = "AIESAEAPMT";
  $order=$base_order.$time;

  $curl = curl_init('http://crossroadtest.net:6968/service/auth');
    curl_setopt($curl, CURLOPT_POSTFIELDS, '{
        "auth": {
        "name": "'.$name.'",
        "authentication_token": "'.$service_token.'",
        "order": "'.$order.'"
        }
      }');
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_VERBOSE, 1);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
    
    try {
      $reponse_in_json = curl_exec($curl);
      curl_close($curl);
      $response = json_decode($reponse_in_json, true);
    } catch (Exception $e) {
        //echo 'Exception reçue : ',  $e->getMessage(), "\n";
        $reponse_in_json = ''.$e->getMessage();
    }

    //$jwt = $response['auth_token'];
  if(isset($response['auth_token'])){
    $result['gtw_payment_available']  = 'oui';
    $result['order']  = $order;
    $result['jwt']  = $response['auth_token'];
    $result['response_error']  = " ";
  }else{
    $result['gtw_payment_available']  = 'non';
    $result['order']  = $order;
    $result['response_error']  = "".$reponse_in_json;
    $result['jwt']  = '';
  }
  
  return $result;
}


function getHtmlPaymentBody($operation_token, $jwt, $order){
  $html_body = '<div class="modal-header-pay" style="padding:8px 22px;">';
    $html_body .= '<h5><span class="glyphicon glyphicon-check"></span> Veuillez payer les frais d\'inscription pour terminer
               la création de votre compte membre.</h5>';
  $html_body .= '</div>';

  $html_body .= '<div class="modal-body" style="padding:40px 50px;">';
    $html_body .= '<div class="modal-body-amount" style="">';
      $html_body .= '<h6>Montant</h6><h4> 6 500 F CFA </h4>';
    $html_body .= '</div>';
  $html_body .= '</div>';

  $html_body .= '<div class="modal-footer">';
    $html_body .= '<form role="" action="http://crossroadtest.net:6968/order" method="POST">';
      $html_body .= '<input name="operation_token" hidden value="'.$operation_token.'" type="text"/>';
      $html_body .= '<input name="order" hidden placeholder="montant" value="'.$order.'" type="text" />';
      $html_body .= '<input name="jwt" hidden value="'.$jwt.'" type="text" />';
      $html_body .= '<input name="currency" hidden value="XOF" type="text" />';
      $html_body .= '<input name="transaction_amount" hidden placeholder="montant" value="6500" type="text" />';
      $html_body .= '<button type="submit" class="btn btn-success "><span class="glyphicon glyphicon-check"></span> Payer</button>';
      $html_body .= '';  
    $html_body .= '</form>';
  $html_body .= '</div>';

  return $html_body;

}

function getHtmlPaymentBodyError(){
  $html_body = '<div class="modal-header-pay-error" style="padding:8px 22px;">';
    $html_body .= '<h5 class="error-gateway-payment"><span class="glyphicon glyphicon-check"></span> La plateforme de paiement est indisponible pour l\'instant.</h5>';
  $html_body .= '</div>';

  $html_body .= '<div class="modal-body" style="padding:40px 50px;">';
    $html_body .= '<div class="modal-body-amount" style="">';
      $html_body .= '<h5>Prière réessayer plus tard pour terminer la création de votre compte membre.</h5>';
    $html_body .= '</div>';
  $html_body .= '</div>';

  $html_body .= '<div class="modal-footer">';
    $html_body .= '<button class="btn btn-default" data-dismiss="modal">
                    <span class="glyphicon glyphicon-remove"></span> Fermer </button>';
  $html_body .= '</div>';  
  return $html_body;
}


 function getStatus($statut){

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


/*
            <div class="modal-header-pay" style="padding:8px 22px;">
              <h5><span class="glyphicon glyphicon-check"></span> Veuillez payer les frais d'inscription pour terminer
               la création de votre compte membre.</h5>
            </div>
            <div class="modal-body" style="padding:40px 50px;">
              <div class="modal-body-amount" style="">
                <h6>Montant<h6>
                <h4>6 500 F CFA<h4>
              </div>
            </div>
            <div class="modal-footer">
                <form role="" action="http://crossroadtest.net:6968/order" method="POST">
                    <input name="operation_token" hidden value="" type="text"/>
                    <input name="order" hidden placeholder="montant" value="" type="text" />
                    <input name="jwt" hidden value="" type="text" />
                    <input name="currency" hidden value="XOF" type="text" />
                    <input name="transaction_amount" hidden placeholder="montant" type="text" />
                    <button type="submit" class="btn btn-success "><span class="glyphicon glyphicon-check"></span> Payer</button>
                    <!-- <button type="submit" class="btn btn-default btn-default pull-left" data-dismiss="modal">
                    <span class="glyphicon glyphicon-remove"></span> Fermer</button>-->
                </form> 
            </div>

*/
