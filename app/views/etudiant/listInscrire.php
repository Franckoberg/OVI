	<!-- Menus -->
<!-- 	<div class="container"></div>  -->  
	<div class="container  ">
		<h2 class="sub-header">Liste des nouveaux inscrits </h2>
		<!--  <span class="text-danger" errors="*{signalerS}"> </span> -->
		<table class="table table-striped">
			<p>Total inscrires : <?php echo $inscrire[0]->nbre_de_inscrires; ?> </p>
			<a href="<?php echo base_url('admin/StatistiqueEtudiants'); ?>">Statistiques</a>
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
					<th>Valide</th>
				</tr>
			</thead>

			<tbody> 
				<?php if(!empty($result)): ?>
				<?php foreach ($result as $key): ?> <?php // var_dump($key); ?>
				<tr>
					<td><?php echo $key->matricule; ?></td>
					<td><?php echo $key->etudiant_name; ?></td>
					<td><?php echo $key->prenom; ?></td>
					<td><?php echo $key->sexe; ?></td>
					<td><?php echo $key->ages; ?> ans</td>
					<td><?php echo $key->adresse;  ?></td>
					<td><?php echo $key->telephone;  ?></td>
					<td><?php echo $key->option_name; ?></td>
					<?php if($key->active === '0'): ?>
						<td>
							<a href="<?php echo base_url('user/activeUser/').$key->id_etudiant ?>">
							<img class="img-circle" src="<?php echo base_url('assets/img/Croix.png'); ?>" width="50" height="50" />
								<?php // echo 'Payé';  ?>
									
							</a>
						</td>
					<?php else : ?>
						<td>
							<img class="img-circle" src="<?php echo base_url('assets/img/logo-verifie.png'); ?>" width="50" height="50" />
						</td>
					<?php endif ?>
         
					<td>
						<?php if($key->sexe === 'Feminin'): ?>
						<img class="img-circle" src="<?php echo base_url('assets/img/lady_user-icon.png'); ?>" width="50" height="50" />
						<?php elseif(!empty($key->foto)): ?>
						<img class="img-circle" src="<?php echo base_url('assets/img/'). $key->foto; ?>" width="50" height="50" />
						<?php else: ?>
						<img class="img-circle" src="<?php echo base_url('assets/img/male_user-icon.png'); ?>" width="50" height="50" />
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