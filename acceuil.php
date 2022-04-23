<?php
    session_start(); 
    if(!isset($_SESSION['login'])){
        header('location:login.php');
    }  
    $id = mysqli_connect("127.0.0.1", "root", "", "qcm");
    mysqli_query($id,"SET NAMES 'utf8'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h2 class="text-center text-succes">
            Bienvenue  <?php echo $_SESSION['login']; ?>
        </h2><br>
       <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 m-auto d-block">
            <div class="card">
                <h3 class="text-center card-header">Selectionner une réponse par questions. Bonne Chance</h3>
            </div><br>
            <form action="qcm2.php" method="post">
                <?php

                    for($i=1; $i < 11 ; $i++){

                    $req = "select * from questions
                            order by rand() 
                            limit 10";
                    $rep = mysqli_query($id, $req);
                
                    
                    while ($ligne = mysqli_fetch_array($rep)){
                        ?>

                        <div class="card">
                            <h4 class="card-header"><?php  echo $i."- ".$ligne['libelleQ']; ?></h4>
                        

                            <?php 
                                $i++;
                                $idq = $ligne["idq"];
                                $req2 = "select * from reponses
                                        where idq = $idq";
                                $rep2 = mysqli_query($id, $req2);

                                while ($ligne = mysqli_fetch_array($rep2)){
                                    ?>

                                <div class="card-body">
                                    <input type="radio" name="quest[<?php echo $ligne['idq'] ?>]" value="<?php echo $ligne['idr'] ?>">
                                    <?php  echo $ligne['libeller']; ?>
                                </div>
                
                <?php
                
                    }
                }
                }
                ?>

                <input type="submit" name="envoyer" value="Envoyer" class="btn btn-success m-auto d-block">
            </form>
        </div> 
        </div><br><br>

         
    </div>
    
</body>
</html> 