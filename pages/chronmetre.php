<?php
$title = "Chronomètre";
?>
<!DOCTYPE html>
<html lang="en">
<?php include '../includes/head.php' ?>
<head>
    <link rel="stylesheet" href="../assets/css/chronometre.css">
</head>
<body>
    <?php include '../includes/header.php' ?>
    <main>
        <h1>Chronomètre</h1>
        <!-- Affichage du chronomètre -->
        <div class="timer">
            <span id="chronoDisplay">00:00:00</span>
        </div>

        <!-- Boutons pour le chronomètre -->
        <div class="actions">
            <button id="startStopBtn">Démarrer</button>
            <button id="lapBtn" disabled>Tour</button>
            <button id="resetBtn" disabled>Réinitialiser</button>
        </div>

        <!-- Liste des temps -->
        <div class="laps">
            <h2>Temps</h2>
            <ul id="lapsList"></ul>
        </div>
    </div>
    </main>
    <script>
        let milliseconds = 0;
        let timerInterval = null;
        let isRunning = false;

        // Sélection des éléments du DOM
        const chronoDisplay = document.getElementById('chronoDisplay');
        const startStopBtn = document.getElementById('startStopBtn');
        const lapBtn = document.getElementById('lapBtn');
        const resetBtn = document.getElementById('resetBtn');
        const lapsList = document.getElementById('lapsList');

        // Fonction pour formater le temps en hh:mm:ss
        function formatTime(ms) {
            const hours = Math.floor(ms / 3600000);
            const minutes = Math.floor((ms % 3600000) / 60000);
            const seconds = Math.floor((ms % 60000) / 1000);
            const milliseconds = Math.floor((ms % 1000) / 10);

            return `${String(hours).padStart(2, '0')}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
        }

        // Fonction pour mettre à jour l'affichage du chronomètre
        function updateChronoDisplay() {
            chronoDisplay.textContent = formatTime(milliseconds);
        }

        // Fonction pour démarrer le chronomètre
        function startChrono() {
            timerInterval = setInterval(() => {
                milliseconds += 10; // Ajoute 10ms (millièmes de seconde)
                updateChronoDisplay();
            }, 10);
        }

        // Fonction pour arrêter le chronomètre
        function stopChrono() {
            clearInterval(timerInterval);
        }

        // Démarrer ou arrêter le chronomètre
        startStopBtn.addEventListener('click', () => {
            if (isRunning) {
                stopChrono();
                startStopBtn.textContent = 'Démarrer';
                lapBtn.disabled = true;
                resetBtn.disabled = false;
            } else {
                startChrono();
                startStopBtn.textContent = 'Arrêter';
                lapBtn.disabled = false;
                resetBtn.disabled = true;
            }
            isRunning = !isRunning;
        });

        // Ajouter un tour (lap)
        lapBtn.addEventListener('click', () => {
            const lapTime = formatTime(milliseconds);
            const li = document.createElement('li');
            li.textContent = lapTime;
            lapsList.appendChild(li);
        });

        // Réinitialiser le chronomètre
        resetBtn.addEventListener('click', () => {
            milliseconds = 0;
            updateChronoDisplay();
            lapsList.innerHTML = ''; // Vide la liste des tours
            resetBtn.disabled = true;
        });
    </script>
</body>

</html>