<?php
$title = "Minuteur";
?>
<!DOCTYPE html>
<html lang="en">
<?php include '../includes/head.php' ?>
<head>
    <link rel="stylesheet" href="../assets/css/minuteur.css">
</head>
<body>
    <?php include '../includes/header.php' ?>
    <main>
        <h1>Minuteur</h1>
            <div class="container">
                <!-- Affichage du minuteur -->
                <div class="timer">
                    <span id="timeDisplay">00:00</span>
                </div>

                <!-- Flèches pour augmenter ou diminuer le temps -->
                <div class="controls">
                    <button id="increaseTime">▲</button>
                    <input type="number" id="timeInput" placeholder="Saisir un temps en secondes">
                    <button id="decreaseTime">▼</button>
                </div>

                <!-- Bouton pour démarrer ou stopper le minuteur -->
                <div class="actions">
                    <button id="startStopBtn">Démarrer</button>
                </div>
            </div>
    </main>

    <script>
        let timeInSeconds = 0;
        let timerInterval = null;
        let isRunning = false;

        // Sélection des éléments du DOM
        const timeDisplay = document.getElementById("timeDisplay");
        const timeInput = document.getElementById("timeInput");
        const startStopBtn = document.getElementById("startStopBtn");
        const increaseTimeBtn = document.getElementById("increaseTime");
        const decreaseTimeBtn = document.getElementById("decreaseTime");

        // Fonction pour afficher le temps en format mm:ss
        function displayTime(seconds) {
            const minutes = Math.floor(seconds / 60);
            const remainingSeconds = seconds % 60;
            timeDisplay.textContent = `${String(minutes).padStart(2, '0')}:${String(remainingSeconds).padStart(2, '0')}`;
        }

        // Mise à jour initiale
        displayTime(timeInSeconds);

        // Augmenter le temps avec la flèche ▲
        increaseTimeBtn.addEventListener('click', () => {
            timeInSeconds += 60; // Ajoute 60 secondes (1 minute)
            displayTime(timeInSeconds);
        });

        // Diminuer le temps avec la flèche ▼
        decreaseTimeBtn.addEventListener('click', () => {
            if (timeInSeconds >= 60) {
                timeInSeconds -= 60;
                displayTime(timeInSeconds);
            }
        });

        // Saisie du temps avec l'input
        timeInput.addEventListener('change', () => {
            const inputSeconds = parseInt(timeInput.value, 10);
            if (!isNaN(inputSeconds) && inputSeconds > 0) {
                timeInSeconds = inputSeconds;
                displayTime(timeInSeconds);
            }
            timeInput.value = ''; // Réinitialise le champ input
        });

        // Fonction pour démarrer le minuteur
        function startTimer() {
            timerInterval = setInterval(() => {
                if (timeInSeconds > 0) {
                    timeInSeconds--;
                    displayTime(timeInSeconds);
                } else {
                    clearInterval(timerInterval);
                    alert("Le temps est écoulé !");
                    isRunning = false;
                    startStopBtn.textContent = "Démarrer";
                }
            }, 1000);
        }

        // Démarrer ou arrêter le minuteur
        startStopBtn.addEventListener('click', () => {
            if (isRunning) {
                clearInterval(timerInterval);
                startStopBtn.textContent = "Démarrer";
            } else {
                startTimer();
                startStopBtn.textContent = "Arrêter";
            }
            isRunning = !isRunning;
        });
    </script>
</body>

</html>