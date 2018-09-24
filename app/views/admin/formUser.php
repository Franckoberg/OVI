<!-- <body layout:fragment="content" class="spacer"> --> 

<!-- <input id="file" type="file" multiple /> <div id="prev"></div> -->
	<!-- Menus -->
	
	<div class="container">
		<h1>Formulaire d'enregistrement</h1>

		<div class="row">
			<!-- left column -->
			<form class="form-horizontal" action="<?php echo base_url('user/updregister');?>" method="post" accept-charset="utf-8" enctype="multipart/form-data"> 
				<div class="col-md-3">
					<div class="text-center">
						<div id="prev"></div>
						<!-- <img class="img-circle" src="<?php // echo base_url('assets/img/lady_user-icon.png') ?>"
							width="100" height="100" /> -->
							
						<h6>Upload une photo ..</h6>

						<input id="file" type="file" name="userimage" class="form-control" /> 
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
							<i class="fa fa-coffee"></i> <strong>Bonjour </strong> user
						</div>
					<?php endif ?>

					<h3>Saisir les informations</h3>
					<?php // if(!empty($personnel)): ?>  <?php // var_dump($personnel); ?>
					<?php foreach ($personnel as $key): ?>

					<div class="form-group row">
						<label for="code" class="col-sm-2 col-form-label">Matricule</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="code-" id="code" value="<?php echo $key->matricule ?>" placeholder="Nom" disabled />
							<input type="hidden" class="form-control" name="code" id="code" value="<?php echo $key->matricule ?>" placeholder="Nom"  />
							<span class="text-danger"> <?php echo form_error('code'); ?></span>
						</div>
					</div>
					
					<div class="form-group row">
						<label for="inputNom" class="col-sm-2 col-form-label">*Nom</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="inputNom" id="inputNom" value="<?php echo $key->nom ?>" placeholder="Nom" disabled />
							<span class="text-danger"> <?php echo form_error('inputNom'); ?></span>
							 <span class="text-danger" id="missNom"></span> 
						</div>
					</div>

					<div class="form-group row">
						<label for="inputPrenom" class="col-sm-2 col-form-label">*Pr&eacutenom</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="inputPrenom" id="inputPrenom" value="<?php echo $key->prenom ?>" placeholder="Prenom" disabled />
							 <span class="text-danger"><?php echo form_error('inputPrenom'); ?></span>
							 <span class="text-danger" id="missPrenom"></span> 
						</div>
					</div>

					<div class="form-group row">
						<label for="inputNationalite" class="col-sm-2 col-form-label">*Nationalit&eacute
						</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="inputNationalite" id="inputNationalite" value="<?php echo set_value('inputNationalite'); ?>" placeholder="Nationalite" required /> 
							<span class="text-danger"><?php echo form_error('inputNationalite'); ?></span>
							<span class="text-danger" id="missNationalite"></span> 
						</div>
					</div>

					<?php endforeach ?>
					<?php // endif ?>

					<?php // foreach ($personnel as $key): ?>
					<div class="form-group row">
						<label for="date_naiss" class="col-sm-2 col-form-label">*Date de Naissance
						</label>
						<div class="col-sm-8">
							<input type="date" class="form-control" name="date_naiss" id="date_naiss" value="<?php echo set_value('date_naiss'); ?>" placeholder="aa-mm-jj" required /> 
							<span class="text-danger"> <?php echo form_error('date_naiss'); ?> </span>
							<span class="text-danger" id="missDate_naiss"></span>
						</div>
					</div>

					<div class="form-group row">
						<label for="mot_de_passe" class="col-sm-2 col-form-label">*Mot de passe</label>
						<div class="col-sm-8">
							<input type="password" class="form-control" name="mot_de_passe" id="mot_de_passe" value="<?php echo set_value('mot_de_passe'); ?>" placeholder="********" required />
							<span class="text-danger"> <?php echo form_error('mot_de_passe'); ?> </span>
							<span class="text-danger" id="missMot_de_passe"></span> 
						</div>
					</div>
					<div class="form-group row">
						<label for="mot_de_passe_c" class="col-sm-2 col-form-label">*Confirmation</label>
						<div class="col-sm-8">
							<input type="password" class="form-control" name="mot_de_passe_c" id="mot_de_passe_c" value="<?php echo set_value('mot_de_passe_c'); ?>"  placeholder="********" required />
							<span class="text-danger"> <?php echo form_error('mot_de_passe_c'); ?> </span>
							<span class="text-danger" id="missMot_de_passe_c"></span> 
						</div>
					</div><?php //var_dump($question);  ?>

					<div class="form-group row">
		                <label for="inputQuestion" class="col-sm-2 col-form-label"> </label>
						<div class="col-sm-8">					   
						    <select class="form-control" id="inputQuestion" name="inputQuestion" required >
						    	<option> Question secret </option>
						    	<?php foreach ($question as $rows) :?> 
						      	<option value="<?php echo $rows->question ?>" ><?php echo $rows->question; ?></option>
								<span class="text-danger"><?php echo form_error('inputQuestion'); ?></span>
								<span class="text-danger" id="missInputQuestion"></span> 
						        <?php endforeach?>
						    </select>
						</div>			
					</div>
					<div class="form-group row">
						<label for="inputRepons" class="col-sm-2 col-form-label"></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="inputRepons" id="inputRepons" value="<?php // echo set_value('inputFonction'); ?>" placeholder="Votre reponse" required /> 
							<span class="text-danger" id="missInputRepons"></span> 
						</div>
					</div>

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
					 
					    <input id="groupe-b" name="groupe_sang" type="radio" value="O-" required/>
					    <input name="_groupe_sanguin" type="hidden" value="on" />
					    <label for="groupe-b">O-</label>&nbsp; &nbsp;

					     <input id="groupe-c" name="groupe_sang" type="radio" value="B+" required/>
					    <input name="_groupe_sanguin" type="hidden" value="on" />
					    <label for="groupe-c">B+</label>&nbsp; &nbsp;

					    <input id="groupe-a" name="groupe_sang" type="radio" value="O+" required/>
					    <input name="_groupe_sanguin" type="hidden" value="on" />
					    <label  for="groupe-a">O+</label>&nbsp; &nbsp;

					    <input id="groupe-c" name="groupe_sang" type="radio" value="B-" required/>
					    <input name="_groupe_sanguin" type="hidden" value="on" />
					    <label for="groupe-c">B-</label>&nbsp; &nbsp;

					    <input id="groupe-d" name="groupe_sang" type="radio" value="A-" required/>
					    <input name="_groupe_sanguin" type="hidden" value="on" />
					    <label for="groupe-d">A-</label>

					    <input id="groupe-d" name="groupe_sang" type="radio" value="AB-" required/>
					    <input name="_groupe_sanguin" type="hidden" value="on" />
					    <label for="groupe-d">AB-</label>

					    <input id="groupe-d" name="groupe_sang" type="radio" value="AB+" required/>
					    <input name="_groupe_sanguin" type="hidden" value="on" />
					    <label for="groupe-d">AB+</label>
					    <span class="text-danger"> <?php echo form_error('groupe_sang'); ?> </span>
					    <span class="text-danger" id="missGroupe_sang"></span>
					</div> &nbsp; &nbsp;


					<h2>*Status Matrimonial</h2>
 
					<div>
					    <input id="celi-stat" name="_status_matri" type="radio" value="Celibataire" required/>
					    <input name="_status-m" type="hidden" value="on" />
					    <label for="celi-stat">C&eacutelibataire</label>
					 
					    <input id="mari-stat" name="_status_matri" type="radio" value="Marie" required/>
					    <input name="_status-m" type="hidden" value="on" />
					    <label for="mari-stat">Mari&eacute</label>
					 
					    <input id="fian-stat" name="_status_matri" type="radio" value="Fiance" required/>
					    <input name="_status-m" type="hidden" value="on" />
					    <label for="fian-stat">Fianc&eacute</label>
					    <span class="text-danger" id="miss_status_matri"></span>
					</div> &nbsp; &nbsp; &nbsp; &nbsp; <br> </br>
					
 
					<div class="form-group row">
						<label for="inputProfession" class="col-sm-2 col-form-label">*Profession</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="inputProfession" id="inputProfession" placeholder="Profession" required /> 
							<span class="text-danger"> <?php // echo form_error('inputProfession'); ?> </span>
							<span class="text-danger" id="missInputProfession"></span>
						</div>
					</div>

					<div class="form-group row">
						<label for="inputCin_p" class="col-sm-2 col-form-label">*CIN/NIF</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="inputCin_p" id="inputCin_p" value="<?php echo set_value('inputCin_p'); ?>" placeholder="CIN" required />
							<span class="text-danger"><?php echo form_error('inputCin_p'); ?> </span>
							<span class="text-danger" id="missInputCin_p"></span>
						</div>
					</div>

					<div class="form-group row">
						<label for="inputTelephone_p" class="col-sm-2 col-form-label">*T&eacutelephone</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="inputTelephone_p" id="inputTelephone_p" value="<?php echo set_value('inputTelephone_p'); ?>" placeholder="Telephone" required /> 
							<span class="text-danger"><?php echo form_error('inputTelephone_p'); ?></span>
							<span class="text-danger" id="missInputTelephone_p"></span>
						</div>
					</div>

					<div class="form-group row">
						<label for="inputAdresse_p" class="col-sm-2 col-form-label">*Adresse</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="inputAdresse_p" id="inputAdresse_p" value="<?php echo set_value('inputAdresse_p'); ?>" placeholder="Adresse" required /> 
							<span class="text-danger"><?php echo form_error('inputAdresse_p'); ?></span>
							<span class="text-danger" id="missInputAdresse_p"></span>
						</div>
					</div>

					<div class="form-group row">
						<label for="inputEmail_p" class="col-sm-2 col-form-label">Email</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" name="inputEmail_p" id="inputEmail_p" placeholder="Email" />
							 <span class="text-danger"><?php echo form_error('inputEmail_p'); ?></span>
							 <span class="text-danger" id="missInputEmail_p"></span>
						</div>
					</div>

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
							<input type="text" class="form-control" name="inputTelephone_ub" id="inputTelephone_ub" value="<?php echo set_value('inputTelephone_ub'); ?>" placeholder="Telephone" />
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
					<?php // endforeach ?>

					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-8">
							<input type="submit" class="btn btn-primary" id="register" name="register" value="Enregistre">
							<span></span> <input type="reset" class="btn btn-default" value="Cancel" />
						</div>
					</div>
				</div>				
			</form>
		</div>
	</div>

<script type="text/javascript">
	// Bouton id 
	var formvalid 	= document.getElementById('register');
	/**
	* les id des champs.
	*/
	var prenom 		= document.getElementById('inputPrenom');
	var nom 		= document.getElementById('inputNom');
	var nationalite	= document.getElementById('inputNationalite');
	var date_naiss	= document.getElementById('date_naiss');
	var mot_de_passe 	= document.getElementById('mot_de_passe');
	var mot_de_passe_c 		= document.getElementById('mot_de_passe_c');
	var inputsante 		= document.getElementById('inputsante');
	var groupe_sang 		= document.getElementById('groupe_sang');
	var celi_stat 		= document.getElementById('celi-stat');

	var profession 	= document.getElementById('inputProfession');
	var inputCin_p 		= document.getElementById('inputCin_p');

	var inputTelephone_p 		= document.getElementById('inputTelephone_p');
	var inputAdresse_p 		= document.getElementById('inputAdresse_p');
	// var inputEmail_p 		= document.getElementById('inputEmail_p');
	var inputpersapp 		= document.getElementById('inputpersapp');
	var inputTelephone_ua 		= document.getElementById('inputTelephone_ua');
	var inputTelephone_ub 		= document.getElementById('inputTelephone_ub');
	var inputAdresse_uc 		= document.getElementById('inputAdresse_uc');
	// var inputEmail_u 		= document.getElementById('inputEmail_u');
	var inputQuestion 		= document.getElementById('inputQuestion');
	var inputRepons 		= document.getElementById('inputRepons');
	
	/**
	* Pour gere les erreurs
	*/
	var missNom  = document.getElementById('missNom');
	var missPrenom  = document.getElementById('missPrenom');
	var missNationalite  = document.getElementById('missNationalite');
	var missDate_naiss  = document.getElementById('missDate_naiss');
	var missMot_de_passe  = document.getElementById('missMot_de_passe');
	var missMot_de_passe_c  = document.getElementById('missMot_de_passe_c');

	var missInputsante  = document.getElementById('missInputsante');

	var missInputProfession  = document.getElementById('missInputProfession');
	
	var missInputCin_p  = document.getElementById('missInputCin_p');
	var missInputTelephone_p  = document.getElementById('missInputTelephone_p');
	var missInputAdresse_p  = document.getElementById('missInputAdresse_p');
	// var missInputEmail_p  = document.getElementById('missInputEmail_p');
	var missInputpersapp  = document.getElementById('missInputpersapp');
	var missInputTelephone_ua  = document.getElementById('missInputTelephone_ua');
	var missInputTelephone_ub  = document.getElementById('missInputTelephone_ub');
	var missInputAdresse_uc  = document.getElementById('missInputAdresse_uc');
	// var missInputEmail_u  = document.getElementById('missInputEmail_u'); 
	var missInputQuestion  = document.getElementById('missInputQuestion'); 
	var missInputRepons  = document.getElementById('missInputRepons'); 
 

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

		if ( mot_de_passe.validity.valueMissing) {
			event.preventDefault();

			missMot_de_passe.textContent = 'Le mot de passe est requis';
			missMot_de_passe.style.color = 'red';
		}

		if ( mot_de_passe_c.validity.valueMissing) {
			event.preventDefault();

			missMot_de_passe_c.textContent = 'La confirmation du mot de passe est requise';
			missMot_de_passe_c.style.color = 'red';
		}

		if ( inputsante.validity.valueMissing) {
			event.preventDefault();

			missInputsante.textContent = 'Le(s) probléme(s) de votre sante est(sont) requis';
			missInputsante.style.color = 'red';
		}

		// if ( groupe_sang.validity.valueMissing) {
		// 	event.preventDefault();

		// 	missPrenom.textContent = 'Le groupe sanguin est requis';
		// 	missPrenom.style.color = 'red';
		// }

		// if ( celi_stat.validity.valueMissing) {
		// 	event.preventDefault();

		// 	missPrenom.textContent = 'Le status matrimonial est requis';
		// 	missPrenom.style.color = 'red';
		// }

		if ( profession.validity.valueMissing) {
			event.preventDefault();

			missInputProfession.textContent = 'Le profession est requis';
			missInputProfession.style.color = 'red';
		}

		if ( inputCin_p.validity.valueMissing) {
			event.preventDefault();

			missInputCin_p.textContent = 'Le cin est requis';
			missInputCin_p.style.color = 'red';
		}

		if ( inputTelephone_p.validity.valueMissing) {
			event.preventDefault();

			missInputTelephone_p.textContent = 'Le télephone est requis';
			missInputTelephone_p.style.color = 'red';
		}

		if ( inputAdresse_p.validity.valueMissing) {
			event.preventDefault();

			missInputAdresse_p.textContent = 'L\'adresse est requise';
			missInputAdresse_p.style.color = 'red';
		}

		// if ( inputEmail_p.validity.valueMissing) {
		// 	event.preventDefault();

		// 	missInputEmail_p.textContent = 'L\'email est requis';
		// 	missInputEmail_p.style.color = 'red';
		// }

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

			missInputAdresse_uc.textContent = 'L\'adresse de la personne est requise';
			missInputAdresse_uc.style.color = 'red';
		}

		// if ( inputEmail_u.validity.valueMissing) {
		// 	event.preventDefault();

		// 	missInputEmail_u.textContent = 'L\'email de la personne est requis';
		// 	missInputEmail_u.style.color = 'red';
		// }

		if ( inputQuestion.validity.valueMissing) {
			event.preventDefault();

			missInputQuestion.textContent = 'La question secret est requise';
			missInputQuestion.style.color = 'red';
		}

		if ( inputRepons.validity.valueMissing) {
			event.preventDefault();

			missInputRepons.textContent = 'Votre reponse est important';
			missInputRepons.style.color = 'red';
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
<!-- 
</body>
</html>