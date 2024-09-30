<?php
$title = "Réveil";
?>
<!DOCTYPE html>
<html lang="en">
<?php include '../includes/head.php' ?>

<head>
    <link rel="stylesheet" href="../assets/css/reveil.css">
</head>

<body class="fond">
    <?php include '../includes/header.php' ?>
    <main>
        <h1>Réveil</h1>
        <div>
            <label for="alarmTime">Entrez l'heure de l'alarme (HH:MM):</label>
            <input type="time" id="alarmTime" required>
        </div>

        <div>
            <label for="alarmMessage">Entrez un message pour l'alarme :</label>
            <input type="text" id="alarmMessage" required>
        </div>

        <button onclick="addAlarm()">Ajouter Alarme</button>

        <h2>Liste des alarmes</h2>
            <ul id="alarmsList"></ul>
    </main>

    <script>
        const alarms = [];

        function updateClock() {
            const now = new Date();

            // Formater l'heure locale en prenant en compte le fuseau horaire et l'heure d'été/hiver
            const options = {
                timeZone: 'Europe/Paris',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            };
            const formattedTime = new Intl.DateTimeFormat('fr-FR', options).format(now);

            // Mettre à jour l'heure de l'horloge
            document.getElementById('clockDisplay').textContent = formattedTime;

            // Vérifier si des alarmes doivent sonner
            checkAlarms(now);
        }

        function addAlarm() {
            const alarmTime = document.getElementById('alarmTime').value;
            const alarmMessage = document.getElementById('alarmMessage').value;

            if (!alarmTime || !alarmMessage) {
                alert("Veuillez entrer une heure et un message pour l'alarme.");
                return;
            }

            // Ajouter l'alarme à la liste avec l'heure et le message
            const alarm = {
                time: alarmTime,
                message: alarmMessage,
                triggered: false
            };
            alarms.push(alarm);

            // Afficher les alarmes dans la liste
            displayAlarms();
        }

        function displayAlarms() {
            const alarmsList = document.getElementById('alarmsList');
            alarmsList.innerHTML = '';

            alarms.forEach((alarm, index) => {
                const now = new Date();
                const alarmDate = new Date(now.toDateString() + ' ' + alarm.time);

                // Calculer le temps restant avant l'alarme
                const timeDifference = alarmDate - now;

                let status = "";
                if (timeDifference <= 0) {
                    status = "Passée";
                } else {
                    const minutesRemaining = Math.floor(timeDifference / 60000);
                    status = `Dans ${minutesRemaining} minute(s)`;
                }

                // Afficher l'alarme avec son statut (passée ou temps restant)
                const listItem = document.createElement('li');
                listItem.textContent = `Alarme à ${alarm.time} - ${alarm.message} (${status})`;
                alarmsList.appendChild(listItem);
            });
        }

        function checkAlarms(now) {
            alarms.forEach(alarm => {
                const alarmDate = new Date(now.toDateString() + ' ' + alarm.time);

                // Si l'alarme est à l'heure actuelle et n'a pas encore été déclenchée
                if (alarmDate <= now && !alarm.triggered) {
                    alert(`Alarme : ${alarm.message}`);
                    alarm.triggered = true; // Marquer l'alarme comme déclenchée
                }
            });

            // Mettre à jour l'affichage des alarmes
            displayAlarms();
        }

        // Mettre à jour l'horloge toutes les secondes
        setInterval(updateClock, 1000);

        // Afficher l'heure immédiatement
        updateClock();
    </script>
</body>

</html>