<?php
$title = "Horloge";
?>
<!DOCTYPE html>
<html lang="en">
<?php include '../includes/head.php' ?>
<head>
    <link rel="stylesheet" href="../assets/css/horloge.css">
</head>
<body>
    <?php include '../includes/header.php' ?>
    <main>
        <h1>Horloge</h1>
        <div class="container">
        <div id="clockDisplay"></div>
    </div>
    </main>
    <script>
        function updateClock() {
    const now = new Date();

    // Calcul de l'heure française (UTC +1)
    const utcOffset = 1; // Heure standard de Paris (sans tenir compte de l'heure d'été)
    const localTime = new Date(now.getTime() + (utcOffset * 60 * 60 * 1000));

    // Récupération de l'heure, des minutes, et des secondes
    const hours = localTime.getUTCHours();
    const minutes = localTime.getUTCMinutes();
    const seconds = localTime.getUTCSeconds();

    // Formatage pour que l'affichage soit toujours sur 2 chiffres
    const formattedTime = `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;

    // Affichage de l'heure dans l'élément avec l'ID 'clockDisplay'
    document.getElementById('clockDisplay').textContent = formattedTime;
}

// Mise à jour de l'horloge toutes les secondes
setInterval(updateClock, 1000);

// Appel immédiat pour éviter le délai d'une seconde au premier affichage
updateClock();

    </script>
</body>
</html>