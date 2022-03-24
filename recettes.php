<!-- PAGE LISTE DES RECETTES -->
<?php
include_once 'header.php';
include './conn.php';

$stmt = $pdo->query('SELECT idArticle, titre, contenu, image, dateTime, theme, pseudo
                    FROM Article  
                    JOIN Categorie
                         ON Categorie.idCategorie = Article.idCategorie
                    JOIN User
                         ON User.idUser = Article.idUser');
?>
<article class="listeRecettes">

    <?php while ($row = $stmt->fetch()) {
        $i = $row->idArticle;

        $stmt3 = $pdo->query("SELECT count(idCommentaire) AS nbCom FROM Commentaire WHERE idArticle = $i AND validation = 'valide'");
        $result = $stmt3->fetch();
    ?>
        <section class="recettes">
            <div class="card">

                <div class="card-image"><img src="http://<?= $link ?>/img/<?php echo  $row->image ?>" alt="pasta" /></div>

                <div class="card-body">

                    <div class="card-post">
                        <div><i class="fa-solid fa-user"></i>Utilisateur: <?php echo $row->pseudo; ?> | Date: <?php echo $row->dateTime; ?> | Categorie: <?php echo $row->theme; ?></div>
                    </div>

                    <div class="card-title">
                        <h3><?php echo $row->titre; ?></h3>
                    </div>

                    <div class="card-text">
                        <p><?php echo $row->contenu; ?></p>
                    </div>
                    <form action="./recette.php" method="post">
                        <input type="text" hidden name="idRecettes" value="<?php echo $i ?>">
                        <a href="http://<?= $link ?>/recette.php"><button type="submit" name="btnRecettes">Voir Plus</button></a>
                        <hr>
                        <p><i class="fa-solid fa-message"></i> <?php echo $result->nbCom; ?> commentaires</p>
                    </form>
                </div>
            </div>
        </section>
    <?php } ?>
</article>
<?php
include_once 'footer.php'
?>