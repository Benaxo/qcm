<?php
    session_start(); 
    if(!isset($_SESSION['login'])){
        header('location:login.php');
    }  
    $id = mysqli_connect("127.0.0.1", "root", "", "qcm");
    mysqli_query($id,"SET NAMES 'utf8'");

    if(isset($_POST['envoyer'])){

        if(!empty($_POST['quest'])){

            $count = count($_POST['quest']);

            echo "<br><p class='fw-bold text-center'>Vous avez répondu  à "."<span class='text-danger'>".$count."</span>"." questions sur "."<span class='text-danger'>"."10"."</span>";

            $resultat = 0;
            $i = 1;

            $selected = $_POST['quest'];

            

            $req = "select * from reponses
                    where verite = 1
                    limit 10";
            $rep = mysqli_query($id,$req);

            while($ligne = mysqli_fetch_array($rep)){
                $cocher = $ligne['idr'] == $selected[$i];

                if($cocher){
                    $resultat++;
                }
                $i++;
            }
            $resultat = $resultat *2; //convertion de note sur 10 à note sur 20
            echo "<br>"."<p class='fw-bold text-center'>Votre score total est de "."<span class='text-danger'>".$resultat."/20"."</span>";
        }
    }

    
        $login = $_SESSION['login'];
        $req2 = "insert into notes values (null,'$resultat','$login')"; 
        $rep2 = mysqli_query($id,$req2);

        //Moyenne
        $req3 = "select * from notes 
                where login_u = '$login'";
        $rep3 = mysqli_query($id,$req3);
        $num = mysqli_num_rows($rep3);
        $total= 0 ;
        while($note = mysqli_fetch_assoc($rep3))
        {
            $total += $note['note'];
        }

        if($num != 0) 
        {
            $moy = round($total / $num, 2);
            echo "<br><br>"."Vous avez une moyenne de "."<span class='text-danger'>".$moy."/20"."</span>";
        }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <title>Notes</title>
</head>
<body>
<div class="m-auto d-block">    
            <a href="deco.php" class="btn btn-primary"> Déconnexion </a>
        </div><br><br> 
</body>
</html>
