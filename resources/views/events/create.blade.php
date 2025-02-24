<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Acara</title>
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

        .form-container {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 24px;
            padding: 40px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
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

        .form-label {
            color: #e2e8f0;
            font-weight: 500;
            margin-bottom: 8px;
            font-size: 0.95rem;
        }

        .form-control {
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: #fff;
            border-radius: 12px;
            padding: 12px 20px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: rgba(254, 249, 249, 0.47);
            border-color: #6ee7b7;
            box-shadow: 0 0 0 3px rgba(110, 231, 183, 0.2);
            outline: none;
        }

        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .btn {
            padding: 12px 28px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            border: none;
            margin-right: 10px;
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

        .btn-success {
            background: linear-gradient(135deg, #6ee7b7, #34d399);
            color: #1a1c2e;
            box-shadow: 0 4px 15px rgba(52, 211, 153, 0.3);
        }

        .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(52, 211, 153, 0.4);
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

        .button-group {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            .form-container {
                padding: 30px 20px;
            }

            .button-group {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                margin-right: 0;
                margin-bottom: 10px;
            }
        }

        /* Custom styling for datetime-local input */
        input[type="datetime-local"] {
            color-scheme: dark;
        }

        /* Add icons to form fields */
        .input-group {
            position: relative;
            margin-bottom: 1.5rem;
        }

        .input-group i {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.4);
            pointer-events: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Tambah Acara</h2>

            <form action="{{ route('events.store') }}" method="POST">
                @csrf
                <div class="input-group">
                    <label class="form-label">Nama Pengguna</label>
                    <input type="text" name="username" class="form-control" required 
                           placeholder="Masukkan nama pengguna">
                    <i class="fas fa-user"></i>
                </div>

                <div class="input-group">
                    <label class="form-label">Judul Acara</label>
                    <input type="text" name="title" class="form-control" required
                           placeholder="Masukkan judul acara">
                    <i class="fas fa-heading"></i>
                </div>

                <div class="input-group">
                    <label class="form-label">Deskripsi</label>
                    <textarea name="description" class="form-control" required
                              placeholder="Deskripsikan acara Anda"></textarea>
                    <i class="fas fa-align-left"></i>
                </div>

                <div class="input-group">
                    <label class="form-label">Tanggal & Waktu</label>
                    <input type="datetime-local" name="event_date" class="form-control" required>
                    <i class="fas fa-calendar-alt"></i>
                </div>

                <div class="input-group">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="location" class="form-control" required
                           placeholder="Masukkan lokasi acara">
                    <i class="fas fa-map-marker-alt"></i>
                </div>

                <div class="button-group">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                    <a href="{{ route('detail') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>