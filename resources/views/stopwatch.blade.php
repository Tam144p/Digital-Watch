<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modern Digital Stopwatch</title>
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
            background: linear-gradient(135deg, #0a192f, #1f2937);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 40px; /* Diperbesar */
            padding: 60px 70px; /* Diperbesar */
            width: 100%;
            max-width: 800px; /* Diperbesar */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.6);
        }

        .main-stopwatch {
            text-align: center;
            padding: 50px 30px; /* Diperbesar */
            background: rgba(0, 0, 0, 0.2);
            border-radius: 35px; /* Diperbesar */
            margin-bottom: 50px; /* Diperbesar */
            transition: transform 0.3s ease;
        }


        .main-stopwatch:hover {
            transform: scale(1.05);
        }

        .main-stopwatch h1 {
            font-size: 2rem;
            margin-bottom: 20px;
            color: #34d399;
            font-weight: 600;
        }

        .stopwatch-display {
            font-size: 4rem;
            font-weight: 800;
            color: #fff;
            text-shadow: 0 0 20px rgba(52, 211, 153, 0.6);
            margin: 20px 0;
            font-family: 'Courier New', Courier, monospace;
        }

        .lap-times {
            max-height: 250px;
            overflow-y: auto;
            margin: 20px 0;
            padding: 15px;
            background: rgba(0, 0, 0, 0.2);
            border-radius: 15px;
            font-size: 0.9rem;
            color: #ddd;
            opacity: 0.8;
        }

        .lap-time {
            padding: 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .stopwatch-controls {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin: 25px 0;
        }

        button {
            background: #34d399;
            color: #1b2936;
            border: none;
            padding: 12px 24px;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            min-width: 100px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        button:hover {
            background: #10b981;
            transform: translateY(-3px);
            box-shadow: 0 8px 10px rgba(0, 0, 0, 0.4);
        }

        button.stop {
            background: #f87171;
            color: #fff;
        }

        button.stop:hover {
            background: #f43f5e;
        }

        button:disabled {
            background: #4b5563;
            cursor: not-allowed;
            box-shadow: none;
        }

        button:focus {
            outline: none;
            box-shadow: 0 0 5px 2px rgba(52, 211, 153, 0.8);
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="main-stopwatch">
            <h1>STOPWATCH</h1>
            <div class="stopwatch-display" id="stopwatch-display">00:00:00.000</div>
            
            <div class="lap-times" id="lap-times"></div>

            <div class="stopwatch-controls">
                <button id="start-btn">Start</button>
                <button id="stop-btn" class="stop" disabled>Stop</button>
                <button id="lap-btn" disabled>Lap</button>
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
        let startTime;
        let elapsedTime = 0;
        let stopwatchInterval;
        let lapTimes = [];
        let isRunning = false;
        let lastLapTime = 0;

        const display = document.getElementById('stopwatch-display');
        const startBtn = document.getElementById('start-btn');
        const stopBtn = document.getElementById('stop-btn');
        const lapBtn = document.getElementById('lap-btn');
        const resetBtn = document.getElementById('reset-btn');
        const lapTimesContainer = document.getElementById('lap-times');

        function formatTime(ms) {
            const date = new Date(ms);
            const minutes = String(date.getMinutes()).padStart(2, '0');
            const seconds = String(date.getSeconds()).padStart(2, '0');
            const milliseconds = String(date.getMilliseconds()).padStart(3, '0');
            return `${minutes}:${seconds}.${milliseconds}`;
        }

        function updateDisplay() {
            const currentTime = Date.now() - startTime + elapsedTime;
            display.textContent = formatTime(currentTime);
        }

        function updateButtonStates(running) {
            startBtn.disabled = running;
            stopBtn.disabled = !running;
            lapBtn.disabled = !running;
            resetBtn.disabled = running;
        }

        function addLapTime() {
            const currentTime = Date.now() - startTime + elapsedTime;
            const lapTime = currentTime - lastLapTime;
            lastLapTime = currentTime;
            
            const lapNumber = lapTimes.length + 1;
            lapTimes.unshift({
                number: lapNumber,
                totalTime: currentTime,
                lapTime: lapTime
            });

            updateLapTimesDisplay();
        }

        function updateLapTimesDisplay() {
            lapTimesContainer.innerHTML = '';
            lapTimes.forEach(lap => {
                const lapElement = document.createElement('div');
                lapElement.className = 'lap-time';
                lapElement.innerHTML = `Lap ${lap.number} <span>${formatTime(lap.lapTime)}</span>`;
                lapTimesContainer.appendChild(lapElement);
            });
        }

        startBtn.addEventListener('click', function() {
            isRunning = true;
            startTime = Date.now();
            updateButtonStates(true);

            stopwatchInterval = setInterval(updateDisplay, 10);
        });

        stopBtn.addEventListener('click', function() {
            isRunning = false;
            clearInterval(stopwatchInterval);
            elapsedTime += Date.now() - startTime;
            updateButtonStates(false);
        });

        lapBtn.addEventListener('click', addLapTime);

        resetBtn.addEventListener('click', function() {
            isRunning = false;
            clearInterval(stopwatchInterval);
            elapsedTime = 0;
            lastLapTime = 0;
            lapTimes = [];
            display.textContent = '00:00.000';
            lapTimesContainer.innerHTML = '';
            updateButtonStates(false);
        });
    </script>
</body>
</html>
