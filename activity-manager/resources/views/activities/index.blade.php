<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kegiatan</title>
</head>
<body>
    <h1>Daftar Kegiatan</h1>

    @forelse ($activities as $activity)
        <article>
            <h2>
                <a href="{{ route('activities.show', $activity) }}">
                    {{ $activity->title }}
                </a>
            </h2>
            <p>Tanggal: {{ $activity->activity_date->format('d M Y') }}</p>
            <p>Kategori: {{ $activity->category }}</p>
            <p>Status: {{ $activity->status }}</p>
        </article>
    @empty
        <p>Belum ada kegiatan.</p>
    @endforelse
</body>
</html>