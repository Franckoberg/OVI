
<div class="container spacer" >
  <div class="container" >
    <div class="row">
      <!--  class="col-lg-4 col-xs-12 col-sm-6 col-md-8" -->
      <!-- Session login -->
      <div class="col-md-4" style="border: solid white 6px; ">
      <!--   <form class="form-signin" role="form"> -->
        <!-- <form class="form-signin" role="form" action="<?php //echo base_url('user/login'); ?>" method="post" accept-charset="utf-8"> -->
          <?php echo form_open('user/login','class="form-signin"'); ?>
          <?php if (isset($_SESSION['flash'])): ?>
            <?php foreach ($_SESSION['flash'] as $type => $message):?>
               <div class="alert alert-<?= $type; ?>">
                  <?= $message; ?>            
               </div>
            <?php endforeach ?>
            <?php unset($_SESSION['flash']) ?>
          <?php endif ?>
          <h2 class="form-signin-heading">Connectez-vous</h2>
          <input type="text" name="email" class="form-control" placeholder="Nom ou Email" > <br />
          <input type="password" name="password" class="form-control" placeholder="Mot de passe" >
          <div class="checkbox">
            <!-- <label> -->
              <a href="<?php echo base_url('user/passforgot'); ?>">Mot de passe oubli&eacuter</a>
      <!--         <input type="checkbox" value="remember-me"> Remember me -->
            <!-- </label> -->
          </div>
          <input class="btn btn-lg btn-primary btn-block" type="submit" name="signin" id="signin" value="Connecter" />
          <!-- <button class="btn btn-lg btn-primary btn-block" type="submit" name="signin" id="signin">Connecter</button> -->
          <!-- <?php //echo base_url('admin/updregister'); ?> -->
          <!-- <a href="<?php //echo base_url('user/inscrir'); ?>">Creer un compte</a>     -->
        </form>
      </div> <!-- /container -->
    
      <!-- <form> --> <!--  class="col-lg-4 col-xs-12 col-sm-6 col-md-8 -->
        <div class="form-signin col-md-4 col-md-offset-4" style="border: solid white 6px; /*margin : 80px 2px 2px 0px*/  ">
          <a href="<?php echo base_url('user/inscrir'); ?>"> 
            <input class="btn btn-lg btn-primary btn-block" type="submit" name="user/inscrir" id="signin" value="Inscrire" />
          </a>
        </div>
      <!-- </form> -->
    </div>

  </div>
</div>



<!-- col-lg-4 col-xs-12 col-sm-6 col-md-12 -->