	<!-- Menus -->

<!-- 	<main role="main" class="container">
	      <div class="jumbotron">
	        <h1> One vision institute</h1>
	      </div>
	</main> -->

<!-- 	<div class="container"></div>  -->  
	<div class="container  ">
		<h2 class="sub-header">Liste des personnels</h2>
		<!--  <span class="text-danger" errors="*{signalerS}"> </span> -->
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Identifiant</th>
					<th>Nom</th>
					<th>Pr&eacutenom</th>
					<th>Sexe</th>
					<th>Adresse</th>
					<th>Email</th>
					<th>Fonction</th>
					<th>&Eacutetat</th>
				</tr>
			</thead>

			<tbody> 
				<?php if(!empty($personnel)): ?>
				<?php foreach ($personnel as $key): ?> <?php // var_dump($key); ?>
				<tr>
					<td><?php echo $key->matricule; ?></td>
					<td><?php echo $key->nom; ?></td>
					<td><?php echo $key->prenom; ?></td>
					<td><?php echo $key->sexe; ?></td>
					<td><?php echo $key->adresse;  ?></td>
					<td><?php echo $key->email; ?></td>
					<td><?php echo $key->fonction; ?></td>
          <?php if($this->session->userdata('fonction') === 'DIRECTEUR'): ?>
					<?php if($key->active === '0'): ?>
						<td><a href="<?php echo base_url('admin/activeUser/').$key->id_user ?>"><?php echo 'Inactif';  ?></a></td>
					<?php else : ?>
						<td><a href="<?php echo base_url('admin/activeUser/').$key->id_user ?>"><?php echo 'Actif'; ?></a></td>
					<?php endif ?>
          <?php endif ?>
					<td>
						<?php if($key->sexe === 'Feminin'): ?>
						<a href="#profil" data-toggle="modal" data-target="#<?php echo $key->id_user.'vueProfil'; ?>">
						<img class="img-circle" src="<?php echo base_url('assets/img/lady_user-icon.png'); ?>" width="40" height="40" />
						</a>
						<?php elseif(!empty($key->foto)): ?>
						<a href="#profil" data-toggle="modal" data-target="#<?php echo $key->id_user.'vueProfil'; ?>">
						<img class="img-circle" src="<?php echo base_url('assets/img/'). $key->foto; ?>" width="40" height="40" />
						</a>
						<?php else: ?>
						<a href="#profil" data-toggle="modal" data-target="#<?php echo $key->id_user.'vueProfil'; ?>">
						<img class="img-circle" src="<?php echo base_url('assets/img/male_user-icon.png'); ?>" width="40" height="40" />
						</a>
						<?php endif ?>
					</td>
					
					<td>
            <?php if($this->session->userdata('fonction') === 'DIRECTEUR'): ?>
						<a href="#" role="button" data-toggle="modal" data-target="#<?php echo $key->id_user.'supp'; ?>">
							<img src="<?php echo base_url('assets/img/delete-icon.png'); ?>" width="30" height="30" />
						</a>
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

	<!--   
  <div class="container" >
	<nav aria-label="...">
	  <ul class="pagination pagination-sm">
	    <li class="page-item disabled">
	      <a class="page-link" href="#" tabindex="-1">Previous</a>
	    </li>
	    <li class="page-item"><a class="page-link" href="#">1</a></li>
	    <li class="page-item"><a class="page-link" href="#">2</a></li>
	    <li class="page-item active"><a class="page-link" href="#">3</a></li>
	    <li class="page-item">
	      <a class="page-link" href="#">Next</a>
	    </li>
	  </ul>
	</nav>
  </div>
 -->

<script src="<?php // echo base_url('assets/js/jquery.min-2.1.1.js'); ?>"></script>
<script src="<?php // echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
 <!-- <script type="text/javascript">
		$(document).ready(function() {
			window.notifications = window.webkitNotifications || window.mozNotifications || window.notifications;
			if(window.notifications.checkPermission() == 0) {
				$.get('notification', function(result) {
					if (result > 0) {
						var notification = window.notifications.createNotification('assets/avatar/pro.png','Nouveau message ', 'Vous avez'+result+'nouveau msg non-lus');
						notification.show();
					}
				});
			} else {
				window.notifications.requestPermission();
			}
		});
	</script> -->


<!-- Modal lister roles -->
  <div class="row">
    <?php foreach ($personnel as $key ) : ?>
      <div class="modal fade " id="<?php echo $key->id_user.'vueProfil'; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content" style="width:500px">
              <!-- <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Liste de roles</h4>
              </div> -->
              <div class="modal-body">
                <!-- -->
                  <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Information Personnel&nbsp; &nbsp;
              <a href="<?php echo base_url('admin/updateProfil/'.$key->id_user); ?>">
              <?php if( $_SESSION['id_user'] === $key->id_user ): ?>
              <img src="<?php echo base_url('assets/img/Edit-icon.png'); ?>" alt="Modifier le profil" width="30" height="30" />
              <?php endif ?>
              </a> </h3>
            </div>
            <div class="panel-body">
              <div class="row"> <?php // base_url('assets/img/lady_user-icon.png'); ?>
                <div class="col-md-3 col-lg-3" align="center">
                  <?php if( ($key->sexe !== 'Masculin') AND ( empty($key->foto)) ): ?>
                  <img alt="Avatar" src="<?php echo base_url('assets/img/lady_user-icon.png');?>" class="img-responsive" width="300" height="300" />
                  <?php elseif ( (!empty($key->foto)) ): ?>
                    <img alt="Avatar" src="<?php echo base_url('assets/avatar/'.$key->foto);?>" class="img-responsive" width="300" height="300" />
                  <?php else : ?>
                   <img alt="Avatar" src="<?php echo base_url('assets/img/male_user-icon.png');?>" class="img-responsive" width="300" height="300" />            
                  <?php endif ?>             
                </div> 

                <div class=" col-md-9 col-lg-9 ">
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>Identifiant</td>
                        <td> <?= $key->matricule; ?></td>
                      </tr>
                      <tr>
                        <td>Nom</td>
                        <td><?= $key->nom; ?></td>
                      </tr>
                      <tr>
                        <td>Prenom</td>
                        <td><?= $key->prenom; ?></td>
                      </tr>
                      <tr>
                        <td>Sexe</td>
                        <td><?= $key->sexe; ?></td>
                      </tr>
                      <tr>
                        <td>Date de naissance</td>
                        <td><?= $key->date_naiss; ?></td>
                      </tr>
                      <tr>
                        <td>NIF</td>
                        <td><?= $key->cin; ?></td>
                      </tr>
                      <tr>
                        <td>Adresse</td>
                        <td><?= $key->adresse; ?></td>
                      </tr>
                      <tr>
                        <td>Telephone</td>
                        <td><?= $key->telephone; ?></td>
                      </tr>

                      <tr>
                        <td>Status matrimonial </td>
                        <td><?= $key->status_matrimonial; ?></td>
                      </tr>
                      <tr>
                        <td>Profession</td>
                        <td><?= $key->profession; ?></td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td><?= $key->email; ?></td>
                      </tr>
                      <tr>
                        <td>Fonction </td>
                        <td><?= $key->fonction; ?></td>
                      </tr>
                      <tr>
                        <td>Status </td>
                        <?php if($key->active === '0'): ?>
                        <td><?php echo 'Inactif';  ?></td>
                        <?php else : ?>
                        <td><?php echo 'Actif'; ?></td>
                      <?php endif ?>
                      </tr>
                    </tbody>
                  </table>
   
                </div>
              </div>
            </div>
          </div>
                <!-- -->
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save</button> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach ?>
      <!-- Fin modal lister roles -->
  
    <?php foreach ($personnel as $key ) : ?>
      <!-- Modal confirmation de suppression de roles -->
      <div class="modal fade " id="<?php echo $key->id_user.'supp'; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content" style="width:500px">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Confirmation de suppression</h4>
              </div>
              <center><span class="span_description">Voulez vous vraiment supprimer cet utilisateur? </span></center>
              <div class="modal-body">
               <div>
                <center>
                  <a class="btn btn-primary" href="http://localhost/OVI/admin/deletePersonnel/<?= $key->id_user; ?>" >Oui</a>
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
      <?php endforeach ?>
      <!-- Fin modal confirmation de suppression de roles -->
  </div>

</body>
</html>