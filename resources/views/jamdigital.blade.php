<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Watch</title>
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
            background: #000;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .watch-face {
            position: relative;
            width: 350px; /* Increased width */
            height: 350px; /* Increased height */
            background: #000;
            border-radius: 50%;
            border: 12px solid #222;
            box-shadow: 
                inset 0 0 50px rgba(255,255,255,0.1),
                0 0 30px rgba(0,0,0,0.5);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .watch-face::before {
            content: '';
            position: absolute;
            top: -1px;
            left: -1px;
            right: -1px;
            bottom: -1px;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1));
            border-radius: 50%;
            pointer-events: none;
        }

        .title {
            font-size: 2rem; /* Large font size */
            font-weight: 500; /* Medium weight */
            color: #00ff9d;
            text-shadow: 0 0 15px rgba(0,255,157,0.5);
            margin-bottom: 10px; /* Space between title and clock */
        }

        .clock {
            font-size: 3.2rem;
            font-weight: 300;
            color: #00ff9d;
            text-shadow: 0 0 15px rgba(0,255,157,0.5);
            letter-spacing: 2px;
            margin-bottom: 5px;
        }

        .date {
            font-size: 1rem;
            color: #00ff9d;
            opacity: 0.7;
            letter-spacing: 1px;
        }

        .navigation {
            position: fixed;
            bottom: 20px;
            display: flex;
            gap: 20px;
        }

        .nav-btn {
            background: transparent;
            border: none;
            color: #00ff9d;
            font-size: 1.5rem;
            cursor: pointer;
            transition: all 0.3s;
            padding: 10px;
            border-radius: 50%;
        }

        .nav-btn:hover {
            background: rgba(0,255,157,0.1);
            transform: translateY(-2px);
        }

        .logout-btn {
            position: fixed;
            top: 20px;
            right: 20px;
            background: rgba(255,0,0,0.2);
            color: #ff4444;
            border: 1px solid #ff4444;
            padding: 8px 16px;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s;
        }

        .logout-btn:hover {
            background: rgba(255,0,0,0.3);
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

    <div class="watch-face">
        <div class="title" id="title">Digital Watch</div> <!-- Added large text here -->
        <div class="clock" id="clock">00:00:00:000</div>
        <div class="date" id="date"></div>
    </div>

    <div class="navigation">
        <button class="nav-btn" onclick="window.location.href='/alarm'">
            <i class="fas fa-bell"></i>
        </button>
        <button class="nav-btn" onclick="window.location.href='/timer'">
            <i class="fas fa-hourglass"></i>
        </button>
        <button class="nav-btn" onclick="window.location.href='/detail'">
            <i class="fas fa-calendar"></i>
        </button>
        <button class="nav-btn" onclick="window.location.href='/stopwatch'">
            <i class="fas fa-stopwatch"></i>
        </button>
    </div>

    <script>
        function updateClock() {
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const milliseconds = String(now.getMilliseconds()).padStart(3, '0');
            document.getElementById('clock').textContent = `${hours}:${minutes}:${seconds}:${milliseconds}`;
            
            const options = { weekday: 'short', month: 'short', day: 'numeric' };
            document.getElementById('date').textContent = now.toLocaleDateString('en-US', options);
        }
        
        setInterval(updateClock, 10); // Update every 10ms for smooth milliseconds display
        updateClock();
    </script>
</body>
</html>
