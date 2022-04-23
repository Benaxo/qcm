<?php
session_start();
if(!isset($_SESSION["login"])){
    header("location:onePage.php");
}

if($_SESSION["niveau"] != 2){
    header("location:onePage.php");
}
if(isset($_POST["bout"])){
    extract($_POST);
    $id = mysqli_connect("127.0.0.1","root", "", "qcm");
    $requete = "insert into questions values (null, '$question', 1)";    
    $reponse = mysqli_query($id, $requete);
    $requete = "select max(idq) as maxi from questions";
    $reponse = mysqli_query($id, $requete);
    $ligne = mysqli_fetch_assoc($reponse);
    $idq = $ligne["maxi"];
    $requete = "insert into reponses (idq, libeller, verite) 
                                    values ($idq, '$r1', 1),
                                            ($idq, '$r2', 0),
                                            ($idq, '$r3', 0),
                                            ($idq, '$r4', 0)";
    $reponse = mysqli_query($id, $requete);
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
    <h1>Ajouter une question au QCM</h1><hr>
    <form action="" method="post">
        Entrez la question : <br>
        <input type="text" name="question" required><br><hr>
        Entrez la bonne réponse : <br>
        <input type="text" name="r1" required><br><br><br>
        Entrez les 3 mauvaises réponses : <br>
        <input type="text" name="r2" required><br>
        <input type="text" name="r3" required><br>
        <input type="text" name="r4" required><br><br><br>
        <input type="submit" value="Enregistrer" name="bout">
    </form>
</body>
</html>