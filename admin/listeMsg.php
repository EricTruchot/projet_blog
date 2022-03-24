<!-- PAGE ADMIN LISTE DES MESSAGES -->
<?php
// Verification de l'utilisateur pour l'acces a la page
include_once '../header.php';
if (!empty($_SESSION['type']) && $_SESSION['type'] != 'admin') {
  header('Location: ../index.php');
} elseif ((!empty($_SESSION['type']) && $_SESSION['type'] == 'admin')) {

  include '../conn.php';

  // COMMANDE SQL
  $stmt = $pdo->query('SELECT * FROM Contact');
?>

  <article class="admin">
    <p>Liste des messages reçus</p>
    <div class="buttonAdmin">
      <a class="nav-link" href="http://<?= $link ?>/admin/admin.php">Retour</a>
    </div>
    <table class="table table-striped table-sm">
      <thead class="thead-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Email</th>
          <th scope="col">Message</th>
        </tr>
      </thead>
      <!-- Boucle remplissage tableau -->
      <?php while ($row = $stmt->fetch()) { ?>
        <tr>
          <td><?php echo $row->idContact; ?></td>
          <td><?php echo $row->email; ?></td>
          <td><?php echo $row->message; ?></td>
        </tr>
      <?php } ?>
    </table>
  </article>
<?php
  include_once '../footer.php';
}
?>