<?php

session_start();

// supprimer les variables de session
$_SESSION = [];

// détruire la session
session_destroy();

// redirection vers la page connexion
header("Location: connexion.php");

exit();

?>