<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Digital Timer</title>
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
            background: linear-gradient(135deg, #4e6e94 0%, #2e4052 100%);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            font-size: 16px;
        }

        .container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.25);
            width: 100%;
            max-width: 800px;
        }

        .main-timer {
            text-align: center;
            padding: 25px;
            background: rgba(0, 0, 0, 0.3);
            border-radius: 15px;
            margin-bottom: 30px;
        }

        .main-timer h1 {
            font-size: 1.8rem;
            margin-bottom: 20px;
            color: #00aaff;
            font-weight: 600;
        }

        .timer-display {
            font-size: 4rem;
            font-weight: 700;
            color: #fff;
            text-shadow: 0 0 25px rgba(0, 170, 255, 0.6);
            margin: 20px 0;
            font-family: 'Courier New', monospace;
        }

        .timer-inputs {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin: 20px 0;
        }

        select {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 10px 20px;
            border-radius: 10px;
            color: #fff;
            font-size: 1.2rem;
            cursor: pointer;
        }

        select option {
            background: #2e4052;
            color: #fff;
        }

        button {
            background: #00aaff;
            color: #2e4052;
            border: none;
            padding: 12px 25px;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin: 5px;
            min-width: 100px;
        }

        button:hover {
            background: #0088cc;
            transform: translateY(-3px);
        }

        button.stop {
            background: #f44336;
            color: #fff;
        }

        button.stop:hover {
            background: #d32f2f;
        }

        button:disabled {
            background: #64748b;
            cursor: not-allowed;
            transform: none;
        }

        .timer-controls {
            display: flex;
            gap: 15px;
            justify-content: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <audio id="timerSound">
        <source src="https://cdnjs.cloudflare.com/ajax/libs/sound-effects/1.0.0/beep.mp3" type="audio/mpeg">
    </audio>

    <div class="container">
        <div class="main-timer">
            <h1>TIMER</h1>
            <div class="timer-display" id="timer-display">00:00:00</div>
            
            <div class="timer-inputs">
                <select id="hours">
                    <option value="" selected hidden>Hours</option>
                    <script>
                        for(let i = 0; i <= 23; i++) {
                            document.write(`<option value="${i}">${String(i).padStart(2, '0')}</option>`);
                        }
                    </script>
                </select>
                <select id="minutes">
                    <option value="" selected hidden>Minutes</option>
                    <script>
                        for(let i = 0; i <= 59; i++) {
                            document.write(`<option value="${i}">${String(i).padStart(2, '0')}</option>`);
                        }
                    </script>
                </select>
                <select id="seconds">
                    <option value="" selected hidden>Seconds</option>
                    <script>
                        for(let i = 0; i <= 59; i++) {
                            document.write(`<option value="${i}">${String(i).padStart(2, '0')}</option>`);
                        }
                    </script>
                </select>
            </div>

            <div class="timer-controls">
                <button id="start-btn">Start</button>
                <button id="stop-btn" class="stop" disabled>Stop</button>
                <button id="reset-btn" disabled>Reset</button>
                <button id="start-btn">
                    <a href="/">
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </button>
            </div>
        </div>
    </div>

    <script>
        let timerInterval;
        let timeLeft = 0;
        const display = document.getElementById('timer-display');
        const startBtn = document.getElementById('start-btn');
        const stopBtn = document.getElementById('stop-btn');
        const resetBtn = document.getElementById('reset-btn');
        const hoursSelect = document.getElementById('hours');
        const minutesSelect = document.getElementById('minutes');
        const secondsSelect = document.getElementById('seconds');
        const timerSound = document.getElementById('timerSound');

        function playTimerSound() {
            const audioContext = new (window.AudioContext || window.webkitAudioContext)();
            const oscillator = audioContext.createOscillator();
            const gainNode = audioContext.createGain();
            oscillator.connect(gainNode);
            gainNode.connect(audioContext.destination);
            oscillator.type = 'sine';
            oscillator.frequency.value = 800;
            gainNode.gain.value = 0.5;
            oscillator.start();
            setTimeout(() => {
                oscillator.stop();
            }, 500);
        }

        function formatTime(seconds) {
            const h = Math.floor(seconds / 3600);
            const m = Math.floor((seconds % 3600) / 60);
            const s = seconds % 60;
            return `${String(h).padStart(2, '0')}:${String(m).padStart(2, '0')}:${String(s).padStart(2, '0')}`;
        }

        function updateInputStates(disabled) {
            hoursSelect.disabled = disabled;
            minutesSelect.disabled = disabled;
            secondsSelect.disabled = disabled;
        }

        function updateButtonStates(running) {
            startBtn.disabled = running;
            stopBtn.disabled = !running;
            resetBtn.disabled = !running && timeLeft === 0;
        }

        startBtn.addEventListener('click', function() {
            const hours = parseInt(hoursSelect.value) || 0;
            const minutes = parseInt(minutesSelect.value) || 0;
            const seconds = parseInt(secondsSelect.value) || 0;
            
            if (hours === 0 && minutes === 0 && seconds === 0) {
                alert('Please set a time value');
                return;
            }

            timeLeft = hours * 3600 + minutes * 60 + seconds;
            updateInputStates(true);
            updateButtonStates(true);

            timerInterval = setInterval(function() {
                timeLeft--;
                display.textContent = formatTime(timeLeft);

                if (timeLeft <= 0) {
                    clearInterval(timerInterval);
                    playTimerSound();
                    alert('Time is up!');
                    updateInputStates(false);
                    updateButtonStates(false);
                    timeLeft = 0;
                }
            }, 1000);
        });

        stopBtn.addEventListener('click', function() {
            clearInterval(timerInterval);
            updateButtonStates(false);
        });

        resetBtn.addEventListener('click', function() {
            clearInterval(timerInterval);
            timeLeft = 0;
            display.textContent = '00:00:00';
            updateInputStates(false);
            updateButtonStates(false);
            hoursSelect.value = '';
            minutesSelect.value = '';
            secondsSelect.value = '';
        });
    </script>
</body>
</html>
