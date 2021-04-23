<?php
//supprimer etudiant



include_once 'autoload.php';

$bdd = connexionBD::getInstance();

if(isset($_GET['delete']))
{
    $requete = $bdd->prepare("DELETE FROM etudiant WHERE CIN=?");
    $requete->execute(array($_GET['delete']));

}
