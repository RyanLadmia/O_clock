<?php
$title = "Horloge";
?>
<!DOCTYPE html>
<html lang="en">
<?php include '../includes/head.php' ?>

<head>
    <link rel="stylesheet" href="../assets/css/horloge.css">
</head>

<body class="fond">
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

            // Récupération de l'heure locale avec prise en compte de l'heure d'été/hiver
            const options = {
                timeZone: 'Europe/Paris', // Timezone pour la France
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            };

            // Utilisation de l'API Intl.DateTimeFormat pour afficher l'heure locale correcte
            const formattedTime = new Intl.DateTimeFormat('fr-FR', options).format(now);

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