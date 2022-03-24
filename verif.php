<?php
include './conn.php';

if (isset($_POST['email']) && isset($_POST['mdp'])) {

   $userEmail = $_POST['email'];
   $password = $_POST['mdp'];

   if (isset($userEmail) && isset($password)) {

      $sql = $pdo->prepare("SELECT * FROM User where email = :email ");

      $sql->execute(["email" => $userEmail]);

      $reponse = $sql->fetchAll();

      $verifPwd = password_verify($password, $reponse[0]->mdp);

      if ($verifPwd == true && ($userEmail == $reponse[0]->email))
      {
         session_start();
         $_SESSION['email'] = $userEmail;
         $_SESSION['id'] = $reponse[0]->idUser;
         $_SESSION['type'] = $reponse[0]->userType;
         if ($reponse[0]->userType == 'admin') {
            header('Location: ./admin/admin.php');
         } elseif ($reponse[0]->userType == 'user') {
            header('Location: ./index.php');
         }
      } else {
         header('Location: ./index.php?erreur=1'); // utilisateur ou mot de passe incorrect
      }
   } else {
      header('Location: ../index.php?erreur=2'); // utilisateur ou mot de passe vide
   }
}
