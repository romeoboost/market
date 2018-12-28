<?php
class ClasseController extends Controller {
    
    public function index(){
       conf::redir();
       $this->loadmodel('Choice'); 
       $d['error'] = ''; 
       if(isset($_POST['submit'])){
          if($_POST['niveau'] && $_POST['ident']){
            $classe = $_POST['niveau'].$_POST['serie'].$_POST['ident'];
            $class_verif = $this->Choice->find(array(
                 'condition' => array('nom' => $classe),
                  'fields' => 'id,nom'                
            ),'classes');
            if(empty($class_verif)){
               $d['error'] = ' la classe que vous avez choisie n\'existe pas dans cette école,<br/> selectionnez une autre ';  
            }else{
               $prof_verif = current($this->Choice->find(array(
                 'condition' => array(
                     'id_class' => $class_verif->id,
                     'id_prof' => $_SESSION['id_prof'])
                   ),'classes_profs'));
               if(empty($prof_verif)){ //veirifie si le prof enseigne dans cette classe
                  $d['error'] = ' Vous n\'êtes pas autorisé à accéder à cette classe, <br/> selectionnez une autre '; 
               }else{
                  $_SESSION['id_classe'] = $class_verif->id; 
                  $_SESSION['nom_classe'] = $class_verif->nom; 
                  $d['info'] = current($this->Choice->findJoin(array( //recuperer l'educateur
                        'fieldsmain' => array('nom AS nom','id_pp AS id_pp','id_educ AS id_educ'),
                        'fieldstwo' => array('id AS idp','nom AS nom_prof','prenom AS prenom_prof'),
                        'fieldsthree' => array('id AS ide','nom AS nom_pers','prenoms AS prenoms_pers'),
                        'fields' => array(array(
                            'main' => 'id_pp',
                            'second' => 'id'),
                            array(
                             'main' => 'id_educ',
                             'third' => 'id'  
                            )),
                        'condition' => 'classes.id='.$class_verif->id
                    ),'classes','profs','personnel'));
               $_SESSION['pp'] = !empty($d['info'])?$d['info']->nom_prof.' '.$d['info']->prenom_prof : 'AUCUN';
               $_SESSION['educ'] = !empty($d['info'])?$d['info']->nom_pers.' '.$d['info']->prenoms_pers : 'AUCUN';
                  header('Location: '.BASE_URL.DS.'eleve/lister');// redir pour lister les eleves pour la classe class_verif[0]->id  
               }               
            }
          }else{
            $d['error'] = ' Veuillez selectionner un niveau et un identifiant ';  
          }
          //debug($d);
       }
       $d['niveaux'] = $this->Choice->find(array(
           'distinct' => 'DISTINCT',
           'fields' => 'niveau',
           'order' => array(
              'champs' => 'niveau',
              'param' => 'ASC'
           )
       ),'classes');
       $d['idents'] = $this->Choice->find(array(
           'distinct' => 'DISTINCT',
           'fields' => 'identifiant',
           'order' => array(
              'champs' => 'identifiant',
              'param' => 'ASC'
           )
       ),'classes');
       //debug($d);
      $this->set($d);        
    }
    
    
    public function edit(){
       
      //debug($d);        
    }
    
    function getMenu($profil){
           $this->loadmodel('Choice');
           if($profil=='admin'){
            $menu = $this->Choice->find(array(),'matieres');  
           }elseif($profil=='professeur'){
             $menu = $this->Choice->findJoin(array(
            'fieldsmain' => array('id AS id','id_prof AS id_prof'),
            'fieldstwo' => array('id AS idm','titre AS matiere'),
            'fields' => array(array(
                'main' => 'id_matiere',
                'second' => 'id')),
            'condition' => 'classes_profs.id_class='.$id_classe.' AND classes_profs.id_prof='.$_SESSION['id_prof']
        ),'classes_profs','matieres');
           }
            return $menu;
       }
       
    function getMenuMoy($profil){
           $this->loadmodel('Choice');
           if($profil=='admin'){
            $menu = $this->Choice->find(array(),'matieres');  
           }elseif ($profil=='professeur') {
             $v = $this->Choice->find(array( //est ce ke le prof est le pp de cette classe ?
                   'condition' => array(
                       'id' => $id_classe,
                       'id_pp' => $_SESSION['id_prof'],
                   )
               ),'classes');             
             if(empty($v)){
               $menu = $this->Choice->findJoin(array(
                    'fieldsmain' => array('id_prof AS id_prof'),
                    'fieldstwo' => array('id AS id','titre AS titre'),
                    'fields' => array(array(
                        'main' => 'id_matiere',
                        'second' => 'id')),
                    'condition' => 'classes_profs.id_class='.$id_classe.' AND classes_profs.id_prof='.$_SESSION['id_prof']
                ),'classes_profs','matieres'); 
             }else{
                $menu = $this->Choice->find(array(),'matieres'); 
             }
           }
           return $menu;
       }   
    
}