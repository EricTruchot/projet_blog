<!-- PAGE DETAIL RECETTE -->
<?php
include_once 'header.php';
include_once 'conn.php';

if (isset($_POST["btnRecettes"])) {

    $idRecette = $_POST['idRecettes'];

    $stmt = $pdo->query("SELECT idArticle, titre, contenu, image, dateTime, theme, pseudo
                    FROM Article  
                    JOIN Categorie
                         ON Categorie.idCategorie = Article.idCategorie
                    JOIN User
                         ON User.idUser = Article.idUser
                    WHERE idArticle = $idRecette");

    $row = $stmt->fetch();
?>

    <article class="detailRecette">
        <section class="recettes">
            <div class="card">

                <div class="card-body">

                    <div class="card-post">
                        <div><i class="fa-solid fa-user"></i>Utilisateur: <?php echo $row->pseudo; ?> Date: <?php echo $row->dateTime; ?> Categorie: <?php echo $row->theme; ?></div>
                    </div>

                    <div class="card-title">
                        <h3><?php echo $row->titre; ?></h3>
                    </div>

                    <div class="card-image"><img src="http://<?= $link ?>/img/<?php echo  $row->image ?>" alt="pasta" /></div>

                    <div class="card-text">
                        <p><?php echo $row->contenu; ?></p>
                    </div>

                    <hr>
                    <!-- =================================== Commentaire ================================================== -->
                    <?php
                    $stmt3 = $pdo->query("SELECT count(idCommentaire) AS nbCom FROM Commentaire WHERE idArticle = $idRecette  AND validation = 'valide'");
                    $result = $stmt3->fetch();

                    ?>
                    <!-- NB COMMENTAIRE -->
                    <p><i class="fa-solid fa-message"></i> <?php echo $result->nbCom; ?> commentaires</p>
                    <?php

                    $stmt2 = $pdo->query("SELECT texte, idArticle, dateTime, pseudo
                      FROM Commentaire 
                      JOIN User
                      ON Commentaire.idUser = User.idUser WHERE idArticle = $idRecette AND Commentaire.validation = 'valide'");
                    ?>
                    <?php
                    while ($row2 = $stmt2->fetch()) { ?>
                        <div class="listCom">
                            <div class="card-post">
                                <div><i class="fa-solid fa-user"> </i>Rédigé par <?php echo $row2->pseudo; ?> le <?php echo $row2->dateTime; ?></div>
                            </div>
                            <div class="card-text">
                                <p><?php echo $row2->texte; ?></p>
                            </div>
                        </div>

                    <?php } ?>
                </div>
            </div>
        <?php     } ?>
        </section>

        <!-- ================================ Laisser un commentaire ===================================================== -->
        <?php
        if (empty($_SESSION['type'])) { ?>
            <a class="nav-link" href="http://<?= $link ?>/inscription.php">Inscrivez vous pour ecrire un commentaire !</a>
        <?php
        } elseif ((!empty($_SESSION['type']) && ($_SESSION['type'] == 'admin' || $_SESSION['type'] == 'user'))) {
        ?>

            <section class="commentaire">
                <p class="titre2">Laisser un commentaire</p>
                <form action="./addCom.php" method="POST">
                    <textarea id="commentaire" name="commentaire" rows="5" cols="33" placeholder="Commentaire"></textarea>
                    <input type="text" hidden name="idRecette" value="<?php echo $idRecette ?>">
            </section>
            <div class="submit">
                <button>Envoyer</button>
            </div>
            </form>

        <?php } ?>

        <!-- ========================= RECETTES RECENTES ============================================================ -->

        <p class="titre2">Recettes Recentes</p>
        <section class="recettesRecentes">

            <?php
            $stmt = $pdo->query('SELECT idArticle, titre, contenu, image
                    FROM Article LIMIT 3');

            while ($row = $stmt->fetch()) {
                $i = $row->idArticle;

                $stmt3 = $pdo->query("SELECT count(idCommentaire) AS nbCom FROM Commentaire WHERE idArticle = $i");
                $result = $stmt3->fetch();
            ?>
                <section class="recettes">
                    <div class="card">

                        <div class="card-image"><img src="http://<?= $link ?>/img/<?php echo  $row->image ?>" alt="pasta" /></div>


                        <div class="card-body">

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
        </section>
    </article>
    <?php
    include_once 'footer.php'
    ?>