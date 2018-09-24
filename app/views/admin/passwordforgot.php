
<!-- password oublie-->
<div class="container spacer">
<!--   <form class="form-signin" role="form"> -->
  <form class="form-signin" role="form" action="<?php echo base_url('user/passforgot/'); ?>" method="post" accept-charset="utf-8">
    <?php if (isset($_SESSION['flash'])): ?>
      <?php foreach ($_SESSION['flash'] as $type => $message):?>
         <div class="alert alert-<?= $type; ?>">
            <?= $message; ?>            
         </div>
      <?php endforeach ?>
      <?php unset($_SESSION['flash']) ?>
    <?php endif ?>
    <h2 class="form-signin-heading">Saisir votre code</h2>
    <input type="text" name="code" class="form-control" placeholder="Code" > <br />

    <input class="btn btn-lg btn-primary btn-block" type="submit" name="passforgot" id="passforgot" value="Envoyer" />
    <a href="<?php echo base_url('user/login'); ?>">Connecter</a>  	
  </form>
</div> <!-- /container -->

