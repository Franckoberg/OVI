<!DOCTYPE html>
<html xmlns:th="http://www.thymeleaf.org"
	xmlns:layout="http://www.ultraq.net.nz/thymeleaf/layout"
	layout:decorator="template">
<head>
<meta charset="UTF-8" />
<title>Etudiant info</title>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"
	th:href="@{/css/bootstrap.min.css}" />
<link rel="stylesheet" type="text/css" href="static/css/style.css"
	th:href="@{/css/style.css}" />

</head>
<body layout:fragment="content" class="spacer">

	<!-- Menus -->

	<div class="container" th:href="@{form}" th:each="e:${pageEtudiants.content}">
		<div class="row">
			<div class="col-md-5  toppad  pull-right col-md-offset-3 ">
				<a th:href="@{edit(id=${etudiant.id})}">Edit Profile</a> 
				<br> </br>
				<p class=" text-info"><span th:text="${etudiant.dateEnregistrement}"></span> </p>
			</div>
			<div
				class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad">

				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="panel-title">Information Etudiant</h3>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-3 col-lg-3 " align="center">
								<img alt="Avatar" th:src="@{getFoto(id=${etudiant.id})}"
									class="img-responsive" width="300" height="300" />
									 
							</div> 

							<div class=" col-md-9 col-lg-9 ">
								<table class="table table-user-information">
									<tbody>

										<tr>
											<td>Identifiant</td>
											<td th:text="${etudiant.codeEtudiant}"></td>
										</tr>
										<tr>
											<td>Nom</td>
											<td th:text="${etudiant.nom}"></td>
										</tr>
										<tr>
											<td>Prenom</td>
											<td th:text="${etudiant.prenom}"></td>
										</tr>
										<tr>
											<td>Sexe</td>
											<td th:text="${etudiant.sexe}"></td>
										</tr>
										<tr>
											<td>Date de naissance</td>
											<td th:text="${etudiant.dateNaissance}"></td>
										</tr>
										<tr>
											<td>Lieu de naissance</td>
											<td th:text="${etudiant.lieuNaissance}"></td>
										</tr>
										<tr>
											<td>Adresse</td>
											<td th:text="${etudiant.adresse}"></td>
										</tr>
										<tr>
											<td>Telephone</td>
											<td th:text="${etudiant.telephone}"></td>
										</tr>

										<tr>
											<td>Niveau </td>
											<td th:text="${etudiant.classe}"></td>
										</tr>
										<tr>
											<td>Annee academique</td>
											<td th:text="${etudiant.anneeAcademique}"></td>
										</tr>
										<tr>
											<td>Email</td>
											<td th:text="${etudiant.email}"></td>
										</tr>
										<tr>
											<td>Personne responsable </td>
											<td th:text="${etudiant.nomp}"></td>
										</tr>
									</tbody>
								</table>
 
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
 

</body>
</html>
