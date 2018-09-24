<div class="container spacer">
	<div class="bs-example">
	    <div class="table-responsive">
	      <table class="table" border="2px">
	        <thead>
	          <tr>
	            <th>#</th>
	            <th>Inscrit</th>
	            <th>Periode</th>
	            <th>Sexe</th>
	          </tr>
	        </thead>
	        <tbody>
	          <tr>
	            <td>Nombres</td>
	            <td>50</td>
	            <td>05-sept-2018 a 23-sept-2018</td>
	            <td></td>
	          </tr>
	        </tbody>
	      </table>
	    </div><!-- /.table-responsive -->
    </div><!-- /example -->
<!-- 	<p>Total inscrires : <?php //echo $inscrire[0]->nbre_de_inscrires; ?> </p> -->
	<?php $poucentage = $inscrire[0]->nbre_de_inscrires; ?>
	<strong>Poucentage valide</strong>
    <div class="progress">
	  <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
	    60%
	  </div>
	</div>
	<!-- Poucentage par sexe -->
	<div class="progress">
	  <div class="progress-bar progress-bar-success progress-bar-striped active" style="width: 35%">35% Filles
	    <span class="sr-only">35% Complete (success)</span>
	  </div>
	  <div class="progress-bar progress-bar-striped active" style="width: 25%">25% Garcon
	    <span class="sr-only">25% Complete (warning)</span>
	  </div>
	  <!-- <div class="progress-bar progress-bar-danger" style="width: 10%">
	    <span class="sr-only">10% Complete (danger)</span>
	  </div> -->
	</div>

	<strong>Options</strong><br />
	<span>Anglais</span>
	<div class="progress">
	  <div class="progress-bar progress-bar-striped active"  role="progressbar" aria-valuenow="<?= $poucentage; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $poucentage; ?>%"><?= $poucentage; ?>%
	    <span class="sr-only">45% Complete</span>
	  </div>
	</div>
	<!-- Poucentage par sexe -->
	<div class="progress">
	  <div class="progress-bar progress-bar-success progress-bar-striped active" style="width: 35%">35% Filles
	    <span class="sr-only">35% Complete (success)</span>
	  </div>
	  <div class="progress-bar progress-bar-striped active" style="width: 25%">25% Garcon
	    <span class="sr-only">25% Complete (warning)</span>
	  </div>
	  <!-- <div class="progress-bar progress-bar-danger" style="width: 10%">
	    <span class="sr-only">10% Complete (danger)</span>
	  </div> -->
	</div>

	<span>Cosmetologie</span>
	<div class="progress">
	  <div class="progress-bar progress-bar-striped active"  role="progressbar" aria-valuenow="<?= $poucentage; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $poucentage; ?>%"><?= $poucentage; ?>%
	    <span class="sr-only">45% Complete</span>
	  </div>
	</div>
	<!-- Poucentage par sexe -->
	<div class="progress">
	  <div class="progress-bar progress-bar-success progress-bar-striped active" style="width: 35%">35% Filles
	    <span class="sr-only">35% Complete (success)</span>
	  </div>
	  <div class="progress-bar progress-bar-striped active" style="width: 25%">25% Garcon
	    <span class="sr-only">25% Complete (warning)</span>
	  </div>
	  <!-- <div class="progress-bar progress-bar-danger" style="width: 10%">
	    <span class="sr-only">10% Complete (danger)</span>
	  </div> -->
	</div>

	<span>Etc..</span>
	<div class="progress">
	  <div class="progress-bar progress-bar-striped active"  role="progressbar" aria-valuenow="<?= $poucentage; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $poucentage; ?>%"><?= $poucentage; ?>%
	    <span class="sr-only">45% Complete</span>
	  </div>
	</div>
	<!-- Poucentage par sexe -->
	<div class="progress">
	  <div class="progress-bar progress-bar-success progress-bar-striped active" style="width: 35%">35% Filles
	    <span class="sr-only">35% Complete (success)</span>
	  </div>
	  <div class="progress-bar progress-bar-striped active" style="width: 25%">25% Garcon
	    <span class="sr-only">25% Complete (warning)</span>
	  </div>
	  <!-- <div class="progress-bar progress-bar-danger" style="width: 10%">
	    <span class="sr-only">10% Complete (danger)</span>
	  </div> -->
	</div>

	<!-- <div class="progress">
	  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
	    <span class="sr-only">40% Complete (success)</span>
	  </div>
	</div> -->
	<div class="progress">
	  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
	    <span class="sr-only">20% Complete</span>
	  </div>
	</div>
	<!-- <div class="progress">
	  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
	    <span class="sr-only">60% Complete (warning)</span>
	  </div>
	</div>
	<div class="progress">
	  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
	    <span class="sr-only">80% Complete</span>
	  </div>
	</div> -->

</div>