<!-- PAGE INSCRIPTION UTILISATEUR -->
<?php
include_once 'header.php'
?>

<section class="contact">
    <form action="./inscr.php" method="POST">
        <p><a href="./connexion.php">Connexion</a> | Inscription</p>
        <label><b>Email</b></label>
        <input type="text" name="email" required>
        <label><b>Pseudo</b></label>
        <input type="text" name="pseudo" required>
        <label><b>Mot de passe</b></label>
        <input type="password" name="mdp" required>
        </textarea>
        <div class="divButton">
            <button>Inscription</button>
        </div>
    </form>
</section>

<?php
include_once 'footer.php'
?>