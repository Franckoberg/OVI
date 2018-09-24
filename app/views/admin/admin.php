
<?php if(!$this->session->userdata('nom')): ?>
  <?php $_SESSION['flash']['danger'] = 'Veuillez vous connecter'; ?>
  <?php redirect('user/login'); ?>
<?php endif ?>

<!-- Example row of columns -->
  <div class="container spacer">
     <div class="msg" style="position: relative; margin: auto; width: 600px; ">
      <!--Form validation -->
         <?php  if (validation_errors()): ?> 
           <div class="alert alert-danger">
              <?php echo validation_errors(); ?>            
           </div>
          <?php endif ?>
      <!-- fin Form validation -->
       <?php if (isset($_SESSION['flash'])): ?>
          <?php foreach ($_SESSION['flash'] as $type => $message):?>
            <div class="alert alert-<?= $type; ?>">
              <a class="panel-close close" data-dismiss="alert">×</a>
              <?= $message; ?>            
            </div>
          <?php endforeach ?>
          <?php unset($_SESSION['flash']) ?>
        <?php endif ?>
     </div> <?php // var_dump($this->session->userdata()); ?>
    <div class="row" style="border: ; ">
      <div class="col-lg-4 col-xs-12 col-sm-6 col-md-8">
        <h2>Roles actions</h2>
        <p>Cette section presente les differentes action que vous pouvez effectuer sur les roles
        (ajouter, supprimer, modifier et lister).
        </p>
        <p>
          <?php if( $this->session->userdata('fonction') !==  'DIRECTEUR'  ): ?>
            <a class="btn btn-primary" href="#" role="button" data-toggle="modal" data-target="#myModal-A" disabled >Ajouter</a>    
            <a class="btn btn-primary" href="#" role="button" data-toggle="modal" data-target="#myModal-L" disabled >Lister</a>
          <?php else: ?>
            <a class="btn btn-primary" href="#" role="button" data-toggle="modal" data-target="#myModal-A" >Ajouter</a>    
            <a class="btn btn-primary" href="#" role="button" data-toggle="modal" data-target="#myModal-L">Lister</a>
          <?php endif ?>
        </p>
      </div>

    <!-- Modal ajouter roles -->
    <div class="modal fade" id="myModal-A" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content"  style="width:500px">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">Ajouter un role</h4>
          </div>
          <div class="modal-body">
            <!-- <form class="form-horizontal" action="<?php //echo base_url('login/create_role');?>" method="post" accept-charset="utf-8" > --> 
              <?php echo form_open('admin/parametres',''); ?>
             <div class="form-group row">
            <label for="inputNom" class="col-sm-4 col-form-label">Nom</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="inputNom" id="inputProfession" placeholder="Admin" /> 
              <span class="text-danger"> </span>
            </div>
          </div>

          <div class="form-group row">
            <label for="inputDesc" class="col-sm-4 col-form-label">Description</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" name="inputDesc" id="inputDesc" placeholder="Administrateur du systeme" />
              <span class="text-danger"> </span>
            </div>
          </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-primary" id="save" name="save" value="Enregistre" />
            </div>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>
    <!-- Fin modal ajouter roles -->

    <!-- Modal lister roles -->
    <div class="modal fade " id="myModal-L" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content" style="width:500px">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">Liste de roles</h4>
            </div>
            <div class="modal-body">
              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Nom</th>
                      <th>Description</th>
                      <th colspan='2'><center>Actions</center></th>
                    </tr>
                  </thead>
                  <tbody>
                  	<?php // if (isset($roles)): ?>
                  	<?php foreach ($roles as $rows ): ?>
	                    <tr>
	                      <td><?php echo $rows->nom; ?></td>
	                      <td><?php echo $rows->description; ?></td>
	                      <!-- <a class="btn btn-primary" href="#" role="button" data-toggle="modal" data-target="#myModal-A">Ajouter</a>    -->
	                      <td><a href="#" role="button" data-toggle="modal" data-target="#<?php echo $rows->id_role.'supp'; ?>">Supprimer </a> </td>
	                      <!-- <td><a href="http://localhost/IHC/dba/parametres/<?= $rows->id_role; ?>/">Modifier </a> </td> -->
	                      <td><a href="#" role="button" data-toggle="modal" data-target="#<?php echo $rows->id_role.'modif'; ?>">Modifier </a> </td>
	                    </tr>
                	<?php endforeach ?>
                	<?php // endif ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <!-- <button type="button" class="btn btn-primary">Save</button> -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Fin modal lister roles -->

    <!-- Modal confirmation de suppression de roles -->
    <?php foreach($roles as $rows): ?>
    <div class="modal fade " id="<?php echo $rows->id_role.'supp'; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content" style="width:500px">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">Confirmation de suppression</h4>
            </div>
            <center><span class="span_description">Voulez vous vraiment supprimer ce role? </span></center>
            <div class="modal-body">
             <div>
             	<center><!-- "http://localhost/OVI/admin/delete/<?= $rows->id_role; ?>" -->
	             	<a class="btn btn-primary" href="http://localhost/OVI/admin/deleteRole/<?= $rows->id_role; ?>" >Oui</a>
	             	<a class="btn btn-primary" href="#" data-dismiss="modal">Non</a>
             	</center>
             </div>
            <!-- <div class="modal-footer"> -->
              <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
              <!-- <button type="button" class="btn btn-primary">Save</button> -->
            <!-- </div> -->
          </div>
        </div>
      </div>
    </div>
    <?php endforeach?>
    <!-- Fin modal confirmation de suppression de roles -->

    <!-- Modal de modification de roles -->
    <?php foreach($roles as $rows): ?>
    <div class="modal fade " id="<?php echo $rows->id_role.'modif' ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content" style="width:500px">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
              <h4 class="modal-title" id="myModalLabel">Modification de role </h4>
            </div>
            <div class="modal-body">
	            <?php echo form_open('admin/updateRole',''); ?>
	            <?php // foreach ($roles as $key): ?>
		            <div class="form-group row">
			            <label for="inputNom" class="col-sm-4 col-form-label">Nom</label>
			            <div class="col-sm-8">
                    <input type="hidden" name="id_role" id="id_role" value="<?= $rows->id_role; ?>" /> 
			              <input type="text" class="form-control" name="inputNom" id="inputProfession" placeholder="Admin" value="<?= $rows->nom; ?>" /> 
			              <span class="text-danger"> </span>
			            </div>
		         	</div>

		         	<div class="form-group row">
			            <label for="inputDesc" class="col-sm-4 col-form-label">Description</label>
			            <div class="col-sm-8">
			              <input type="text" class="form-control" name="inputDesc" id="inputDesc" placeholder="Administrateur du systeme" value="<?= $rows->description; ?>" />
			              <span class="text-danger"> </span>
			            </div>
			        </div> 
		            </div>
		            <div class="modal-footer">
		              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		              <input type="submit" class="btn btn-primary" id="update" name="update" value="Valide" />
		            </div>
	        	<?php // endforeach?>
	          	<?php echo form_close(); ?>
          </div>
        </div>
      </div>
      <?php endforeach?>

 <!-- Modal Personnel -->
      <div class="col-lg-4 col-xs-12 col-sm-6 col-md-8">
        <h2>Personnel actions</h2>
        <p>Cette section presente les differentes action que vous pouvez effectuer sur le personnel
        (ajouter, supprimer, modifier et lister).
        </p>
        <p> <!-- role="button" data-toggle="modal" data-target="#myClasse-L" -->
          <?php if($this->session->userdata('fonction') === 'DIRECTEUR'): ?>
            <a class="btn btn-primary" href="#" role="button" data-toggle="modal" data-target="#personnel-aj">Ajouter</a>   
            <a class="btn btn-primary" href="<?php echo base_url('admin/findPersonnel'); ?>" >Lister</a>
          <?php else: ?>
            <a class="btn btn-primary" href="#" role="button" data-toggle="modal" data-target="#personnel-aj" disabled >Ajouter</a>   
            <a class="btn btn-primary" href="<?php echo base_url('admin/findPersonnel'); ?>" >Lister</a>
          <?php endif ?> 
        </p>
      </div>

      <div class="modal fade" id="personnel-aj" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content"  style="width:500px">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="myModalLabel">Ajouter personnel</h4>
          </div>
          <div class="modal-body">
            <!-- <form class="form-horizontal" action="<?php //echo base_url('login/create_role');?>" method="post" accept-charset="utf-8" > --> 
              <?php echo form_open('admin/admregister',''); ?>
             <!-- <div class="form-group row"> -->
            <div class="form-group row">
              <label for="inputNom" class="col-sm-2 col-form-label">Nom</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="inputNom" id="inputNom" value="<?php echo set_value('inputNom'); ?>" placeholder="Nom" required />
                <span class="text-danger"> <?php echo form_error('inputNom'); ?></span>
                <span class="text-danger" id="missInputNom"></span>
              </div>
            </div>

            <div class="form-group row">
              <label for="inputPrenom" class="col-sm-2 col-form-label">Pr&eacutenom</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="inputPrenom" id="inputPrenom" value="<?php echo set_value('inputPrenom'); ?>" placeholder="Prenom" required />
                 <span class="text-danger"><?php echo form_error('inputPrenom'); ?></span>
                  <span class="text-danger" id="missInputPrenom"></span>
              </div>
            </div>

            <div class="form-group row"> 
              <label for="inputSexe" class="col-sm-2 col-form-label radio-inline"><strong>Sexe</strong>
              </label> <?php // echo set_value('sexe_type'); ?>
                <input id="sexe_m" name="sexe_type" type="radio" value="Masculin" required />
                <input name="_sexe" type="hidden" value="on" id="_sexe" />
                <label  for="sexe_m">Masculin</label>&nbsp; &nbsp;
             
                <input id="sexe-f" name="sexe_type" type="radio" value="Feminin" required />
                <input name="_sexe" type="hidden" value="on" id="_sexe" />
                <label for="sexe-f">Feminin</label> 
                <span class="text-danger"> <?php echo form_error('sexe_type'); ?> </span>
                 <span class="text-danger" id="miss_sexe"></span>
            </div> &nbsp; &nbsp;

            <div class="form-group row">
                <label for="inputFonction" class="col-sm-2 col-form-label"> </label>
              <div class="col-sm-8">             
                  <select class="form-control" id="inputFonction" name="inputFonction" >
                    <option id="inputFonction" required> Fonction </option> 
                    <?php foreach ($roles as $rows) :?>
                      <option value="<?php echo $rows->nom ?>" id="inputFonction" required><?php echo $rows->nom; ?></option>
                    <span class="text-danger"><?php echo form_error('inputFonction'); ?></span>
                    <span class="text-danger" id="missInputFonction"></span>
                      <?php endforeach?>
                  </select>
              </div>      
            </div>

            <div class="form-group row">
              <label for="mot_de_passe" class="col-sm-2 col-form-label">Mot de passe</label>
              <div class="col-sm-8">
                <input type="password" class="form-control" name="mot_de_passe" id="mot_de_passe" value="<?php echo set_value('mot_de_passe'); ?>" placeholder="********" required />
                <span class="text-danger"> <?php echo form_error('mot_de_passe'); ?> </span>
                <span class="text-danger" id="missMot_de_passe"></span>
              </div>
            </div>
            <div class="form-group row">
              <label for="mot_de_passe_c" class="col-sm-2 col-form-label">Confirmation</label>
              <div class="col-sm-8">
                <input type="password" class="form-control" name="mot_de_passe_c" id="mot_de_passe_c" value="<?php echo set_value('mot_de_passe_c'); ?>"  placeholder="********" required  />
                <span class="text-danger"> <?php echo form_error('mot_de_passe_c'); ?> </span>
                <span class="text-danger" id="missMot_de_passe_c"></span>
              </div>
            </div>
          <!-- </div> -->
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <input type="submit" class="btn btn-primary" id="admregister" name="admregister" value="Enregistre" />
            <!-- </div> -->
            </div>
          </div>
          <?php echo form_close(); ?>
        </div>
      </div>
    </div>

    <script type="text/javascript">
    // Bouton id 
    var formvalid   = document.getElementById('admregister');
    /**
    * les id des champs.
    */
    var prenom    = document.getElementById('inputPrenom');
    var nom     = document.getElementById('inputNom');
    var inputFonction = document.getElementById('inputFonction');
    var sexe_type  = document.getElementById('_sexe');
    var mot_de_passe  = document.getElementById('mot_de_passe');
    var mot_de_passe_c    = document.getElementById('mot_de_passe_c');

    /**
    * Pour gere les erreurs
    */
    var missInputNom  = document.getElementById('missInputNom');
    var missInputPrenom  = document.getElementById('missInputPrenom');
    var miss_sexe  = document.getElementById('miss_sexe');
    var missInputFonction  = document.getElementById('missInputFonction');

    var missMot_de_passe  = document.getElementById('missMot_de_passe');
    var missMot_de_passe_c  = document.getElementById('missMot_de_passe_c');

    formvalid.addEventListener('click', validation );
    function validation(event) {
      if ( nom.validity.valueMissing) {
        event.preventDefault();

        missInputNom.textContent = 'Le nom est requis';
        missInputNom.style.color = 'red';
      }

      if ( prenom.validity.valueMissing) {
        event.preventDefault();

        missInputPrenom.textContent = 'Le prenom est requis';
        missInputPrenom.style.color = 'red';
      }

      if ( inputFonction.validity.valueMissing) {
        event.preventDefault();

        missInputFonction.textContent = 'La fonction est requis';
        missInputFonction.style.color = 'red';
      }

      if ( sexe_type.validity.valueMissing) {
        event.preventDefault();

        miss_sexe.textContent = 'Le sexe est requis';
        miss_sexe.style.color = 'red';
      }

      if ( mot_de_passe.validity.valueMissing) {
        event.preventDefault();

        missMot_de_passe.textContent = 'Le mot de passe est requis';
        missMot_de_passe.style.color = 'red';
      }

      if ( mot_de_passe_c.validity.valueMissing) {
        event.preventDefault();

        missMot_de_passe_c.textContent = 'La confirmation du mot de passe est requis';
        missMot_de_passe_c.style.color = 'red';
      }
    }
    </script>
    <!-- Fin Modal personnel -->

    
    <!-- Modal ajouter classe -->

     <!-- Modal lister classe -->
    
    <!-- Fin Modal lister classe -->

     <!-- Modal Etudiant -->
      <div class="col-lg-4 col-xs-12 col-sm-6 col-md-8">
        <h2>Etudiant actions</h2>
        <p>Cette section presente les differentes action que vous pouvez effectuer sur un etudiant
        (ajouter, supprimer, modifier et lister).
        </p>
        <p>
          <a class="btn btn-primary" href="<?php echo base_url('user/inscrir'); ?>">Ajouter</a>    
          <a class="btn btn-primary" href="<?php echo base_url('user/liste_etudiants'); ?>">Lister</a>
          <a class="btn btn-primary" href="<?php echo base_url('user/liste_inscrir'); ?>">Lister des inscrire</a>
        </p>
      </div>

    <!-- Modal ajouter classe -->
    
    <!-- Fin Modal ajouter classe -->

    <!-- Modal lister classe -->
    
    <!-- Fin Modal lister classe -->

    <!-- row general-->
    </div>
    <!-- Fin modal de modification de roles -->

  <!-- container class-->
  </div>

  


</div> <!-- /container -->


<script type="text/javascript">
  $(document).ready(function(){  
      var i=1;  
      $('#add').click(function(){  
           i++;  
           $('#dynamic_champs').append('<div id="row'+i+'"><div class="form-group row"><label for="classNom" class="col-sm-4 col-form-label">Nom</label><div class="col-sm-8"><input type="text" class="form-control name_list" name="classNom[]" id="classNom" placeholder="1ere anne fondamentale " /><span class="text-danger"> </span></div></div><div class="form-group row"><label for="inputCap" class="col-sm-4 col-form-label">Capacit&eacute</label><div class="col-sm-8"><input type="text" class="form-control name_list" name="inputCap[]" id="inputCap" placeholder="Capacite de la classe" /><span class="text-danger"> </span></div></div><a href="#" name="remove" id="'+i+'" class="btn_remove"> - moins de champs</a></div>');  
      });  
      $(document).on('click', '.btn_remove', function(){  
           var button_id = $(this).attr("id");   
           $('#row'+button_id+'').remove();  
      });  
      $('#submit').click(function(){            
           $.ajax({  
                url:"<?php echo base_url('Parametres/ajoute_fournitures'); ?>",  
                method:"POST",  
                data:$('#add_name').serialize(),  
                success:function(data)  
                {  
                    alert(data);  
                    $('#add_name')[0].reset();  
                }  
           });  
      });  
 });  
</script>