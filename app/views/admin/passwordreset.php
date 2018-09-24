
<!-- password reset-->
<div class="container spacer">
<!--   <form class="form-signin" role="form"> -->
  <form class="form-signin" role="form" action="<?php echo base_url('user/pass_reset/').$result[0]->matricule; ?>" method="post" accept-charset="utf-8">
    <?php if (isset($_SESSION['flash'])): ?>
      <?php foreach ($_SESSION['flash'] as $type => $message):?>
         <div class="alert alert-<?= $type; ?>">
            <?= $message; ?>            
         </div>
      <?php endforeach ?>
      <?php unset($_SESSION['flash']) ?>
    <?php endif ?>
    <h2 class="form-signin-heading" style="font-size: 22px; font-family: time new roman; ">Réinitialisation du mot de passe </h2>
    <input type="hidden" name="id" class="form-control" value="<?php echo $result[0]->id_user;  ?>"  />
    <input type="password" name="mot_de_passe" class="form-control" placeholder="Mot de passe" > <br />
    <input type="password" name="mot_de_passe_c" class="form-control" placeholder="Confirmation" > <br />

    <input class="btn btn-lg btn-primary btn-block" type="submit" name="passreset" id="passreset" value="Envoyer" /> 	
  </form>
</div> <!-- /container -->

<?php // var_dump($result); ?>