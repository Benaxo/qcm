<?php
session_start();
if(isset($_POST["bout"]))
{
    $id = mysqli_connect("127.0.0.1","root","", "qcm");
    $login = mysqli_real_escape_string($id,$_POST["login"]);
    $mdp = mysqli_real_escape_string($id,$_POST["mdp"]);
    mysqli_query($id,"SET NAMES 'utf8'");
    $requete = "select * from user 
                where login='$login' 
                and mdp='$mdp'";  
    echo $requete;   
    $reponse = mysqli_query($id, $requete);
    $ligne = mysqli_fetch_assoc($reponse);
    if(mysqli_num_rows($reponse)>0)
    {
        $_SESSION["id_user"] = $ligne["id_user"];
        $_SESSION["login"] = $ligne["login"];
        header("location:aideQcm.php");
    }else {
        $erreur = "Erreur de login ou mot de passe!!!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Formulaire de connexion</h1><hr>
    <form action="" method="post">
        <?php if(isset($erreur)) echo "<h3>$erreur</h3>";?>
        <input type="text" name="login" placeholder="Entrez votre login :"><br><br>
        <input type="password" name="mdp" placeholder="Entrez votre mot de passe :"><br><br>
        <input type="submit" value="Connexion" name="bout"><br><hr>
    </form>
</body>
</html>