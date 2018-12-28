<?php
     //echo '  <p>'.$error.'</p>  ';
     if(empty($error)){ 
        $display = 'display: none; ';
     }else{
         $display = 'background-color: #E60000; color: #FBFBFB ';      
     }
?>
<br/>
<!--<form class="form-inline" action="" method="post">
    <div class="form-group" style="color:#060761 ;">
      <select id="lunch" class="selectpicker" data-live-search="false" title="selectionnez un niveau" name="niveau">
          <?php foreach ($niveaux as $n): ?>
            <option value="<?php// echo $n->niveau ?>"><?php echo $n->niveau ?></option>
          <?php endforeach ?>  
      </select>
    </div>
    <div class="form-group" style="color:#060761 ;">
      <select id="lunch" class="selectpicker" data-live-search="false" title="Choisissez la classe" name="ident">
          <?php foreach ($idents as $n): ?>
            <option value="<?php //echo $n->identifiant ?>"><?php //echo //$n->identifiant ?></option>
          <?php endforeach ?> 
      </select>
    </div>
        </fieldset>
    <button type="submit" class="btn btn-default" name="submit">Selectionner</button>
    </div>
</form> -->

<form action="" method="POST" >
    <div id="accordion" class="text-center" col-sm-offset-3>
        <h5 style="color:#004A25; ">Selectionnez une classe</h5>
        <!--<br/>-->
        <fieldset>
                <div class="col-sm-9 col-sm-offset-4" style="/*background-color: #E60000; color: #FBFBFB*/ ">
                    <div class=" col-md-5 error" style="<?php echo $display; ?>">
                        <!--<p>-->
                            <?php  echo $error;    ?>
                        <!--</p>-->
                    </div>
                </div>
            </fieldset>
        <fieldset>            
           <div class="form-group col-md-2 niveau col-sm-offset-3" style="">
             <label for="niveau" style="color:#004A25; ">Niveau</label>
              <select id="niveau" class="form-control focusedInput" name="niveau" >
                    <option value=""></option> 
                    <option value="6ème">6ème</option>
                    <option value="5ème">5ème</option>
                    <option value="4ème">4ème</option>
                    <option value="3ème">3ème</option>            
                    <option value="2nde">2nde</option>
                    <option value="1ère">1ère</option>
                    <option value="Tle">Tle</option>
              </select>
             <span style="color:red"> </span>
            </div> 
            <div class="form-group col-md-2 serie col-sm-offset-0" style="">
             <label for="serie" style="color:#004A25; ">Serie</label>
              <select id="serie" class="form-control focusedInput" name="serie" >
                    <option value=""></option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                    <option value="F1">F1</option>
                    <option value="F2">F2</option>            
                    <option value="F3">F3</option>
                    <option value="F4">F4</option>
                    <option value="F7">F7</option>
                    <option value="G1">G1</option>
                    <option value="G2">G2</option>
              </select>
             <span style="color:red"> </span>
            </div> 
            <div class="form-group col-md-2 ident col-sm-offset-0" style="">
                <label for="ident" style="color:#004A25; ">Identifiant</label>
              <select id="ident" class="form-control" name="ident">
                  <option value=""></option>
                  <?php for ($i = 1; $i <= 6; $i++) {
                        echo '<option value="'.$i.'">'.$i.'</option>';
                  } ?>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
              </select>
                <span style="color:red"> </span>
            </div>
	</fieldset>
      <div class=" col-sm-12" > 
      <div class="col-sm-2 col-sm-offset-5">
           <button type="submit" class="form-control" 
      style="background-color:rgb(0, 204, 51); color:white;" id="Ajouter" class="btn btn-default" name="submit">
               Accéder
           </button>
      </div>
      </div>
        <br/>
    </div>
</form>
<br/><br/><br/><br/>
 <script type="text/javascript" language="javascript">
        $(document).ready(function(){
            $("#niveau").focus();
            $(".niveau select").change(function (){         
               $("#niveau option:selected").each(function () {                    
                    var classe = $(this).val();
                    if(classe == ''){                        
                        $('.niveau span').text("veuillez choisir un niveau");  
                      }else{
                        $('.niveau span').text("");  
                      }                    
	       });
            })
            
            $("form").submit(function (){
                var ok = true;
                var niv = $("#niveau").val();
                var ident = $("#ident").val();
                //alert(niv);
                if(niv == '' ){
                   //alert(niv); 
                  ok = false;
                  $('.niveau span').text("veuillez choisir un niveau");                  
                }
                if(ident == ''){
                  ok = false;
                  $('.ident span').text("veuillez choisir un identifiant");                    
                }
                return ok;
            });
        
  	});
</script>               