<?php
session_start();

include_once 'autoload.php';
include_once 'ajouter.php';

if(!isset($_SESSION['user']) or !isset($_GET['edit']))
{
    header('Location: index.php');
}


$bdd = connexionBD::getInstance();


if(isset($_GET['edit']))
{   $req = $bdd->prepare("SELECT * FROM etudiant WHERE CIN = {$_GET['edit']}");
    $req -> execute([]);
    $info = $req ->fetch(PDO::FETCH_OBJ);

}
if(isset($_POST["ajouter_etudiant"])) {
    if (!empty($_POST['nom']) and !empty($_POST['prenom']) and !empty($_POST['age']) and !empty($_POST['section'])) {
        if (isset($_FILES['image']) && !empty($_FILES['image']['name'])) {
            $image = $_FILES['image']['name'];
            $taillemax = 2097152; //2 Moctet
            $extensionsValides = array('jpg', 'jpeg', 'gif', 'png');
            if ($_FILES['image']['size'] <= $taillemax) {
                $extensionUpload = strtolower(substr(strrchr($image, '.'), 1));//valider extension
                if (in_array($extensionUpload, $extensionsValides)) {
                    $chemin = "Etudiants" . $image;
                    //echo $chemin;
                    //$chemin="C:\Users\raoua\OneDrive\Bureau\GL2 sem2\dev web\tp-php\exercice\tuto_php\etudiant";
                    $resultat = move_uploaded_file($_FILES['image']['tmp_name'], $chemin);
                    if ($resultat) {
                        $i = $image;
                        $insetetud = $bdd->prepare("UPDATE etudiant SET nom=?,prenom=?,section=?,age=?,image=?WHERE CIN=?");
                        $insetetud->execute(array($_POST['nom'], $_POST['prenom'], $_POST['section'], $_POST['age'], $_FILES['image']['name'], $_GET['edit']));
                        $success = "L'etudiant a bien été modifié!";
                    } else {
                        $erreur = "Erreur durant l'importation de l'image!";
                    }
                } else {
                    $erreur = 'Votre image doit etre au format adequat!';
                }
            } else {
                $erreur = "Votre photo de profil ne doit pas depasser 2 Moctets!";
            }
        }
    } else {
        $erreur = "Tous les champs doivent etre complétés!";

    }
}

include_once 'head_fragment.html';
?>



<div class="container" align="center">

        <form method="post" action="" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">CIN : </label>
                <input type="number"  class="form-control" placeholder="CIN" disabled="disabled"  name="CIN" value="<?=$info->CIN?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">NOM : </label>
                <input type="text" class="form-control" placeholder="nom"  name="nom" value="<?=$info->nom?>" >
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">PRENOM : </label>
                <input type="text" class="form-control" placeholder="prenom"  name="prenom" value="<?=$info->prenom?>" >
            </div>

            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">AGE : </label>
                <input type="number" class="form-control" placeholder="age"  name="age" value="<?=$info->age?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">SECTION : </label>
                <input type="text" class="form-control" placeholder="section"  name="section" value="<?=$info->section?>" >
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">IMAGE : </label>
                <input type="file" class="form-control" value=""  name="image"  >
            </div>
            <br>

            <button type="submit" name="ajouter_etudiant" class="btn btn-primary bouton">Finaliser Modification</button>
            <button  align="center" type="submit" name="liste" class="btn btn-primary bouton"><a href="index.php" style="color: azure">Liste étudiants </a></button>

        </form>
    <br>
    <?php

    if ( isset($erreur)){
        echo '<font color="red">' . $erreur . '</font>';
    }
    else if(isset($success)){
        echo '<font color = "green">'.$success .'</font>';
    }
    ?>
</div><!--ModifierEtudiant-->

</body>
</html>