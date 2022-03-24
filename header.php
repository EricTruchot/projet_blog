<!-- HEADER -->
<?php
$link = $_SERVER['HTTP_HOST'];

session_start(); // Debut session utilisateur

$title = basename($_SERVER['PHP_SELF']); // Recuperation du nom du fichier pour le metre dans le title
$title = rtrim($title, ".php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="http://<?= $link ?>/style/normalize.css">
    <link rel="stylesheet" href="http://<?= $link ?>/style/style.css">
    <script src="https://kit.fontawesome.com/f00c55aea5.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="http://<?= $link ?>/fonts/Metropolis.otf">
    <link rel="stylesheet" href="http://<?= $link ?>/fonts/Futura-Light.otf">
    <link rel="stylesheet" href="http://<?= $link ?>/fonts/Didot-Light-ital.ttf">
    <link rel="stylesheet" href="http://<?= $link ?>/fonts/roboto-light.ttf">

</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a class="nav-link" href="http://<?= $link ?>/index.php">ACCEUIL</a></li>
                <li><a class="nav-link" href="http://<?= $link ?>/recettes.php">RECETTES</a></li>
                <li><a class="nav-link" href="http://<?= $link ?>/aPropos.php">A PROPOS</a></li>
                <li><a class="nav-link" href="http://<?= $link ?>/contact.php">CONTACT</a></li>
                <?php
                // Modification de la navbar en fonction de l'utilisateur
                if (!empty($_SESSION['type']) && $_SESSION['type'] == 'admin') {
                    echo "<li><a class='nav-link' href='http://" . $link . "/admin/admin.php'>ADMINISTRATION</a></li>
                <li><a class='nav-link' href='http://" . $link . "/logout.php'>DECONNEXION</a></li>";
                } elseif (!empty($_SESSION['type']) && $_SESSION['type'] == 'user') {
                    echo "<li><a class='nav-link' href='http://" . $link . "/logout.php'>DECONNEXION</a></li>";
                } elseif (!isset($_SESSION['type'])) {
                    echo "<li><a class='nav-link' href='http://" . $link . "/connexion.php'>CONNEXION</a></li>";
                }
                ?>
            </ul>
        </nav>
        <div>
            <img src="http://<?= $link ?>/img/logo.png" alt="logo">
            <p>AVENTURES GUSTATIVES</p>
        </div>
        </nav>
        <hr>
    </header>
    <main>