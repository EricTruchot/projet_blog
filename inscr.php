<!-- REQUETE D'INSCRIPTION USER -->
<?php
include './conn.php';

// Verification du contenu des POST
if (
    filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL)
    && htmlspecialchars(filter_input(INPUT_POST, "pseudo"))
    && htmlspecialchars(filter_input(INPUT_POST, "mdp"))
) {

    $userEmail = $_POST['email'];
    $userPassword = $_POST['mdp'];
    $userPseudo = $_POST['pseudo'];

    $option = ['cost' => 12,];
    $hash = password_hash($userPassword, PASSWORD_BCRYPT, $option);

    // prepare la requete (le ? sert a securié la requete avec le array() de la ligne suivante)
    $requete = $pdo->prepare("SELECT email FROM User WHERE email = ?");
    // execution de la requete  
    $requete->execute(array($userPseudo));
    /// transformer le retour en tableau 
    $reponse = $requete->fetchAll();
    // vérification du mot de passe en variable 
    $nombreUser = count($reponse);

    if ($nombreUser == 0) {
        // vérification si l'utilisateur existe
        $requeteInscription = "INSERT INTO User (idUser, userType, email, mdp, pseudo) VALUES
            (DEFAULT, DEFAULT, '$userEmail', '$hash', '$userPseudo')";
        $pdo->query($requeteInscription);
        $_SESSION['pseudo'] = $userPseudo;
        header('Location: ./index.php');
    } else {
        header('Location: ../index.php?erreur=5');
    }
} else {
    header('Location: ../index.php?erreur=3');
}
