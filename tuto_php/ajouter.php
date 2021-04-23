<?php



include_once 'autoload.php';
$bdd = connexionBD::getInstance();

//ajouter etudiant

if(isset($_POST['button'])) {
    //securiser les variables
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $age = htmlspecialchars($_POST['age']);
    $section = htmlspecialchars($_POST['section']);
    //hacher un mdp
    //$mdp=sha1($_POST['mdp']):
    $CIN = htmlspecialchars($_POST['CIN']);
    $image = $_FILES['image']['name'];

    $upload="";
    /****************************/
    if (!empty($_POST['nom']) and !empty($_POST['prenom']) and !empty($_POST['CIN']) and !empty($_POST['age']) and !empty($_POST['section']) and !empty($_FILES['image']['name'])) {


        $reqcin = $bdd->prepare("SELECT * FROM etudiant WHERE CIN = ?");
        $reqcin->execute([$CIN]);
        $cinexist = $reqcin->rowCount();

        if($cinexist > 0)
        {
            $erreur = 'Cet étudiant est déjà inscrit!';
        }
        else if(isset($_FILES['image'])){

            $taillemax = 2097152; //2 Moctet
            $extensionsValides = array('jpg','jpeg','gif','png');
            if ($_FILES['image']['size']<=$taillemax)
            {
                $extensionUpload= strtolower(substr(strrchr($image,'.'),1));//valider extension
                if(in_array($extensionUpload,$extensionsValides)){
                    $chemin=uniqid().$image;
                    //echo $chemin;
                    //$chemin="C:\Users\raoua\OneDrive\Bureau\GL2 sem2\dev web\tp-php\exercice\tuto_php\Etudiants";
                    $resultat=move_uploaded_file($_FILES['image']['tmp_name'],$chemin);
                    if($resultat)
                    {
                        $i=$image/*.".".$extensionUpload*/;
                        $insetetud = $bdd->prepare("INSERT INTO etudiant(CIN,nom,prenom,section,age,image) VALUES (?,?,?,?,?,?)") ;
                        $insetetud->execute(array($CIN, $nom, $prenom, $section, $age, $i));
                        $success="L'étudiant a bien été ajouté!";
                    }
                    else
                    {
                        $erreur="Erreur durant l'importation de l'image!";
                    }
                }
                else{
                    $erreur='Votre image doit etre au format adequat!';
                }
            }
            else
            {
                $erreur="Votre photo de profil ne doit pas depasser 2 Moctets!";
            }
        }
    }
    else{
        $erreur = "Tous les champs doivent etre completés!";
    }
}

include_once 'head_fragment.html';



?>

