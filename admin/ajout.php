<!-- PAGE AJOUTER UNE RECETTE -->
<?php
include_once '../header.php';
// Verification de l'utilisateur pour l'acces a la page
if (!empty($_SESSION['type']) && $_SESSION['type'] != 'admin'){
  header('Location: ../index.php');
} elseif ((!empty($_SESSION['type']) && $_SESSION['type'] == 'admin')){

    

include '../conn.php';

// Commande SQL
$categorie = $pdo->query('SELECT * FROM Categorie');
$result = $categorie->fetchAll(PDO::FETCH_ASSOC);

$auteur = $pdo->query('SELECT * FROM User');
$result2 = $auteur->fetchAll(PDO::FETCH_ASSOC);
?>



<!-- HTML -->
<section class="contact">

    <form action="./add.php" method="POST" id='formAjout'>

    <p>Ajouter une recette</p>
    <div class="buttonAdmin">
    <a class="nav-link" href="http://<?= $link ?>/admin/admin.php">Retour</a>
    </div>
        <label><b>Titre</b></label>
        <input type="text" name="titre" required>

        <label><b>Contenu</b></label>
        <textarea id="contenu" name="contenu" rows="5" cols="33" required></textarea>

        <label><b>Image</b></label>
        <input type="text" name="image" required>

        <label><b>Categorie</b></label>
        <!-- Menu deroulant selection de categorie -->
        <select name="menuCat" id="menuCat">
            <?php

           foreach ($result as $row) {
               echo '<option value=" ' . $row['idCategorie'] . ' "> ' . $row['theme'] . ' </option>';
            }
            ?>

        </select>
        <label><b>Auteur</b></label>
        <!-- Menu deroulant selection d'utilisateur -->
        <select name="menuAut" id="menuAut">
        <?php
           foreach ($result2 as $row) {
               echo '<option value=" ' . $row['idUser'] . ' "> ' . $row['pseudo'] . ' </option>';
            }
            ?>
        </select>
        <div class="divButton">
            <button>Créer</button>
        </div>

    </form>


</section>





<?php
include_once '../footer.php';
        }
?>


