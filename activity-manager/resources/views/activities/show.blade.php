<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kegiatan</title>
</head>
<body>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <h1>{{ $activity->title }}</h1>

    <p>{{ $activity->description }}</p>

    <p>
        Tanggal:
        {{ $activity->activity_date->format('d M Y') }}
    </p>

    <p>
        Kategori:
        {{ $activity->category }}
    </p>

    <p>
        Status:
        {{ $activity->status }}
    </p>

    <a href="{{ route('activities.edit', $activity) }}">
        Edit Kegiatan
    </a>

    <br><br>

    <form action="{{ route('activities.destroy', $activity) }}" method="POST">
        @csrf
        @method('DELETE')

        <button type="submit">
            Hapus Kegiatan
        </button>
    </form>

    <br>

    <a href="{{ route('activities.index') }}">
        Kembali ke daftar
    </a>

</body>
</html>