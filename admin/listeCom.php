<!-- PAGE ADMIN LISTE DE COMMENTAIRES -->
<?php
// Verification de l'utilisateur pour l'acces a la page
include_once '../header.php';
if (!empty($_SESSION['type']) && $_SESSION['type'] != 'admin') {
  header('Location: ../index.php');
} elseif ((!empty($_SESSION['type']) && $_SESSION['type'] == 'admin')) {


  include '../conn.php';

  // COMMANDE SQL
  $stmt = $pdo->query('SELECT idCommentaire, texte, validation, titre, pseudo
                       FROM Commentaire
                       JOIN User
                       ON User.idUser = Commentaire.idUser
                       JOIN Article
                       ON Article.idArticle = Commentaire.idArticle
                       ORDER BY idCommentaire');
?>


  <article class="admin">
    <p>Moderation commentaires</p>
    <div class="buttonAdmin">
      <a class="nav-link" href="http://<?= $link ?>/admin/admin.php">Retour</a>
    </div>
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Commentaire</th>
          <th scope="col">Auteur</th>
          <th scope="col">Recette</th>
          <th scope="col">Validation</th>
          <th scope="col">Modification</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <!-- Boucle remplissage tableau -->
      <?php while ($row = $stmt->fetch()) {
        $i = $row->idCommentaire;
      ?>
        <tr>
          <td class="<?php echo $row->validation; ?>"><?php echo $row->idCommentaire; ?></td>
          <td class="<?php echo $row->validation; ?>"><?php echo $row->texte; ?></td>
          <td class="<?php echo $row->validation; ?>"><?php echo $row->pseudo; ?></td>
          <td class="<?php echo $row->validation; ?>"><?php echo $row->titre; ?></td>
          <td class="<?php echo $row->validation; ?>"><?php echo $row->validation; ?></td>

          <form action="./requete.php" method="post">
            <td class="<?php echo $row->validation; ?>"><select name="menuMod" id="menuMod">
                <option value="nonValide">Non valide</option>
                <option value="valide">Valide</option>
              </select>
            </td>
            <input type="text" hidden name="idCom" value="<?php echo $i ?>">
            <!-- BOUTON modif / delete -->
            <td class="<?php echo $row->validation; ?>"><button type="submit" class="btn-modif" name="validation">Modifier</button>
              <button type="submit" class="btn-delete" name="deleteCom">Supprimer</button>
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