<?php
class PaymentController extends Controller {
    
    public function getback(){
      $this->loadmodel('Payment');
      $_SESSION['menu'] = '';
      
      // debug($d['list_metiers']);
      // die();
      $this->set($d);
    }

      
    public function paymentipn(){
      $this->loadmodel('Payment');
      $_SESSION['menu'] = '';
      $error_statut = false;
      $error_text = '';
      $retour = array();

      if(!isset($_POST) || empty($_POST) ){
        $error_statut = true;
        $error_text = 'ERREUR! PAIEMENT INCONNU DU SYSTEME.';
      }else{
        $body = "".json_encode($_POST)."";
        $date = date("Y-m-d H:i:s");
        $this->Payment->insert(array(
                        'fields' => array('corps', 'methode', 'date_creation', 'description'),
                        'values' => array(
                            'corps' => $body,
                            'methode' => 'POST',
                            'date_creation' => $date,
                            'description' => 'Notification post paiement'
                        )
                            ), 'logs_paiement');

        extract($_POST);
        if(!isset($order_id) || !isset($transaction_id) || !isset($status_id) || !isset($transaction_amount) || !isset($paid_transaction_amount) || 
           !isset($paid_currency) || !isset($change_rate) || !isset($wallet)) //verifie si tous les champs necessaires existent
        {
          $error_statut = true;
          $error_text = 'ERREUR! PAIEMENT INCONNU DU SYSTEME.';
        }else{
          if(empty($order_id) || empty($transaction_id) || empty($status_id) || empty($transaction_amount) || 
             empty($paid_transaction_amount) || empty($paid_currency) || empty($change_rate) || empty($wallet))
          {
            $error_statut = true;
            $error_text = 'ERREUR! PAIEMENT INCONNU DU SYSTEME.';
          }else{
            $order_id = trim($order_id);
            $d['transac'] = current($this->Payment->find(array(
               'condition' => array('order_id' => $order_id)
                ),'paiements'));
            if(empty($d['transac'])){ //est ce que la transac existe en base
              $error_statut = true;
              $error_text = 'ERREUR! PAIEMENT INCONNU DU SYSTEME.';
            }else{
              //faire une conversion en nombre du transaction_amount bd et POST
              if(floatval($d['transac']->transaction_amount) != floatval($transaction_amount)){ //verfier si montant correspond
                $error_statut = true;
                $error_text = 'ERREUR! PAIEMENT INCONNU DU SYSTEME.';
              }else{
                if($d['transac']->statut_id !=10 ){ //verfier si statut est en cours
                  $error_statut = true;
                  $error_text = "ERREUR! CE PAIEMENT A DEJA ETE CLOTURE. VEUILLEZ CONSULTER L'HISTORIQUE DE VOS PAIEMENT POUR CONNAITRE SON 
                  STATUT.";
                }else{
                  //
                  $conflictual_transaction_amount = isset($conflictual_transaction_amount) ? $conflictual_transaction_amount : '';
                  $conflictual_currency = isset($conflictual_currency) ? $conflictual_currency : '';
                  $date_modification = date("Y-m-d H:i:s");

                  $this->Payment->update(array(
                    'fields' => array('statut_id', 'transaction_id', 'paid_transaction_amount', 'paid_currency', 'change_rate', 'date_modification'),
                    'values' => array($status_id, $transaction_id, $paid_transaction_amount, $paid_currency, $change_rate, $date_modification),
                    'condition' => "order_id='". $order_id."'"
                        ), 'paiements'); // Mise à jour de la ligne de paiement.

                  $this->Payment->update(array(
                    'fields' => array('statut'),
                    'values' => array(1),
                    'condition' => 'id=' . $d['transac']->id_membre
                        ), 'membres'); // Mise à jour de la ligne de paiement.


                  echo 'NOTIFICATION TRAITEE AVEC SUCCES.';

                }

              }

            }



          }


          //verifier si order existe en base
          
          
          //verifiet si statut_id est NOK ou OK

        }
      }

      if($error_statut){
        echo $error_text;
      }else{
        echo 'NOTIFICATION TRAITEE AVEC SUCCES.';
      }

      die();

      //$this->set($d);
    }


    public function returnfrompayment(){
      $this->loadmodel('Payment');
      //$this->loadmodel('Payment');
      $_SESSION['menu'] = '';
      $error_statut = false;
      $error_text = '';
      $toDisplay = 'succes_modal';
      $retour = array();
      if(!isset($_GET) || empty($_GET) ){
        $error_statut = true;
        $error_text = 'ERREUR! PAIEMENT INCONNU DU SYSTEME.';
        //$toDisplay = 'succes_modal';
      }else{
        $body = "".json_encode($_GET)."";
        $date = date("Y-m-d H:i:s");
        $this->Payment->insert(array(
                        'fields' => array('corps', 'methode', 'date_creation', 'description'),
                        'values' => array(
                            'corps' => $body,
                            'methode' => 'GET',
                            'date_creation' => $date,
                            'description' => 'Redirection post paiement'
                        )
                            ), 'logs_paiement');
        extract($_GET);
        if(!isset($order_id) || !isset($transaction_id) || !isset($status_id) || !isset($transaction_amount) || !isset($paid_transaction_amount) || 
           !isset($paid_currency) || !isset($change_rate) || !isset($wallet)) //verifie si tous les champs necessaires existent
        {
          $error_statut = true;
          $error_text = ' ERREUR! PAIEMENT INCONNU DU SYSTEME.';
        }else{
          $order_id = trim($order_id);
          $d['transac'] = current($this->Payment->find(array(
               'condition' => array('order_id' => $order_id)
               ),'paiements'));

          if(empty($d['transac'])){ //est ce que la transac existe en base
              $error_statut = true;
              $error_text = ' PAIEMENT INCONNU DU SYSTEME.';
          }else{
            if($d['transac']->statut_id != $status_id){ //verfier si le statut est celui en base
                  $error_statut = true;
                  $error_text = " PAIEMENT A GENRE FRAUDULEUX. ";
            }else{
              if($d['transac']->statut_id == 1){
                $error_statut = false;
                $error_text = " PAIEMENT EFFECTUE AVEC SUCCES. ";

              }else{
                if($d['transac']->statut_id == 2){
                  $error_statut = true;
                  $error_text = " PAIEMENT ECHOUE POUR SOLDE INSUFFISANT. ";
                  $_SESSION['user']['statut'] = 1;

                }else{
                  $error_statut = false;
                  $error_text = " PAIEMENT ECHOUE. ";
                }
              }


            }
          }

        }

      }

      $_SESSION['paymentReturn']['status'] = $error_statut;
      $_SESSION['paymentReturn']['description'] = $error_text;
      header('Location: '.BASE_URL.DS.'membre/espace_personnel');

      //$_SESSION['paymentReturn']['resultPaymentDisplay'] = ''
      //Suite fonction
      //$this->set($d);
    }
    


    private function save_log(){
      $this->loadmodel('Payment');
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
    
   


    /*
{
"order_id": "Y4U465JDJ655N687C",
"status_id": 1,
"transaction_id": "245543",
"transaction_amount": 500,
"currency": "XOF",
"paid_transaction_amount": 500,
"paid_currency": "XOF",
"change_rate": null,
"conflictual_transaction_amount": null,
"conflictual_currency": null,
"wallet": "paymoney"
}

    */
    
}