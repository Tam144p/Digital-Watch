<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Acara</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">

    <h2 class="mb-4">Edit Acara</h2>

    <form action="{{ route('events.update', $event->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nama Pengguna</label>
            <input type="text" name="username" class="form-control" value="{{ $event->username }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Judul Acara</label>
            <input type="text" name="title" class="form-control" value="{{ $event->title }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="description" class="form-control" required>{{ $event->description }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal & Waktu</label>
            <input type="datetime-local" name="event_date" class="form-control" value="{{ date('Y-m-d\TH:i', strtotime($event->event_date)) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Lokasi</label>
            <input type="text" name="location" class="form-control" value="{{ $event->location }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('detail') }}" class="btn btn-secondary">Kembali</a>
    </form>

</body>
</html>
