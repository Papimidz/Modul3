<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Detail Kegiatan</title>
</head>

<body>

    {{-- Pesan berhasil --}}
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    {{-- Pesan error business rule / validation --}}
    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <h1>{{ $activity->title }}</h1>

    <p>
        <strong>Kode:</strong>
        {{ $activity->code }}
    </p>

    <p>
        <strong>Deskripsi:</strong>
        {{ $activity->description ?? '-' }}
    </p>

    <p>
        <strong>Kategori:</strong>
        {{ $activity->category->name }}
    </p>

    <p>
        <strong>Mulai:</strong>
        {{ $activity->start_at?->format('d M Y H:i') }}
    </p>

    <p>
        <strong>Selesai:</strong>
        {{ $activity->end_at?->format('d M Y H:i') }}
    </p>

    <p>
        <strong>Lokasi:</strong>
        {{ $activity->location ?? '-' }}
    </p>

    <p>
        <strong>Kapasitas:</strong>
        {{ $activity->capacity ?? '-' }}
    </p>

    <p>
        <strong>Status:</strong>
        {{ ucfirst($activity->status) }}
    </p>

    {{-- Poster --}}
    @if ($activity->poster_path)
        <p>
            <strong>Poster:</strong>
        </p>

        <img
            src="{{ asset('storage/' . $activity->poster_path) }}"
            alt="Poster {{ $activity->title }}"
            width="300"
        >
    @else
        <p>
            <strong>Poster:</strong>
            Belum ada poster.
        </p>
    @endif

    <hr>

    {{-- Aksi status --}}
    @if ($activity->status === 'draft')
        <form
            method="POST"
            action="{{ route('activities.publish', $activity) }}"
        >
            @csrf

            <button type="submit">
                Publish
            </button>
        </form>
    @endif

    @if ($activity->status === 'published')
        <form
            method="POST"
            action="{{ route('activities.complete', $activity) }}"
        >
            @csrf

            <button type="submit">
                Complete
            </button>
        </form>
    @endif

    @if ($activity->status === 'completed')
        <p>Kegiatan telah selesai.</p>
    @endif

    <hr>

    <a href="{{ route('activities.edit', $activity) }}">
        Edit Kegiatan
    </a>

    <br><br>

    <form
        action="{{ route('activities.destroy', $activity) }}"
        method="POST"
    >
        @csrf
        @method('DELETE')

        <button
            type="submit"
            onclick="return confirm('Yakin ingin menghapus kegiatan ini?')"
        >
            Hapus Kegiatan
        </button>
    </form>

    <br>

    <a href="{{ route('activities.index') }}">
        Kembali ke daftar
    </a>

</body>
</html>