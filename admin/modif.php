<!-- PAGE ADMIN MODIFICATION DE RECETTE -->
<?php
include_once '../header.php';
// Verification de l'utilisateur pour l'acces a la page
if (!empty($_SESSION['type']) && $_SESSION['type'] != 'admin') {
    header('Location: ../index.php');
} elseif ((!empty($_SESSION['type']) && $_SESSION['type'] == 'admin')) {

    include '../conn.php';
    // COMMANDE SQL
    $stmt = $pdo->query('SELECT * FROM Article');

    // Delete Recette
    if (isset($_POST["delete"])) {

        $idArticle = $_POST['idea'];

        $req = "DELETE FROM Article WHERE idArticle = $idArticle";
        $pdo->query($req);

        header('Location: ./admin.php');
    }
    // Edit Recette
    if (isset($_POST["edit"])) {
        include_once '../header.php';
?>
        <article class="contact">
            <?php
            $i = $_POST["idea"]
            ?>
            <form action="requete.php" method="post">
                <p>Modifier une recette</p>
                <div class="buttonAdmin">
                    <a class="nav-link" href="http://<?= $link ?>/admin/admin.php">Retour</a>
                </div>
                <label><b>Titre :</b></label>
                <input type="text" name="titre">

                <label><b>Contenu :</b></label>
                <textarea id="contenu" name="contenu" rows="5" cols="33" required></textarea>

                <label><b>Categorie :</b></label>
                <select name="menu" id="menu">
                    <option value="1">Plat</option>
                    <option value="2">Dessert</option>
                </select>

                <input type="text" hidden name="id2" value="<?php echo $i ?>">

                <div class="divButton">
                    <button>Modifier</button>
                </div>
            </form>
        </article>
        <?php
        include_once '../footer.php'
        ?>
<?php }
} ?>