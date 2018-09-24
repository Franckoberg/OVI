<!DOCTYPE html>
<html xmlns:th="http://www.thymeleaf.org"
	xmlns:layout="http://www.ultraq.net.nz/thymeleaf/layout"
	layout:decorator="template">
<head>
<meta charset="UTF-8" />
<title>Editer Etudiant</title>
<link rel="stylesheet" type="text/css"
	href="../static/css/bootstrap.min.css"
	th:href="@{/css/bootstrap.min.css}" />
<link rel="stylesheet" type="text/css" href="../static/css/style.css"
	th:href="@{/css/style.css}" />

</head>
<body layout:fragment="content" class="spacer">

	<!-- Menus -->

	<div class="container">
		<h1>Editer un etudiant</h1>

		<div class="row">
			<!-- left column -->
			<form class="form-horizontal" role="form" th:action="@{saveEtudiant}"
				method="post" th:object="${etudiant}" enctype="multipart/form-data">
				
				<div class="col-md-3">
					<div class="text-center">
						<img class="img-circle" th:src="@{getFoto(id=${etudiant.id})}"
							width="100" height="100" />
						<h6>Upload a different photo...</h6>

						<input type="file" name="picture" class="form-control" /> <span
							class="text-danger" th:errors="*{foto}"> </span>
					</div>
				</div>


				<!-- edit form column -->
				<div class="col-md-9 personal-info">

					<div class="alert alert-info alert-dismissable">
						<a class="panel-close close" data-dismiss="alert">×</a> <i
							class="fa fa-coffee"></i> This is an <strong>.alert</strong>. Use
						this to show important messages to the user.
					</div>
					<h3>Saisie les informations</h3>

					<!-- nouveau champs -->
					<div class="form-group row disabled">
						<label for="id" class="col-sm-2 col-form-label">Id</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="id" th:field="*{id}" />
						</div>
					</div>

					<div class="form-group row disabled">
						<label for="Code-ins" class="col-sm-2 col-form-label">Code
							Etudiant</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="Code-ins"
								th:field="*{codeEtudiant}" />
						</div>
					</div>
					<div class="form-group row">
						<label for="inputNom" class="col-sm-2 col-form-label">Nom</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="inputNom"
								placeholder="Nom" th:field="*{nom}" />
						</div>
					</div>

					<div class="form-group row">
						<label for="Prenom" class="col-sm-2 col-form-label">Prenom</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="inputPrenom"
								placeholder="Prenom" th:field="*{prenom}" />
						</div>
					</div>

			
						<div class="form-group row"> 
					<label for="inputSexe" class="col-sm-2 col-form-label radio-inline"><strong>Sexe</strong></label>
					    <input id="features1" name="features" type="radio" th:field="*{sexe}"  value="Masculin" />
					    <input name="_features" type="hidden" value="on" />
					    <label  for="features1">Masculin</label>
					 
					    <input id="features2" name="features" type="radio" th:field="*{sexe}" value="Feminin" />
					    <input name="_features" type="hidden" value="on" />
					    <label for="features2">Feminin</label> 
					</div> &nbsp; &nbsp;    


					<div class="form-group row">
						<label for="inputDateNaissance" class="col-sm-2 col-form-label">Date
							de Naissance</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="inputDateNaissance"
								placeholder="Date de Naissance" th:field="*{dateNaissance}" />
						</div>
					</div>

					<div class="form-group row">
						<label for="inputLieuNaissance" class="col-sm-2 col-form-label">Lieu
							de Naissance</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="inputLieuNaissance"
								placeholder="Lieu de Naissance" th:field="*{lieuNaissance}" />
						</div>
					</div>

					<div class="form-group row">
						<label for="inputAdresse" class="col-sm-2 col-form-label">Adresse</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="inputAdresse"
								placeholder="Adresse" th:field="*{adresse}" />
						</div>
					</div>
					<div class="form-group row">
						<label for="inputTelephone" class="col-sm-2 col-form-label">Telephone</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="inputTelephone"
								placeholder="Telephone" th:field="*{telephone}" />
						</div>
					</div>

					<div class="form-group row">
						<label for="inputClasse" class="col-sm-2 col-form-label">Classe</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="inputClasse"
								placeholder="Classe" th:field="*{classe}" />
						</div>
					</div>

					<div class="form-group row">
						<label for="inputAnneeAcademique" class="col-sm-2 col-form-label">Annee
							academique</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="inputAnneeAcademique"
								placeholder="Annee Academique" th:field="*{anneeAcademique}" />
						</div>
					</div>
					<div class="form-group row">
						<label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="inputEmail"
								placeholder="Email" th:field="*{email}" />
						</div>
					</div>
					<h2>Personne responsable</h2>

	<!-- 				&nbsp; &nbsp; <label class="checkbox-inline"> <input
						type="checkbox" value="Pere" /> <strong> Pere</strong>
					</label> <label class="checkbox-inline"> <input type="checkbox"
						value="Mere" /> <strong> Mere</strong>
					</label> <label class="checkbox-inline"> <input type="checkbox"
						value="Frere" /> <strong> Frere &nbsp; &nbsp;</strong>
					</label> <label class="checkbox-inline"> <input type="checkbox"
						value="Soeur" /> <strong> Soeur</strong>
					</label> <label class="checkbox-inline"> <input type="checkbox"
						value="Oncle" /> <strong> Oncle</strong>
					</label> <label class="checkbox-inline"> <input type="checkbox"
						value="Tante" /> <strong> Tante</strong>
					</label> &nbsp; &nbsp; <label class="checkbox-inline"> <input
						type="checkbox" value="Autre" /> <strong> Autre</strong>
					</label> &nbsp; &nbsp; &nbsp; &nbsp; <br> </br>
 -->
 
 					<div>
					    <input id="features1" name="features" type="radio" th:field="*{nomp}"  value="Pere " />
					    <input name="_features" type="hidden" value="on" />
					    <label for="features1">Pere</label>
					 
					    <input id="features2" name="features" type="radio" th:field="*{nomp}" value="Mere " />
					    <input name="_features" type="hidden" value="on" />
					    <label for="features2">Mere</label>
					 
					    <input id="features3" name="features" type="radio" th:field="*{nomp}" value="Autre " />
					    <input name="_features" type="hidden" value="on" />
					    <label for="features3">Autre</label>
					</div> &nbsp; &nbsp; &nbsp; &nbsp; <br> </br>
					
 
 
					<div class="form-group row">
						<label for="inputNomp" class="col-sm-2 col-form-label">Nom</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="inputNomp"
								placeholder="Nom" th:field="*{nomp}" />
						</div>
					</div>
					<div class="form-group row">
						<label for="inputTelephone" class="col-sm-2 col-form-label">Telephone</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="inputTelephone"
								placeholder="Telephone" th:field="*{telephonep}" />
						</div>
					</div>

					<div class="form-group row">
						<label for="inputAdresse" class="col-sm-2 col-form-label">Adresse</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="inputAdresse"
								placeholder="Adresse" th:field="*{adressep}" />
						</div>
					</div>


					<h1>Education</h1>
					<h4>Dernier Etablisement frequente</h4>
					<div class="form-group row">
						<label for="outputDate" class="col-sm-2 col-form-label">Annees</label>
						<div class="col-sm-8">
							<input type="date" class="form-control" id="outputDate"
								placeholder="Annees" th:field="*{anne}" />
						</div>
					</div>

					<div class="form-group row">
						<label for="ecolef" class="col-sm-2 col-form-label">Etablissement</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="ecolef"
								placeholder="Nom de l'etablissement" th:field="*{etablissement}" />
						</div>
					</div>

					<div class="form-group row">
						<label for="SignatureE" class="col-sm-2 col-form-label">Signature
							du postulant</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="SignatureE"
								placeholder="Signature" th:field="*{signalerE}" /> <span
								class="text-danger" th:errors="*{signalerE}"> </span>
						</div>
					</div>

					<div class="form-group row">
						<label for="EnregistreS" class="col-sm-2 col-form-label">Enregistre
							par</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="Name"
								placeholder="Signature" th:field="*{signalerS}" /> <span
								class="text-danger" th:errors="*{signalerS}"> </span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-8">
							<button class="btn btn-primary" type="submit">Save
								changes</button>
							<span></span> <input type="reset" class="btn btn-default"
								value="Cancel" />
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>


</body>
</html>