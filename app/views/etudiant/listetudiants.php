	<!-- Menus -->
<!-- 	<div class="container"></div>  -->  
	<div class="container  ">
		<h2 class="sub-header">Liste des etudiants </h2>
		<!--  <span class="text-danger" errors="*{signalerS}"> </span> -->
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Identifiant</th>
					<th>Nom</th>
					<th>Pr&eacutenom</th>
					<th>Sexe</th>
					<th>Âge</th>
					<th>Adresse</th>
					<th>T&eacutel&eacutephone</th>
					<th>Option</th>
				</tr>
			</thead>

			<tbody> 
				<?php if(!empty($result)): ?>
				<?php foreach ($result as $key): ?> <?php //var_dump($key); ?>
				<tr>
					<td><?php echo $key->matricule; ?></td>
					<td><?php echo $key->etudiant_name; ?></td>
					<td><?php echo $key->prenom; ?></td>
					<td><?php echo $key->sexe; ?></td>
					<td><?php echo $key->ages; ?> ans</td>
					<td><?php echo $key->adresse;  ?></td>
					<td>+509 <?php echo $key->telephone;  ?></td>
					<td><?php echo $key->option_name; ?></td>
					<!-- <td><?php // echo $key->option_name; ?>paye</td> -->
					         
					<td>
						<?php if($key->sexe === 'Feminin'): ?>
						<!-- <a href="#profil" data-toggle="modal" data-target="#<?php echo $key->id_etudiant.'vueProfil'; ?>"> -->
						<img class="img-circle" src="<?php echo base_url('assets/img/lady_user-icon.png'); ?>" width="50" height="50" />
						<!-- </a> -->
						<?php elseif(!empty($key->foto)): ?>
						<!-- <a href="#profil" data-toggle="modal" data-target="#<?php echo $key->id_etudiant.'vueProfil'; ?>"> -->
						<img class="img-circle" src="<?php echo base_url('assets/img/'). $key->foto; ?>" width="50" height="50" />
						<!-- </a> -->
						<?php else: ?>
						<!-- <a href="#profil" data-toggle="modal" data-target="#<?php echo $key->id_etudiant.'vueProfil'; ?>"> -->
						<img class="img-circle" src="<?php echo base_url('assets/img/male_user-icon.png'); ?>" width="50" height="50" />
						<!-- </a> -->
						<?php endif ?>
					</td>
				</tr>
				<?php endforeach ?>
				<?php else: ?>
					<tr>
						<td colspan="8">
							<!-- <div class="alert alert-info alert-dismissable"> -->
								<!-- <a class="panel-close close" data-dismiss="alert">×</a> -->
								<!-- <i class="fa fa-coffee"></i> -->
								<center><p> <strong> Information non indisponible. </strong></p></center>
							<!-- </div> -->
						</td>
					</tr>
				<?php endif ?>

			</tbody>
		</table>
	</div>
	<div class="container">
		<ul class="nav nav-pills">
			<li each="p:${pages}" class="${p==pageCourante}?active:''">
				<a text="${p}" href="list(page=${p}, motCle=${motCle})}"></a>
			</li>
		</ul>
	</div>


</body>
</html>