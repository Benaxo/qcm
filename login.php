<?php

session_start();

if(isset($_POST['log'])){

    $login = $_POST["login"];
    $mdp = $_POST["mdp"];
    $_SESSION['login']=$login;
    $id = mysqli_connect("127.0.0.1","root", "", "qcm");
    mysqli_query($id,"SET NAMES 'utf8'");
    $requete = "select * from user where login='$login' and mdp='$mdp'";
    $reponse = mysqli_query($id, $requete);
    $ligne = mysqli_fetch_assoc($reponse);
    if(mysqli_num_rows($reponse)>0)
    {
        $_SESSION["id_user"] = $ligne["id_user"];
        $_SESSION["login"] = $ligne["login"];
        header("location:acceuil.php");
    }else {
        echo "Connexion Impossible, login ou mot de passe incorrect....";
        header("refresh:3;url=login.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <title>Connexion-QCM</title>
</head>
<body>
    <div class="container">
        <br><h1 class="text-center text-success">Testez vos connaissances</h1><a href="inscription.php">S'inscrire</a><br><br>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <h2 class="text-center card-header"> Connexion</h2>
                    <form action="" method="post">
                        <div class="form-group">
                            <label>Login</label>
                            <input type="text" name="login" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Mot de passe</label>
                            <input type="password" name="mdp" class="form-control">
                        </div>
                        <div class="center d-flex justify-content-center">
                            <button type="submit" name="log" class="btn btn-primary">Connexion</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>