<?php

session_start();
include_once 'autoload.php';
include_once 'head_fragment.html';
$bdd = connexionBD::getInstance();

if(isset($_SESSION['user']))
{
    header('Location: index.php');
}

if(isset($_POST['form_inscription']))
{
    if(!empty($_POST['password'])AND !empty($_POST['email']))
    {
        $email = htmlspecialchars($_POST['email']);
        $password = $_POST['password'];
        $reqmail = $bdd->prepare("SELECT * FROM user WHERE email = ?");
        $reqmail->execute([$email]);
        $mailexist = $reqmail->rowCount();

        if($mailexist == 0)
        {
            $error = 'Email non valide !' ;
        }
        else
        {

            $reqpass = $bdd ->prepare ("SELECT * FROM user WHERE Email = ? AND Password = ?");
            $reqpass->execute([$email,$password]);
            $passexist = $reqpass->rowCount();

            if($passexist ==0)
            {
                $error ='Mot de passe incorrect !';
            }
            else{
                $_SESSION['user']=$email ;
                header('location:index.php');
            }

        }
    }
    else
    { $error = "Champs non complétés !";

    }



    if(isset($error))
    {
        echo '<font color="red">' . $error . '</font>';
        unset($error);
    }


}


?>

<br/>
<div class="container" >
    <form method ="POST" action="">
        <fieldset>
            <br>
            <legend  align="center"><h2>Login</h2></legend>
            <div class="form-group"  >
                <label  for="Email">Email address</label>
                <input  type="email" class="form-control" id="Email" name="email" placeholder="Email">
            </div>


            <div class="form-group">
                <label for="exampleInputPassword1">Mot de passe</label>
                <input  type="password" class="form-control" name ="password" id="exampleInputPassword1" placeholder="Mot de passe">
            </div>

            <br>

            <button type="submit" name="form_inscription"class="btn bouton">Login</button>
            <br>
            <br>

        </fieldset>
    </form>
</div>
</body>
</html>
