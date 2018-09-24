<div class="container">
	<h2>F&eacutelicitation</h2>
	<?php foreach ($etu as $key) :?>
		<span><?php echo $key->nom;  ?></span>
		<span><?php echo $key->prenom;  ?></span> <br />
		<span> <u>Matricule</u> : <strong> <?php echo $key->matricule; ?> !</strong></span> <br />
	<?php endforeach ?>
	<strong>Important!</strong><br />
	<p><i><strong> Apportez votre matricule au secr&eacutetariat afin de valider votre inscription. <strong></i></p>
</div>
