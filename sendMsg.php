<!-- REQUETE ENVOIE DE MESSAGE CONTACT -->
<?php
include './conn.php';
session_start();

if (
    filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL)
    && htmlspecialchars(filter_input(INPUT_POST, "message"))
) {

    $userEmail = $_POST['email'];
    $userMessage = $_POST['message'];

    $requeteMessage = "INSERT INTO Contact (idContact, email, message, dateTime) VALUES
            (DEFAULT, '$userEmail', '$userMessage', DEFAULT)";
    $pdo->query($requeteMessage);
    header('Location: ./index.php');
} else {
    $_SESSION['erreur'] = 'Erreur de saisie';
    header('Location: ./contact.php');
}
