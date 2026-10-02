<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Daftar Kegiatan</title>
</head>

<body>
    <h1>Daftar Kegiatan</h1>

    {{-- Pesan sukses --}}
    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    {{-- Search, Filter, dan Sort --}}
    <form method="GET" action="{{ route('activities.index') }}">
        <div>
            <label for="search">Cari:</label>

            <input
                type="text"
                name="search"
                id="search"
                value="{{ $search }}"
                placeholder="Cari code atau judul"
            >
        </div>

        <br>

        <div>
            <label for="category_id">Kategori:</label>

            <select name="category_id" id="category_id">
                <option value="">Semua Kategori</option>

                @foreach ($categories as $category)
                    <option
                        value="{{ $category->id }}"
                        @selected((string) $categoryId === (string) $category->id)
                    >
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <br>

        <div>
            <label for="status">Status:</label>

            <select name="status" id="status">
                <option value="">Semua Status</option>

                <option
                    value="draft"
                    @selected($status === 'draft')
                >
                    Draft
                </option>

                <option
                    value="published"
                    @selected($status === 'published')
                >
                    Published
                </option>

                <option
                    value="completed"
                    @selected($status === 'completed')
                >
                    Completed
                </option>
            </select>
        </div>

        <br>

        <div>
            <label for="sort">Urutan Tanggal:</label>

            <select name="sort" id="sort">
                <option
                    value="latest"
                    @selected($sort === 'latest')
                >
                    Terbaru
                </option>

                <option
                    value="oldest"
                    @selected($sort === 'oldest')
                >
                    Terlama
                </option>
            </select>
        </div>

        <br>

        <button type="submit">Filter</button>

        <a href="{{ route('activities.index') }}">
            Reset
        </a>
    </form>

    <hr>

    <a href="{{ route('activities.create') }}">
        Tambah Kegiatan
    </a>

    <hr>

    {{-- Daftar Activity --}}
    @forelse ($activities as $activity)
        <article>
            <h2>
                <a href="{{ route('activities.show', $activity) }}">
                    {{ $activity->title }}
                </a>
            </h2>

            <p>
                Kode:
                {{ $activity->code }}
            </p>

            <p>
                Kategori:
                {{ $activity->category->name }}
            </p>

            <p>
                Tanggal Mulai:
                {{ $activity->start_at?->format('d M Y H:i') }}
            </p>

            <p>
                Tanggal Selesai:
                {{ $activity->end_at?->format('d M Y H:i') }}
            </p>

            <p>
                Lokasi:
                {{ $activity->location }}
            </p>

            <p>
                Kapasitas:
                {{ $activity->capacity }}
            </p>

            <p>
                Status:
                {{ ucfirst($activity->status) }}
            </p>

            <a href="{{ route('activities.edit', $activity) }}">
                Edit
            </a>

            <form
                method="POST"
                action="{{ route('activities.destroy', $activity) }}"
                style="display: inline;"
            >
                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    onclick="return confirm('Yakin ingin menghapus kegiatan ini?')"
                >
                    Hapus
                </button>
            </form>
        </article>

        <hr>
    @empty
        <p>Tidak ada kegiatan yang sesuai.</p>
    @endforelse

    {{-- Pagination --}}
    <div>
        {{ $activities->links() }}
    </div>
</body>
</html>