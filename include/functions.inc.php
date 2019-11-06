<?php
	//renvoie la date dans un format anglais
	function getEnglishDate($date){
		$membres = explode('/', $date);
		$date = $membres[2].'-'.$membres[1].'-'.$membres[0];
		return $date;
	}

	//fonction qui encrypte un mot de passe
	function getPasswordCrypt($pwd){
		$salt = "48@!alsd";
		return sha1(sha1($pwd) . $salt);
	}

	//creer un cookie Personne pour ajouter et modifier personne
	function creerPersonne($pwd_crypte){
		$tableauPersonne = array('per_nom' => $_POST['per_nom'],
		'per_prenom' => $_POST['per_prenom'],
		'per_tel' => $_POST['per_tel'],
		'per_mail' => $_POST['per_mail'],
		'per_login' => $_POST['per_login'],
		'per_pwd' => $pwd_crypte);

		$_SESSION['personne'] = serialize(new Personne(
			$tableauPersonne
		));
	}
?>
