<!-- PAGE REQUETE AJOUT DE RECETTE -->
<?php

session_start();
// Verification de l'utilisateur pour l'acces a la page
if (!empty($_SESSION['type']) && $_SESSION['type'] != 'admin') {
  header('Location: ../index.php');
} elseif ((!empty($_SESSION['type']) && $_SESSION['type'] == 'admin')) {

  include "../conn.php";

  // Verification du contenu des POST
  if (
    htmlspecialchars(filter_input(INPUT_POST, "titre"))
    && htmlspecialchars(filter_input(INPUT_POST, "contenu"))
    && htmlspecialchars(filter_input(INPUT_POST, "image"))
  ) {


    $addTitre = $_POST['titre'];
    $addContenu = $_POST['contenu'];
    $addImage = $_POST['image'];
    $addCategorie = $_POST['menuCat'];
    $addAuteur = $_POST['menuAut'];

    // Commande SQL

    $requeteAjout = "INSERT INTO Article (idArticle,titre,contenu,image,dateTime,updateDate, idCategorie,idUser) VALUES
        (DEFAULT, '$addTitre', '$addContenu', '$addImage',DEFAULT,DEFAULT,'$addCategorie','$addAuteur' )";
    $pdo->query($requeteAjout);

    // ---------------------------------------
    // tableau variable pour requette sql
    // ---------------------------------------

    header('Location: ./ajout.php');
  } else {
    header('Location: ./ajout.php');
  }
}
