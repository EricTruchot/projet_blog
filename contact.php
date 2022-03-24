<!-- PAGE CONTACT -->
<?php
include_once 'header.php'
?>

<section class="contact">
    <!-- form a check -->
    <form action="./sendMsg.php" method="POST">
        <p>Contact</p>
        <?php
        if (!empty($_SESSION['erreur'])) { ?>
            <p class="erreur"><?php echo $_SESSION['erreur']; ?></p>
        <?php
            unset($_SESSION['erreur']);
        }
        ?>
        <label><b>Email</b></label>
        <input type="email" name="email" required>
        <label><b>Message</b></label>
        <textarea id="message" name="message" rows="5" cols="33" required>
 </textarea>
        <div class="divButton">
            <button>Envoyer</button>
        </div>
    </form>
</section>
<?php
include_once 'footer.php'
?>