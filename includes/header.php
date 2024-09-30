<?php
// Supposons que vous passez le nom de la page dans une variable $File_Name
$File_Name = basename($_SERVER['PHP_SELF'], ".php");

if ($File_Name == "index") {
    $path = "./";
    $path2 = "./pages/";
} else {
    $path = "../";
    $path2 = "./";
}
?>
<header>
    <nav class="Navbar">
        <section>
            <ul>
                <li><a href="<?php echo $path; ?>index.php">Accueil</a></li>
                <li><a href="<?php echo $path2; ?>horloge.php">Horloge</a></li>
                <li><a href="<?php echo $path2; ?>chronmetre.php">Chronomètre</a></li>
                <li><a href="<?php echo $path2; ?>minuteur.php">Minuteur</a></li>
                <li><a href="<?php echo $path2; ?>reveil.php">Réveil</a></li>
            </ul>
        </section>
    </nav>
</header>