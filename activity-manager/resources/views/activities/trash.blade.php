<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trash Kegiatan</title>
</head>
<body>

    <h1>Trash Kegiatan</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <a href="{{ route('activities.index') }}">
        Kembali ke daftar aktif
    </a>

    <hr>

    @forelse ($activities as $activity)
        <article>
            <h2>{{ $activity->title }}</h2>

            <p>
                Kode:
                {{ $activity->code }}
            </p>

            <p>
                Kategori:
                {{ $activity->category->name }}
            </p>

            <p>
                Status:
                {{ ucfirst($activity->status) }}
            </p>

            <p>
                Dihapus:
                {{ $activity->deleted_at?->format('d M Y H:i') }}
            </p>

            <form
                method="POST"
                action="{{ route('activities.restore', $activity->id) }}"
            >
                @csrf

                <button type="submit">
                    Restore
                </button>
            </form>
        </article>

        <hr>
    @empty
        <p>Tidak ada kegiatan di Trash.</p>
    @endforelse

    {{ $activities->links() }}

</body>
</html>