
<!-- Session login -->
<div class="container spacer">
<!--   <form class="form-signin" role="form"> -->
  <form class="form-signin" role="form" action="<?php echo base_url('admin/login'); ?>" method="post" accept-charset="utf-8">
<?php if (isset($_SESSION['flash'])): ?>
  <?php foreach ($_SESSION['flash'] as $type => $message):?>
     <div class="alert alert-<?= $type; ?>">
        <?= $message; ?>            
     </div>
  <?php endforeach ?>
  <?php unset($_SESSION['flash']) ?>
<?php endif ?>
    <h2 class="form-signin-heading">Connecter vous</h2>
    <input type="text" name="nom" class="form-control" placeholder="Email" > <br />
    <input type="password" name="password" class="form-control" placeholder="Mot de passe" >
    <div class="checkbox">
      <!-- <label> -->
      	<a href="#">Mot de passe oublier</a>
<!--         <input type="checkbox" value="remember-me"> Remember me -->
      <!-- </label> -->
    </div>
    <input class="btn btn-lg btn-primary btn-block" type="submit" name="signin" id="signin" value="Connecte"r />
    <!-- <button class="btn btn-lg btn-primary btn-block" type="submit" name="signin" id="signin">Connecter</button> -->
    <!-- <?php //echo base_url('admin/updregister'); ?> -->
      	<a href="#">Creer un compte</a>
  </form>
</div> <!-- /container -->
