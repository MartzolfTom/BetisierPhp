<div id="menu">
	<div id="menuInt">
		<p><a href="index.php?page=0"><img class = "icone" src="image/accueil.gif"  alt="Accueil"/>Accueil</a></p>
		<p><img class = "icone" src="image/personne.png" alt="Personne"/>Personne</p>
		<ul>
			<li><a href="index.php?page=1">Lister</a></li>
			<?php if ($_SESSION['connexion']) { ?>
				<li><a href="index.php?page=2">Ajouter</a></li>
			<?php	} ?>
			<?php if ($_SESSION['estAdmin']) { ?>
				<li><a href="index.php?page=3">Modifier</a></li>
				<li><a href="index.php?page=4">Supprimer</a></li>
			<?php } ?>
		</ul>
		<p><img class="icone" src="image/citation.gif" alt="Citation"/>Citations</p>
		<ul>
			<?php if (!$_SESSION['estSalarie']) { ?>
				<li><a href="index.php?page=5">Ajouter</a></li>
			<?php } ?>
			<li><a href="index.php?page=6">Lister</a></li>
			<?php if ($_SESSION['connexion']) { ?>
				<li><a href="index.php?page=7">Rechercher</a></li>
			<?php	} ?>
			<?php if ($_SESSION['estAdmin']) { ?>
				<li><a href="index.php?page=8">Valider</a></li>
				<li><a href="index.php?page=9">Supprimer</a></li>
			<?php	} ?>
		</ul>
		<p><img class = "icone" src="image/ville.png" alt="Ville"/>Ville</p>
		<ul>
			<li><a href="index.php?page=10">Lister</a></li>
			<?php if ($_SESSION['connexion']) { ?>
				<li><a href="index.php?page=11">Ajouter</a></li>
				<li><a href="index.php?page=12">Modifier</a></li>
			<?php	} ?>
			<?php if ($_SESSION['estAdmin']) { ?>
				<li><a href="index.php?page=13">Supprimer</a></li>
			<?php	} ?>
		</ul>
	</div>
</div>
