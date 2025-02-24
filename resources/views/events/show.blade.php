<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Acara</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', 'Segoe UI', system-ui, sans-serif;
        }

        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #1a1c2e, #2d3748);
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }

        .container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 40px;
            width: 100%;
            max-width: 800px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3),
                        inset 0 1px 2px rgba(255, 255, 255, 0.1);
        }

        h2 {
            font-size: 1.8rem;
            margin-bottom: 30px;
            color: #6ee7b7;
            font-weight: 700;
            letter-spacing: 2px;
            text-transform: uppercase;
            text-align: center;
        }

        .event-card {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 24px;
            padding: 40px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .event-title {
            font-size: 2rem;
            color: #6ee7b7;
            margin-bottom: 25px;
            font-weight: 700;
            text-shadow: 0 2px 10px rgba(110, 231, 183, 0.3);
        }

        .event-info {
            margin-bottom: 20px;
            padding: 15px;
            background: rgba(0, 0, 0, 0.2);
            border-radius: 12px;
            border-left: 4px solid #6ee7b7;
        }

        .info-label {
            color: #6ee7b7;
            font-weight: 600;
            margin-bottom: 5px;
            display: block;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .info-content {
            color: #fff;
            font-size: 1.1rem;
            line-height: 1.6;
        }

        .countdown-container {
            background: linear-gradient(135deg, rgba(110, 231, 183, 0.1), rgba(52, 211, 153, 0.1));
            padding: 20px;
            border-radius: 16px;
            margin-top: 30px;
            text-align: center;
            border: 1px solid rgba(110, 231, 183, 0.2);
        }

        #countdown {
            font-size: 1.5rem;
            font-weight: 700;
            color: #6ee7b7;
            text-shadow: 0 2px 10px rgba(110, 231, 183, 0.3);
            font-family: 'JetBrains Mono', monospace;
        }

        .btn {
            padding: 12px 28px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
            position: relative;
            overflow: hidden;
            margin-top: 30px;
        }

        .btn::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(255, 255, 255, 0.2), transparent);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .btn:hover::after {
            opacity: 1;
        }

        .btn-secondary {
            background: linear-gradient(135deg, #94a3b8, #64748b);
            color: #fff;
            box-shadow: 0 4px 15px rgba(100, 116, 139, 0.3);
        }

        .btn-secondary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(100, 116, 139, 0.4);
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .event-card {
                padding: 25px;
            }

            .event-title {
                font-size: 1.5rem;
            }

            #countdown {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Detail Acara</h2>
        
        <div class="event-card">
            <h4 class="event-title">{{ $event->title }}</h4>
            
            <div class="event-info">
                <span class="info-label"><i class="fas fa-user"></i> Nama Pengguna</span>
                <div class="info-content">{{ $event->username }}</div>
            </div>
            
            <div class="event-info">
                <span class="info-label"><i class="fas fa-align-left"></i> Deskripsi</span>
                <div class="info-content">{{ $event->description }}</div>
            </div>
            
            <div class="event-info">
                <span class="info-label"><i class="fas fa-calendar-alt"></i> Tanggal & Waktu</span>
                <div class="info-content">{{ $event->event_date }}</div>
            </div>
            
            <div class="event-info">
                <span class="info-label"><i class="fas fa-map-marker-alt"></i> Lokasi</span>
                <div class="info-content">{{ $event->location }}</div>
            </div>
            
            <div class="countdown-container">
                <span class="info-label"><i class="fas fa-hourglass-half"></i> Waktu Tersisa</span>
                <div id="countdown"></div>
            </div>
        </div>

        <a href="{{ route('detail') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <script>
        var eventTime = new Date("{{ $event->event_date }}").getTime();

        function updateCountdown() {
            var now = new Date().getTime();
            var timeLeft = eventTime - now;

            if (timeLeft > 0) {
                var days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
                var hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

                document.getElementById("countdown").innerHTML =
                    `${days} hari ${hours} jam ${minutes} menit ${seconds} detik`;
            } else {
                document.getElementById("countdown").innerHTML = "Acara sudah dimulai!";
            }
        }

        setInterval(updateCountdown, 1000);
        updateCountdown();
    </script>
</body>
</html>