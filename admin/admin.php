<!-- PAGE ADMINISTRATION PRINCIPALE -->
<?php
// Verification de l'utilisateur pour l'acces a la page
include_once '../header.php';
if (!empty($_SESSION['type']) && $_SESSION['type'] != 'admin') {
  header('Location: ../index.php');
} elseif ((!empty($_SESSION['type']) && $_SESSION['type'] == 'admin')) {

  include '../conn.php';

  // COMMANDE SQL
  $stmt = $pdo->query('SELECT idArticle, titre, theme
                       FROM Article  
                       JOIN Categorie
                       ON Categorie.idCategorie = Article.idCategorie
                       ORDER BY idArticle');
?>

  <!-- HTML -->
  <article class="admin">
    <p>ADMINISTRATION</p>
    <div class="buttonAdmin">
      <a class="nav-link" href="http://<?= $link ?>/admin/ajout.php">Ajouter un article</a>
      <a class="nav-link" href="http://<?= $link ?>/admin/listeMsg.php">Contact</a>
      <a class="nav-link" href="http://<?= $link ?>/admin/listeCom.php">Commentaires</a>
    </div>
    <!-- Tableau -->
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Titre</th>
          <th scope="col">Categorie</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <!-- Boucle remplissage tableau -->
      <?php while ($row = $stmt->fetch()) {
        $i = $row->idArticle ?>
        <tr>
          <form action="./modif.php" method="post">
            <td><?php echo $row->idArticle; ?></td>
            <td><?php echo $row->titre; ?></td>
            <td><?php echo $row->theme; ?></td>
            <input type="text" hidden name="idea" value="<?php echo $i ?>">
            <td><button type="submit" class="btn-modif" name="edit">Modifier</button>
              <button type="submit" class="btn-delete" name="delete">Supprimer</button>
            </td>

          </form>
        </tr>
      <?php } ?>
    </table>

  </article>


<?php
  include_once '../footer.php';
}
?>