
<div class="container" >
    </br>
    <div>
        <h1 align ="center" >Ajout</h1>
    </div>
    </br>
    <table align="center">
        <td ><div >
                <form method="post" action="" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label"> NOM* </label>
                        <input type="text" class="form-control" placeholder="nom" id="nom" name="nom"  >
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label"> PRENOM* </label>
                        <input type="text" class="form-control" placeholder="prenom" id="prenom" name="prenom" >
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label"> CIN* </label>
                        <input type="number" class="form-control" placeholder="CIN" id="CIN" name="CIN" >
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label"> AGE* </label>
                        <input type="number" class="form-control" placeholder="age" id="age" name="age" >
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label"> SECTION* </label>
                        <input type="text" class="form-control" placeholder="section" id="section" name="section"  >
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label"> PHOTO*  </label>
                        <input type="file" class="form-control"placeholder="image" id="image" name="image"  >
                    </div>
                    <br>
                    <button type="submit" name="ajouter_etudiant" class="btn btn-primary bouton">Submit</button>


                    <button  align="center" type="submit" name="liste" class="btn btn-primary bouton"><a class="lien" href="index.php"  >ListeEtudiants</a></button>


                </form>
                <br>
            </div>
        </td><!--ajouterEtudiant-->
    </table>
</div>

<br>
