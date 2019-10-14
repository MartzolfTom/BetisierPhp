<?php
class ConnexionManager {

  function Login()
{
    if(empty($_POST['nom']))
    {
      /*  $this->HandleError("champs vide!");*/
        return false;
    }

    if(empty($_POST['mdp']))
    {
        return false;
    }

    $username = trim($_POST['nom']);
    $password = trim($_POST['mdp']);

  /*  if(!$this->CheckLoginInDB($username,$password))
    {
        return false;
    }*/

    $_SESSION['utilisateur'] = $username;

    return true;
}

}

?>
