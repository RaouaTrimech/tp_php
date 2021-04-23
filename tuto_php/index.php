<?php

session_start();

include_once 'autoload.php';
include_once 'head_fragment.html';
include_once 'ajouter.php';
include_once 'delete.php';


if(!isset($_SESSION['user']))
{
    header('Location: login.php');
}

$bdd = connexionBD::getInstance();


        /************* <td> <img width="30" src="etudiants<?php echo $ligne->image ?>"/> </td> **************/
//afficher liste etudiants
$req="select * from etudiant";
$resultat=$bdd->query($req);
$res=$resultat->fetchAll(PDO::FETCH_OBJ);



?>
    <div >
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="table table-dark table-striped">
                <thead align="center">

                <th>CIN</th>
                <th>nom</th>
                <th>prenom</th>
                <th>age</th>
                <th>section</th>
                <th>image</th>
                <th></th>
                <th></th>
                </thead>
                <?php foreach($res as $ligne){?>
                    <tr>
                        <td><?php echo $ligne->CIN ?></td>
                        <td><?php echo $ligne->nom ?></td>
                        <td><?php echo $ligne->prenom?></td>
                        <td><?php echo $ligne->age ?></td>
                        <td><?php echo $ligne->section ?></td>
                        <td> <img width="60" src="Etudiants<?php echo $ligne->image ?>"/> </td>
                        <td>
                            <a name="modifier" href="modifier.php?edit=<?= $ligne->CIN  ?>"
                               class="btn btn-info">Modifier</a>
                        </td>

                        <td>
                            <a align = "center" href="index.php?delete=<?= $ligne->CIN?>" ><img align="center" width="35ex"  src="images\dump.png"></a>
                        </td>
                    </tr>

                    <?php
                }
                ?>
                <tr>
                    <td>
                        <input type="text" class="form-control form" placeholder="CIN" id="CIN" name="CIN"  >
                    </td>
                    <td>
                        <input type="text" class="form-control form" placeholder="nom" id="nom" name="nom"  >
                    </td>
                    <td>
                        <input type="text" class="form-control form" placeholder="prenom" id="prenom" name="prenom"  >
                    </td>
                    <td>
                        <input type="text" class="form-control form" placeholder="age" id="age" name="age"  >
                    </td>
                    <td>
                        <input type="text" class="form-control form" placeholder="section" id="section" name="section"  >
                    </td>
                    <td>
                        <input type="file" class="form-control form" placeholder="image" id="image" name="image"  >
                    </td>
                    <td></td>
                    <td><button align = "center" id="add_button" name="button" type="submit"><img src="images/add-button.png" width="35ex" alt="bouton"></button></td>

                </tr>

            </table>
        </form>
    </div>
<div>
    <form action="logout.php">
        <button class="bouton btn btn-primary">Logout</button>
    </form>
</div>
                    <?php
                    if ( isset($erreur)){
                        echo $erreur;
                    }
                    ?>
                </div>
            </td>
    <div>
        <?php
        if ( isset($erreur)){
            echo '<font color="red">' . $erreur . '</font>';
        }
        else if(isset($success)){
            echo '<font color = "green">'.$success .'</font>';
        } ?>
    </div>
</body>
</html>