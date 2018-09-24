<div class="conainer spacer" style="width: 800px; position: relative; margin: auto; top: 30px; ">
	<?php if(!empty($fetch)): ?>
	<?php foreach ($fetch as $key ) : ?>
		 <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Information resultat&nbsp; &nbsp; </h3>
            </div>
            <div class="panel-body">
              <div class="row"> <?php // base_url('assets/img/lady_user-icon.png'); ?>
                <div class="col-md-3 col-lg-3" align="center">
                 <img alt="Avatar" src="<?php echo base_url('assets/img/male_user-icon.png');?>" class="img-responsive" width="300" height="300" />             
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
                        <td>Adresse</td>
                        <td><?= $key->adresse; ?></td>
                      </tr>
                      <tr>
                        <td>Status matrimonial </td>
                        <td><?= $key->status_matrimonial; ?></td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td><?= $key->email; ?></td>
                      </tr>
                      <tr>
                        <td>Telephone</td>
                        <td><?= $key->telephone; ?></td>
                      </tr>
                      <tr>
                        <td>Option</td>
                        <td><?php echo $key->options_name; ?></td>
                      </tr>
                      <tr>
                        <td>Probleme medicaux</td>
                        <td><?php echo $key->prob_sante; ?></td>
                      </tr>
                      <tr>
                        <td><h4> Cas D'urgence </h4></td>
                      </tr>
                      <tr>
                        <td>Nom</td>
                        <td><?php echo $key->persapp; ?></td>
                      </tr>                      
                      <tr>
                        <td>Telephone</td>
                        <td><?php echo $key->ugctelephone_a; ?></td>
                      </tr>
                      <tr>
                        <td>Adresse</td>
                        <td><?php echo $key->ugcadresse; ?></td>
                      </tr>
                      
                    </tbody>
                  </table>
   
                </div>
              </div>
            </div>
          </div>
	<?php endforeach ?>
	<?php else: ?>
		<div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Information resultat&nbsp; &nbsp; </h3>
            </div>
            <div class="panel-body">
              <div class="row"> <?php // base_url('assets/img/lady_user-icon.png'); ?>
                <div class="col-md-3 col-lg-3" align="center">             
                </div> 

                <div class=" col-md-9 col-lg-9 ">
                  <table class="table table-user-information">
                    <tbody>
                     <p>Aucun resultat trouve.</p>
                    </tbody>
                  </table>
   
                </div>
              </div>
            </div>
          </div>
	<?php endif ?>

</div>