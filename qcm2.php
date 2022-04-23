<?php
session_start();
if(!isset($_SESSION["login"])){
    header("location:onePage.php");
}
$pseudo = $_SESSION["login"];
$idu = $_SESSION["id_user"];
echo "Bonjour $pseudo, <br>Affichage des résultats!!!<br><br>";

$id = mysqli_connect("127.0.0.1","root", "", "qcm");
   // print_r($_POST);
    echo "<hr>";
    $note = 0;
    $i =1;
    foreach($_POST as $question=>$reponse)
    {
        if($question!="bout"){
            //echo "Pour la question $question tu as repondu $reponse<br>";
            $req = "select * from reponses where idr = $reponse and verite=1";
            $res = mysqli_query($id, $req);
            $req2 = "select * from questions where idq = $question";
            $res2 = mysqli_query($id,$req2);
            $ligne2 = mysqli_fetch_assoc($res2);
            if(mysqli_num_rows($res)>0)
            {
                $note += 2;  //$note = $note + 2;
            }else{
                echo "<br>Vous vous êtes trompé sur la question $i : ".$ligne2["libelleQ"]."<br>";
                $req3 = "select * from reponses where idq=$question and verite=1";
                $res3 = mysqli_query($id,$req3);
                $ligne3 = mysqli_fetch_assoc($res3);
                echo "Il fallait répondre : ".$ligne3["libeller"]."<br><br>";
            }
        }
        $i++;

     }

     echo "<br>Vous avez eu $note / 20 à ce test....";
     $req = "insert into resultats values (null,'$idu','$note',now())";
     mysqli_query($id,$req);


?>