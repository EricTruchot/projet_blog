<!-- PAGE D'ACCEUIL -->
<?php
include_once 'header.php';
include './conn.php';
?>

<article class="acceuil">
    <div class="topAcceuil">
        <p class="titre">Bienvenue sur Aventures Gustatives !</p>
        <p class="sousTitre">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Porro recusandae eos quam esse sint exercitationem facilis maxime tenetur, dolores amet iusto saepe expedita placeat tempora aut dicta velit, architecto non.
            Cumque blanditiis assumenda quidem fugiat nesciunt explicabo commodi? Maiores voluptatibus tempore odit magnam asperiores quia voluptatum quibusdam? Ullam aut, quis dolor minus reiciendis non quos saepe nam. Eum, dolor dolorem!</p>
    </div>
    <div class="bloqueAcceuil">
        <!-- Colonne gauche -->
        <aside class="left">
            <div>
                <p class="bonjour">Bonjour</p>
                <p class="text">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem, minima ratione? Iste at, facilis dolorum sunt repellendus ipsa explicabo.
                </p>
                <hr>
                <ul class="footer">
                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-pinterest"></i></a></li>
                    <li><a href="#"><i class="fa-brands fa-youtube"></i></a></li>
                </ul>
                <p class="elu">Elu meilleur blog culinaire</p>
                <hr>
                <p class="bonjour">Ma dernière recette</p>
                <div>
                    <div class="recetteSmall">
                        <div class="card">
                            <div class="card-image"><img src="./img/pasta.jpg" alt="pasta" /></div>
                            <div class="card-body">
                                <div class="card-text">
                                    <p> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam voluptatibus autem consectetur.</p>
                                </div>
                                <button>Voir Plus</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>
        <!-- Partie droite -->
        <section class="right">
            <?php

            $stmt = $pdo->query('SELECT idArticle, titre, contenu, image, dateTime, theme, pseudo
                    FROM Article  
                    JOIN Categorie
                         ON Categorie.idCategorie = Article.idCategorie
                    JOIN User
                         ON User.idUser = Article.idUser');
            ?>

            <article class="listeRecettes">
                <!-- Boucle remplissage liste recettes -->
                <?php while ($row = $stmt->fetch()) {
                    $i = $row->idArticle;

                    $stmt3 = $pdo->query("SELECT count(idCommentaire) AS nbCom FROM Commentaire WHERE idArticle = $i AND validation = 'valide'");
                    $result = $stmt3->fetch(); // nombre de commentaire
                ?>
                    <section class="recettes">
                        <div class="card">
                            <!-- Image à la une -->
                            <div class="card-image"><img src="http://<?= $link ?>/img/<?php echo  $row->image ?>" alt="pasta" /></div>

                            <!-- Corp de notre carte -->
                            <div class="card-body">

                                <!-- info publication -->
                                <div class="card-post">
                                    <div><i class="fa-solid fa-user"></i>Utilisateur: <?php echo $row->pseudo; ?> Date: <?php echo $row->dateTime; ?> Categorie: <?php echo $row->theme; ?></div>
                                </div>

                                <!-- Titre de l'article -->
                                <div class="card-title">
                                    <h3><?php echo $row->titre; ?></h3>
                                </div>
                                <!-- Extrait de l'article -->
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
        </section>
    </div>
</article>
<?php
include_once 'footer.php'
?>