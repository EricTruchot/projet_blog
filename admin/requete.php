<!-- PAGE REQUETE DE MODIFICATIONS -->

<?php
session_start();
// Verification de l'utilisateur pour l'acces a la page
if (!empty($_SESSION['type']) && $_SESSION['type'] != 'admin') {
    header('Location: ../index.php');
} elseif ((!empty($_SESSION['type']) && $_SESSION['type'] == 'admin')) {

    include '../conn.php';

    // MODIF RECETTE
    if ($_POST['titre'] != "") {
        $idArticle = $_POST["id2"];
        $newTitre = $_POST["titre"];

        $titre2 = "UPDATE Article SET titre = '$newTitre' WHERE idArticle = $idArticle";
        $pdo->query($titre2);
    }


    if ($_POST['contenu'] != "") {
        $idArticle = $_POST["id2"];
        $newContenu = $_POST["contenu"];

        $contenu2 = "UPDATE Article SET contenu = '$newContenu' WHERE idArticle = $idArticle";
        $pdo->query($contenu2);

        header('Location: ./admin.php');
    }
    // (menu deroulant)
    if (isset($_POST['menu'])) {
        if (!empty($_POST['menu'])) {
            $idArticle = $_POST["id2"];
            $newStatut = $_POST["menu"];

            $statut2 = "UPDATE Article SET idCategorie = '$newStatut' WHERE idArticle = $idArticle";
            $pdo->query($statut2);

            header('Location: ./admin.php');
        }
    }
    // MODERATION COMMENTAIRE
    if (isset($_POST['menuMod'])) {
        if (!empty($_POST['menuMod'])) {
            $idCom = $_POST["idCom"];
            $newMod = $_POST["menuMod"];

            $mod2 = "UPDATE Commentaire SET validation = '$newMod' WHERE idCommentaire = $idCom";
            $pdo->query($mod2);

            header('Location: ./listeCom.php');
        }
    }
    // SUPPRIMER COMMENTAIRE
    if (isset($_POST["deleteCom"])) {
        $idCom = $_POST["idCom"];

        $req = "DELETE FROM Commentaire WHERE idCommentaire = $idCom";
        $pdo->query($req);

        header('Location: ./listeCom.php');
    }
}
