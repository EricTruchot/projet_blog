<!-- PAGE CONNEXION UTILISATEUR -->
<?php
include_once 'header.php';
?>

<section class="contact">
    <form action="./verif.php" method="POST">
        <p>Connexion | <a href="./inscription.php">Inscription</a></p>
        <label><b>Email</b></label>
        <input type="text" name="email" required>
        <label><b>Mot de passe</b></label>
        <input type="password" name="mdp" required>
        <div class="divButton">
            <button type="submit" id='submit' value='login'>Connexion</button>
        </div>
    </form>
</section>

<?php
include_once 'footer.php'
?>