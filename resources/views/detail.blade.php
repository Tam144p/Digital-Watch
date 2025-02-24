<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Acara</title>
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
            align-items: flex-start;
            padding: 40px 20px;
        }

        .container {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 40px;
            width: 100%;
            max-width: 1200px;
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

        .card {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            border-radius: 20px;
            padding: 20px;
            margin-bottom: 20px;
            color: #fff;
            transition: all 0.3s ease;
        }

        .card:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .card-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #6ee7b7;
        }

        .card-text {
            font-size: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Daftar Acara</h2>
        <a href="{{ route('events.create') }}" class="btn btn-primary mb-4">
            <i class="fas fa-plus"></i> Tambah Acara
        </a>

        <div class="row">
            @foreach ($events as $event)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $event->title }}</h5>
                            <p class="card-text">{{ $event->username }}</p>
                            <a href="{{ route('events.show', $event->id) }}" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> Lihat
                            </a>
                            <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('events.destroy', $event->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>
