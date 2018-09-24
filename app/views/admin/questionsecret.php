


<!-- password oublie question secret pour reinitialise le mot de passe -->
<div class="container spacer">
<!--   <form class="form-signin" role="form"> -->
  	<div class="row">
			<!-- left column -->
		<form class="form-horizontal" action="<?php echo base_url('user/is_reponse/').$result1[0]->matricule;?>" method="post" accept-charset="utf-8" enctype="multipart/form-data">
	   	<div style="width: 640px; position: relative; float: center; margin: auto; ">
		    <?php if (isset($_SESSION['flash'])): ?>
		      <?php foreach ($_SESSION['flash'] as $type => $message):?>
		         <div class="alert alert-<?= $type; ?>">
		            <?= $message; ?>            
		         </div>
		      <?php endforeach ?>
		      <?php unset($_SESSION['flash']) ?>
		    <?php endif ?>
		</div>			

	    <div class="form-group row">
		    <label for="inputQuestion" class="col-sm-2 col-form-label"> </label>
			<div class="col-sm-8">			   
				<h2 class="form-signin-heading"></h2>
			</div>			
		</div>

		<div class="form-group row">
		    <label for="inputQuestion" class="col-sm-2 col-form-label"> </label>
			<div class="col-sm-8">					   
			    <select class="form-control" id="inputQuestion" name="inputQuestion" required >
			      	<option value="<?php echo $result1[0]->question ?>" ><?php echo $result1[0]->question; ?></option>
					<span class="text-danger"><?php echo form_error('inputQuestion'); ?></span>
					<span class="text-danger" id="missInputQuestion"></span> 
			    </select>
			</div>			
		</div>
		<div class="form-group row">
			<label for="inputRepons" class="col-sm-2 col-form-label"></label>
			<div class="col-sm-8">
				<input type="hidden" class="form-control" name="id" id="id" value="<?php echo $result1[0]->id_question; ?>" required /> 
				<input type="text" class="form-control" name="inputRepons" id="inputRepons" placeholder="Votre reponse" required /> 
				<span class="text-danger" id="missInputRepons"></span> 
			</div>
		</div>

	    <div class="form-group">
			<label class="col-md-3 control-label"></label>
			<div class="col-md-8">
				<input type="submit" class="btn btn-primary" id="valide" name="valide" value="Valide">
				<span></span> <input type="reset" class="btn btn-default" value="Cancel" />
			</div>
		</div>
	  </form>
	</div> <!-- /container -->
</div>