 <!-- style perso -->
    <link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">



<!-- Menus -->
	<div class="container">
		<h1 style="font-family: time new roman; ">One vision institute</h1>

		<div class="row">
			<div class="exempleresult_ref_log" id="exempleresult_ref_logcontrole"></div>
			 <div class="exempleresult_ref">
			 	<script>tjsTutoExecute("form-controle");</script>
			<!-- left column -->
			<!-- <form class="form-horizontal" action="<?php //echo base_url('user/inscrir');?>" method="post" accept-charset="utf-8" enctype="multipart/form-data" > -->
				 <?php echo form_open_multipart('user/inscrir','class="form-horizontal"'); ?> 
				<div class="col-md-3">
					<div class="text-center">
						<div id="prev"></div>
						 <!-- <img class="img-circle" src="<?php  echo base_url('assets/img/lady_user-icon.png') ?>"	width="100" height="100" />  -->
							
						<!-- <h6>Upload une photo ..</h6> -->

						<!-- <input id="file" type="file" name="userimage" class="form-control" />  -->
						<span class="text-danger"> </span>
					</div>
				</div>


				<!-- edit form column -->
				<div class="col-md-9 personal-info">

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
					<?php else : ?>
						<div class="alert alert-info alert-dismissable">
							<a class="panel-close close" data-dismiss="alert">×</a>
							<i class="fa fa-coffee"></i> <strong> Formulaire d'inscription </strong>
						</div>
					<?php endif ?>
					<!-- <div class="form-group row disabled">
						<label for="Code-ins" class="col-sm-2 col-form-label">Code Etudiant</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="Code-ins" placeholder="20170901-00001" />
						</div>
					</div> -->
					<div class="form-group row">
						<label for="inputNom" class="col-sm-2 col-form-label">*Nom</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="inputNom" id="inputNom" value="<?php echo set_value('inputNom'); ?>" placeholder="Nom" required />
							<span class="text-danger"> <?php echo form_error('inputNom'); ?></span>
							 <span class="text-danger" id="missNom"></span> 
						</div>
					</div>

					<div class="form-group row">
						<label for="inputPrenom" class="col-sm-2 col-form-label">*Pr&eacutenom</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="inputPrenom" id="inputPrenom" value="<?php echo set_value('inputPrenom'); ?>" placeholder="Prenom" required />
							 <span class="text-danger"><?php echo form_error('inputPrenom'); ?></span>
							 <span class="text-danger" id="missPrenom"></span> 
						</div>
					</div>

				
					<div class="form-group row"> 
						<label for="inputSexe" class="col-sm-2 col-form-label radio-inline"><strong>*Sexe</strong></label>
					    <input id="features1" name="sexe_type" type="radio" value="Masculin" required />
					    <input name="_features" type="hidden" value="on" />
					    <label  for="features1">Masculin</label>
					 
					    <input id="features2" name="sexe_type" type="radio" value="Feminin" required />
					    <input name="_features" type="hidden" value="on" />
					    <label for="features2">Feminin</label>
					    <span class="text-danger" id="missSexe_type"></span>
					</div>&nbsp; &nbsp;

					<div class="form-group row">
						<label for="inputNationalite" class="col-sm-2 col-form-label">*Nationalit&eacute
						</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="inputNationalite" id="inputNationalite" value="<?php echo set_value('inputNationalite'); ?>" placeholder="Nationalite" required /> 
							<span class="text-danger"><?php echo form_error('inputNationalite'); ?></span>
							<span class="text-danger" id="missNationalite"></span> 
						</div>
					</div>

					<div class="form-group row">
						<label for="date_naiss" class="col-sm-2 col-form-label">*Date
							de Naissance</label>
						<div class="col-sm-8">
							<input type="date" class="form-control" id="date_naiss" name="date_naiss" placeholder="aa-mm-jj" required /> 
							<span class="text-danger" id="missDate_naiss"></span>
						</div>
					</div>

					<div class="form-group row">
						<label for="inputLieuNaissance" class="col-sm-2 col-form-label">*Lieu
							de Naissance</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="inputLieuNaissance" name="inputLieuNaissance" placeholder="Lieu de Naissance" required />
							<span class="text-danger" id="missLieuNaiss"></span>
						</div>
					</div>

					<div class="form-group row">
						<label for="inputAdresse" class="col-sm-2 col-form-label">*Adresse</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="inputAdresse" placeholder="Adresse" name="inputAdresse" required />
							<span class="text-danger" id="missAdresse_p"></span>
						</div>
					</div>
					<div class="form-group row">
						<label for="inputTelephone" class="col-sm-2 col-form-label">*T&eacutelephone</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="inputTelephone" placeholder="Telephone" name="inputTelephone" required /> 
							 <span class="text-danger"><?php echo form_error('inputTelephone'); ?></span>
							<span class="text-danger" id="missInputTelephone"></span>
						</div>
					</div>
					<div class="form-group row">
						<label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="inputEmail" placeholder="Email" name="inputEmail" />
							<span class="text-danger"><?php echo form_error('inputEmail'); ?></span>
						</div>
					</div>

					<div class="form-group row">
		                <label for="inputQuestion" class="col-sm-2 col-form-label"> </label>
						<div class="col-sm-8">					   
						    <select class="form-control" id="inputQuestion" name="inputQuestion" required>
						    	<option> Question secret </option>
						    	<?php foreach ($question as $rows) :?> 
						      	<option value="<?php echo $rows->id_question ?>" ><?php echo $rows->question; ?></option>
								<span class="text-danger"><?php echo form_error('inputQuestion'); ?></span>
								<span class="text-danger" id="missInputQuestion"></span> 
						        <?php endforeach?>
						    </select>
						</div>			
					</div>
					<div class="form-group row">
						<label for="inputRepons" class="col-sm-2 col-form-label"></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="inputRepons" id="inputRepons" value="<?php // echo set_value('inputRepons'); ?>" placeholder="Votre reponse" required /> 
							<span class="text-danger"><?php echo form_error('inputRepons'); ?></span>
							<span class="text-danger" id="missInputRepons"></span> 
						</div>
					</div>

					<h2>*Status Matrimonial</h2>
 
					<div>
					    <input id="celi-stat" name="_status_matri" type="radio" value="Célibataire" required/>
					    <input name="_status-m" type="hidden" value="on" />
					    <label for="celi-stat">C&eacutelibataire</label>
					 
					    <input id="mari-stat" name="_status_matri" type="radio" value="Marié" required/>
					    <input name="_status-m" type="hidden" value="on" />
					    <label for="mari-stat">Mari&eacute</label>
					 
					    <input id="fian-stat" name="_status_matri" type="radio" value="Fiancé" required/>
					    <input name="_status-m" type="hidden" value="on" />
					    <label for="fian-stat">Fianc&eacute</label>
					    <span class="text-danger" id="miss_status_matri"></span>
					</div> <span class="text-danger" id="miss_status_matri"></span>&nbsp; &nbsp; &nbsp; &nbsp; <br> </br>

					<div class="form-group row">
						<label for="inputsante" class="col-sm-2 col-form-label">*Probl&eacutemes m&eacutedicaux</label>
						<div class="col-sm-8">
							<!-- <input type="text" class="form-control" name="inputsante" id="inputsante" placeholder="" /> 
							<span class="text-danger" errors="*{profession}"> </span> -->
							<textarea class="form-control" name="inputsante" id="inputsante" value="<?php echo set_value('inputsante'); ?>" required></textarea>
							<span class="text-danger"> <?php echo form_error('inputsante'); ?> </span>
							<span class="text-danger" id="missInputsante"></span>
						</div>
					</div>

					<div class="form-group row"> <?php // echo set_value('groupe_sang'); ?>
						<label for="inputSexe" class="col-sm-2 col-form-label radio-inline"><strong>Groupe sanguin</strong>
						</label>
					    
					    <input id="groupe-a" name="groupe_sang" type="radio" value="A+" required/>
					    <input name="_groupe_sanguin" type="hidden" value="on" />
					    <label  for="groupe-a">A+</label>&nbsp; &nbsp;
					 
					    <input id="groupe-b" name="groupe_sang" type="radio" value="O-" />
					    <input name="_groupe_sanguin" type="hidden" value="on" />
					    <label for="groupe-b">O-</label>&nbsp; &nbsp;

					     <input id="groupe-c" name="groupe_sang" type="radio" value="B+" />
					    <input name="_groupe_sanguin" type="hidden" value="on" />
					    <label for="groupe-c">B+</label>&nbsp; &nbsp;

					    <input id="groupe-a" name="groupe_sang" type="radio" value="O+" />
					    <input name="_groupe_sanguin" type="hidden" value="on" />
					    <label  for="groupe-a">O+</label>&nbsp; &nbsp;

					    <input id="groupe-c" name="groupe_sang" type="radio" value="B-" />
					    <input name="_groupe_sanguin" type="hidden" value="on" />
					    <label for="groupe-c">B-</label>&nbsp; &nbsp;

					    <input id="groupe-d" name="groupe_sang" type="radio" value="A-" />
					    <input name="_groupe_sanguin" type="hidden" value="on" />
					    <label for="groupe-d">A-</label>

					    <input id="groupe-d" name="groupe_sang" type="radio" value="AB-" />
					    <input name="_groupe_sanguin" type="hidden" value="on" />
					    <label for="groupe-d">AB-</label>

					    <input id="groupe-d" name="groupe_sang" type="radio" value="AB+" />
					    <input name="_groupe_sanguin" type="hidden" value="on" />
					    <label for="groupe-d">AB+</label>
					    <span class="text-danger"> <?php echo form_error('groupe_sang'); ?> </span>
					    <span class="text-danger" id="missGroupe_sang"></span>
					</div> &nbsp; &nbsp;

					<h2>En cas d'urgence</h2>

					<div class="form-group row">
						<label for="inputpersapp" class="col-sm-2 col-form-label">*Personne à appeler</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="inputpersapp" id="inputpersapp" value="<?php echo set_value('inputpersapp'); ?>" placeholder="Nom de la (les) personne(s)" required />
							 <span class="text-danger"><?php echo form_error('inputpersapp'); ?></span>
							 <span class="text-danger" id="missInputpersapp"></span>
						</div>
					</div>

					<div class="form-group row">
						<label for="inputTelephone_ua" class="col-sm-2 col-form-label">*T&eacutelephone</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="inputTelephone_ua" id="inputTelephone_ua" value="<?php echo set_value('inputTelephone_ua'); ?>" placeholder="Telephone" required />
							 <span class="text-danger"><?php echo form_error('inputTelephone_ua'); ?></span>
							 <span class="text-danger" id="missInputTelephone_ua"></span>
						</div>
					</div>
					<div class="form-group row">
						<label for="inputTelephone_ub" class="col-sm-2 col-form-label">T&eacutelephone</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="inputTelephone_ub" id="inputTelephone_ub" value="<?php echo set_value('inputTelephone_ub'); ?>" placeholder="Telephone"  />
							 <span class="text-danger"><?php echo form_error('inputTelephone_ub'); ?></span>
							 <span class="text-danger" id="missInputTelephone_ub"></span>
						</div>
					</div>
					<div class="form-group row">
						<label for="inputAdresse_uc" class="col-sm-2 col-form-label">*Adresse</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="inputAdresse_uc" id="inputAdresse_uc" value="<?php echo set_value('inputAdresse_uc'); ?>" placeholder="Adresse" required />
							 <span class="text-danger" errors="*{email}"><?php echo form_error('inputAdresse_uc'); ?></span>
							 <span class="text-danger" id="missInputAdresse_uc"></span>
						</div>
					</div>

					<div class="form-group row">
						<label for="inputEmail_u" class="col-sm-2 col-form-label">Email</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="inputEmail_u" id="inputEmail_u"  placeholder="Email" />
							<span class="text-danger"><?php echo form_error('inputEmail_u'); ?></span> 
							<span class="text-danger" id="missInputEmail_u"></span>
						</div>
					</div>

					<div class="form-group row">
		                <label for="option_name" class="col-sm-2 col-form-label"> </label>
						<div class="col-sm-8">					   
						    <select class="form-control" id="option_name" name="option_name" required>
						    	<option> *Options </option>
						    	<?php $option = $this->user->options(); ?>
						    	<?php foreach ($option as $rows) :?> 
						      	<option value="<?php echo $rows->id_option ?>" ><?php echo $rows->nom; ?></option>
								<span class="text-danger"><?php echo form_error('option_name'); ?></span>
								<span class="text-danger" id="missoption_name"></span> 
						        <?php endforeach?>
						    </select>
						</div>			
					</div>

					<!-- .col-xs-6 .col-sm-4 -->

				    <!-- <div class="form-group row"> -->
				    	<p style="font-family: time new roman; font-size: 20px;">Pourquoi choisissez-vous <b>OVI</b> pour etudier? </p>
				    <!-- </div> -->
				    <div class="form-group row">
						<!-- <label for="inputsante" class="col-sm-2 col-form-label">Problemes m&eacutedicaux</label> -->
						<div class="col-sm-10">
							<!-- <input type="text" class="form-control" name="inputsante" id="inputsante" placeholder="" /> 
							<span class="text-danger" errors="*{profession}"> </span> -->
							<textarea class="form-control" name="raisonetude" id="raisonetude" value="<?php echo set_value('raisonetude'); ?>"></textarea>
							<span class="text-danger"> <?php echo form_error('raisonetude'); ?> </span>
							<span class="text-danger" id="missraisonetude"></span>
						</div>
					</div>

					<div class="row">
						<h3 style="font-family: time new roman; font-size: 20px;"> Où avez-vous entendu parler de <i> One Vision Institute?</i></h3>
				       <div class="col-xs-6 col-sm-4">			        
					        <div class="checkbox">
					          <label>
					            <input id="pub" name="pub_ovi" type="radio" value="radio" required/>
					    		<input name="pub_" type="hidden" value="on" />
					    		Radio
					          </label>
					          <span class="text-danger" id="missPub_ovi"></span>
					        </div>
					        <div class="checkbox">
					          <label>
					           <input  name="pub_ovi" type="radio" value="television" />
					    	   <input name="pub_" type="hidden" value="on" />
					    	   Television
					          </label>
					          <!-- <span class="text-danger" id="missPub_ovi"></span> -->
					        </div>
					        <div class="checkbox">
					          <label>
					           <input name="pub_ovi" type="radio" value="Eglise" />
					    	   <input name="pub_" type="hidden" value="on" />
					    	   &Eacuteglise
					          </label>
					          <!-- <span class="text-danger" id="missPub_ovi"></span> -->
					        </div>		        
					    </div>
						<div class="col-xs-6 col-sm-4">					        
						    <div class="checkbox">
						      <label>
						        <input id="pub" name="pub_ovi" type="radio" value="Internet" required/>
								<input name="pub_" type="hidden" value="on" />
								Internet
						      </label>
						      <!-- <span class="text-danger" id="missPub_ovi"></span> -->
						    </div>
						    <div class="checkbox">
						      <label>
						       <input id="pub" name="pub_ovi" type="radio" value="Ecole" required/>
							   <input name="pub_" type="hidden" value="on" />
							   Ecole
						      </label>
						    </div>
						    <div class="checkbox">
						      <label>
						       <input id="pub" name="pub_ovi" type="radio" value="Bilbord" required/>
							   <input name="pub_" type="hidden" value="on" />
							   Bilbord
						      </label>
						    </div>				        
						</div>

						<div class="col-xs-6 col-sm-4">					        
						    <div class="checkbox">
						      <label>
						        <input id="pub" name="pub_ovi" type="radio" value="Ami(e)" required/>
								<input name="pub_" type="hidden" value="on" />
								Ami(e)
						      </label>
						    </div>
						    <div class="checkbox">
						      <label>
						       <input id="pub" name="pub_ovi" type="radio" value="publiciste" required/>
							   <input name="pub_" type="hidden" value="on" />
							   publiciste
						      </label>
						    </div>	
						    <div class="checkbox">
						      <label>
						       <input id="pub" name="pub_ovi" type="radio" value="flys" required/>
							   <input name="pub_" type="hidden" value="on" />
							   Flys
						      </label>
						    </div>				        
						</div>
					    
					</div>

					<p style="font-family: time new roman; font-size: 20px;">Nom de la personne de r&eacuteference ou de l'entit&eacute </p>
					<div class="form-group row">
						<div class="col-sm-10">
							<input type="text" class="form-control" name="inputPersNom" id="inputPersNom"  placeholder="Nom" required />
							 <span class="text-danger"><?php echo form_error('inputPersNom'); ?></span>
							 <span class="text-danger" id="missInputpersNom"></span>
						</div>
					</div>
					

					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-8">
							<input type="submit" name="save" id="save" class="btn btn-primary" type="submit" value="Enregistre" />
							<span></span> <input type="reset" class="btn btn-default" value="Cancel" />
						</div>
					</div>

				</div>
			</form>
		</div>


<script type="text/javascript">
	// Bouton id 
	var formvalid 	= document.getElementById('save');
	/**
	* les id des champs.
	*/
	var prenom 		= document.getElementById('inputPrenom');
	var nom 		= document.getElementById('inputNom');
	var sexe_type 		= document.getElementById('features1');
	var nationalite	= document.getElementById('inputNationalite');
	var date_naiss	= document.getElementById('date_naiss');
	var inputLieuNaissance	= document.getElementById('inputLieuNaissance');
	var inputAdresse	= document.getElementById('inputAdresse');
	var inputTelephone	= document.getElementById('inputTelephone');
	var inputQuestion 		= document.getElementById('inputQuestion');
	var inputRepons 		= document.getElementById('inputRepons');
	var celi_stat 		= document.getElementById('celi-stat');
	var inputsante 		= document.getElementById('inputsante');
	var groupe_sang 		= document.getElementById('groupe-a');
	var inputpersapp 		= document.getElementById('inputpersapp');
	var inputTelephone_ua 		= document.getElementById('inputTelephone_ua');
	// var inputTelephone_ub 		= document.getElementById('inputTelephone_ub');
	var inputAdresse_uc 		= document.getElementById('inputAdresse_uc');
	// var inputEmail_u 		= document.getElementById('inputEmail_u');
	var option 		= document.getElementById('option');
	var raisonetude 		= document.getElementById('raisonetude');
	var pub 		= document.getElementById('pub');
	var inputPersNom 		= document.getElementById('inputPersNom');


	
	/**
	* Pour gere les erreurs
	*/
	var missNom  = document.getElementById('missNom');
	var missPrenom  = document.getElementById('missPrenom');
	var missSexe_type  = document.getElementById('missSexe_type');
	var missNationalite  = document.getElementById('missNationalite');
	var missDate_naiss  = document.getElementById('missDate_naiss');
	var missLieuNaiss  = document.getElementById('missLieuNaiss');
	var missAdresse_p  = document.getElementById('missAdresse_p');
	var missInputTelephone  = document.getElementById('missInputTelephone');
	var missInputQuestion  = document.getElementById('missInputQuestion'); 
	var missInputRepons  = document.getElementById('missInputRepons');
	var miss_status_matri  = document.getElementById('miss_status_matri');
	var missInputsante  = document.getElementById('missInputsante');
	var missGroupe_sang  = document.getElementById('missGroupe_sang');
	var missInputpersapp  = document.getElementById('missInputpersapp');
	var missInputTelephone_ua  = document.getElementById('missInputTelephone_ua');
	// var missInputTelephone_ub  = document.getElementById('missInputTelephone_ub');
	var missInputAdresse_uc  = document.getElementById('missInputAdresse_uc');
	// var missInputEmail_u  = document.getElementById('missInputEmail_u');
	var missraisonetude  	= document.getElementById('missraisonetude');
	var missoption_name[]  	= document.getElementById('missoption_name[]');
	var missInputpersNom  	= document.getElementById('missInputpersNom');
	var missPub_ovi  			= document.getElementById('missPub_ovi');


	formvalid.addEventListener('click', validation );

	function validation(event) {
		if ( nom.validity.valueMissing) {
			event.preventDefault();

			missNom.textContent = 'Le nom est requis';
			missNom.style.color = 'red';
		}

		if ( prenom.validity.valueMissing) {
			event.preventDefault();

			missPrenom.textContent = 'Le prénom est requis';
			missPrenom.style.color = 'red';
		}

		if ( sexe_type.validity.valueMissing) {
			event.preventDefault();

			missSexe_type.textContent = 'Le sexe est requis';
			missSexe_type.style.color = 'red';
		}

		if ( nationalite.validity.valueMissing) {
			event.preventDefault();

			missNationalite.textContent = 'La nationalité est requise';
			missNationalite.style.color = 'red';
		}

		if ( date_naiss.validity.valueMissing) {
			event.preventDefault();

			missDate_naiss.textContent = 'La date de naissance est requise';
			missDate_naiss.style.color = 'red';
		}

		if ( inputLieuNaissance.validity.valueMissing) {
			event.preventDefault();

			missLieuNaiss.textContent = 'Le lieu de naissance est requis';
			missLieuNaiss.style.color = 'red';
		}

		if ( inputAdresse.validity.valueMissing) {
			event.preventDefault();

			missAdresse_p.textContent = 'L\'adresse est requis';
			missAdresse_p.style.color = 'red';
		}

		if ( inputTelephone.validity.valueMissing) {
			event.preventDefault();

			missInputTelephone.textContent = 'Le télephone est requis';
			missInputTelephone.style.color = 'red';
		}

		if ( inputQuestion.validity.valueMissing) {
			event.preventDefault();

			missInputQuestion.textContent = 'La question secrete est requise';
			missInputQuestion.style.color = 'red';
		}

		if ( inputRepons.validity.valueMissing) {
			event.preventDefault();

			missInputRepons.textContent = 'Votre reponse est important';
			missInputRepons.style.color = 'red';
		}

		if ( celi_stat.validity.valueMissing) {
			event.preventDefault();

			miss_status_matri.textContent = 'Le status matrimonial est requis';
			miss_status_matri.style.color = 'red';
		}

		if ( inputsante.validity.valueMissing) {
			event.preventDefault();

			missInputsante.textContent = 'Le(s) probléme(s) de votre sante est(sont) requis';
			missInputsante.style.color = 'red';
		}

		if ( groupe_sang.validity.valueMissing) {
			event.preventDefault();

			missGroupe_sang.textContent = 'Le groupe sanguin est requis';
			missGroupe_sang.style.color = 'red';
		}

		if ( inputpersapp.validity.valueMissing) {
			event.preventDefault();

			missInputpersapp.textContent = 'Le nom complet de la personne est requis';
			missInputpersapp.style.color = 'red';
		}

		if ( inputTelephone_ua.validity.valueMissing) {
			event.preventDefault();

			missInputTelephone_ua.textContent = 'Le télephone de la personne est requis';
			missInputTelephone_ua.style.color = 'red';
		}

		// if ( inputTelephone_ub.validity.valueMissing) {
		// 	event.preventDefault();

		// 	missInputTelephone_ub.textContent = 'Le télephone de la personne est requis';
		// 	missInputTelephone_ub.style.color = 'red';
		// }

		if ( inputAdresse_uc.validity.valueMissing) {
			event.preventDefault();

			missInputAdresse_uc.textContent = 'L\'adresse de la personne est requis';
			missInputAdresse_uc.style.color = 'red';
		}		

		if ( option.validity.valueMissing) {
			event.preventDefault();

			missoption_name[].textContent = 'Une option est requise';
			missoption_name[].style.color = 'red';
		}

		if ( raisonetude.validity.valueMissing) {
			event.preventDefault();

			missraisonetude.textContent = 'Reponse requis';
			missraisonetude.style.color = 'red';
		}

		if ( inputPersNom.validity.valueMissing) {
			event.preventDefault();

			missInputpersNom.textContent = 'Le nom est requis';
			missInputpersNom.style.color = 'red';
		}

		if ( pub.validity.valueMissing) {
			event.preventDefault();

			missPub_ovi.textContent = 'Reponse requis';
			missPub_ovi.style.color = 'red';
		}
		
	}
</script>

<script type="text/javascript">
	(function() {        
		function createThumbnail(file) {
		    var reader = new FileReader();
		        reader.onload = function() {
		            var imgElement = document.createElement('img');
	                    imgElement.style.maxWidth = '150px';
	                    imgElement.style.maxHeight = '150px';
	                    imgElement.src = this.result;
	                    prev.appendChild(imgElement);
	            };
	            reader.readAsDataURL(file);
	    }
            var allowedTypes = ['png', 'jpg', 'jpeg', 'gif'],
            fileInput = document.querySelector('#file'),
            prev = document.querySelector('#prev');
            fileInput.onchange = function() {
               var files = this.files,
               filesLen = files.length,
               imgType;
                for (var i = 0 ; i < filesLen ; i++) {
                    imgType = files[i].name.split('.');
                    imgType = imgType[imgType.length - 1];
                    if(allowedTypes.indexOf(imgType) != -1) {
                    	createThumbnail(files[i]);
                    }
                }
            };
    })();
</script>