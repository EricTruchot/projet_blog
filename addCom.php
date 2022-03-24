<!-- REQUETE AJOUT DE COMMENTAIRE -->
<?php
session_start();

include "./conn.php";

if (htmlspecialchars(filter_input(INPUT_POST, "commentaire"))) {
    $addCom = $_POST['commentaire'];
    $idRecette = $_POST['idRecette'];
    $idUser = $_SESSION['id'];

    $requeteAjout = "INSERT INTO Commentaire (texte, dateTime, updateDate, idUser, idArticle, validation) VALUES
        ('$addCom', DEFAULT, DEFAULT,'$idUser','$idRecette', DEFAULT)";
    $pdo->query($requeteAjout);

    header('Location: ./recettes.php');
} else {
    header('Location: ./aPropos.php');
}
