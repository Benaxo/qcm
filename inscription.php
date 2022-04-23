<?php 
    
    if(isset($_POST["btn"])){
        $login = $_POST["login"];
        $mdp = $_POST["mdp"];
        $id = mysqli_connect("127.0.0.1","root","","qcm");
        $req = "select * from user where login = '$login'";
        $rep = mysqli_query($id, $req);
        $verif = 0;
        if(mysqli_num_rows($rep)>0){
            echo "<h3>Cette utilisateur existe déjà...</h3>";
            $verif = 1;
        }
        if($verif==0){
            $req = "insert into user values 
                (null,'$mdp','$login',null)";
                $rep = mysqli_query($id, $req);
                echo "Inscription réussie, veuillez vous connecter...";
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
    <title>Inscription au Chat</title>
</head>
<body>
<div class="container">
        <br><h1 class="text-center text-success">Inscription :</h1><a href="login.php">Se Connecter</a><br><br>
        <div class="row d-flex justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <form action="" method="post">
                        <div class="form-group">
                            <label>Login</label>
                            <input type="text" name="login" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="mdp" class="form-control">
                        </div>
                        <div class="center d-flex justify-content-center">
                            <button type="submit" name="btn" class="btn btn-primary">S'inscrire</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</body>
</html>