<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Digital Alarm</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #1a1f25 0%, #3c4b58 100%);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            text-align: center;
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 350px;
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 15px;
            color: #7dd3fc;
        }

        .current-time {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        input[type="time"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            font-size: 1.2rem;
            border: none;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
        }

        button {
            background: #7dd3fc;
            color: #1a1f25;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin: 10px;
        }

        button:hover {
            background: #0ea5e9;
            transform: translateY(-2px);
        }

        .stop-btn {
            background: #ef4444;
            display: none;
        }

        .stop-btn:hover {
            background: #dc2626;
        }

        .icon {
            font-size: 2rem;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Digital Alarm</h1>
        <div class="current-time" id="current-time">00:00</div>
        <input type="time" id="alarm-time" />
        <button id="set-alarm-btn"><i class="fas fa-bell"></i> Set Alarm</button>
        <button id="stop-alarm-btn" class="stop-btn"><i class="fas fa-stop"></i> Stop Alarm</button>
        <button id="set-alarm-btn">
        <a href="/">
            <i class="fas fa-arrow-right"></i>
        </a>
        </button>

    </div>

    <audio id="alarm-sound" src="https://www.soundjay.com/button/beep-07.wav" preload="auto"></audio>
    <audio id="stop-sound" src="https://www.soundjay.com/button/button-50.wav" preload="auto"></audio>

    <script>
        const currentTimeDisplay = document.getElementById('current-time');
        const alarmTimeInput = document.getElementById('alarm-time');
        const setAlarmButton = document.getElementById('set-alarm-btn');
        const stopAlarmButton = document.getElementById('stop-alarm-btn');
        const alarmSound = document.getElementById('alarm-sound');
        const stopSound = document.getElementById('stop-sound');

        let alarmTime = null;
        let alarmSet = false;
        let alarmInterval;

        // Update current time every second
        setInterval(() => {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            currentTimeDisplay.textContent = `${hours}:${minutes}`;

            // Check if the alarm should ring
            if (alarmSet && alarmTime === `${hours}:${minutes}`) {
                startAlarm();
            }
        }, 1000);

        function startAlarm() {
            stopAlarmButton.style.display = 'inline-block';
            alarmSound.play().catch((err) => {
                console.error('Error playing alarm sound:', err);
                alert('Browser blocked the audio playback. Please enable autoplay or click anywhere on the page.');
            });
            alarmSet = false; // Reset the alarm to avoid multiple rings
        }

        function stopAlarm() {
            clearInterval(alarmInterval);
            alarmSound.pause();
            alarmSound.currentTime = 0;
            stopSound.play().catch(console.error);
            stopAlarmButton.style.display = 'none';
        }

        // Set alarm
        setAlarmButton.addEventListener('click', () => {
            if (alarmTimeInput.value) {
                alarmTime = alarmTimeInput.value;
                alarmSet = true;
                alert(`Alarm set for ${alarmTime}`);
            } else {
                alert('Please select a time to set the alarm.');
            }
        });

        // Stop alarm
        stopAlarmButton.addEventListener('click', stopAlarm);
    </script>
</body>
</html>
