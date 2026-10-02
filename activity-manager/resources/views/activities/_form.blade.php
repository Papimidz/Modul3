<div>
    <label for="category_id">Kategori</label>

    <select
        id="category_id"
        name="category_id"
        required
    >
        <option value="">Pilih Kategori</option>

        @foreach ($categories as $category)
            <option
                value="{{ $category->id }}"
                @selected(
                    (string) old(
                        'category_id',
                        $activity->category_id ?? ''
                    ) === (string) $category->id
                )
            >
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    @error('category_id')
        <p>{{ $message }}</p>
    @enderror
</div>

<br>

<div>
    <label for="code">Kode Kegiatan</label>

    <input
        id="code"
        name="code"
        type="text"
        value="{{ old('code', $activity->code ?? '') }}"
        required
    >

    @error('code')
        <p>{{ $message }}</p>
    @enderror
</div>

<br>

<div>
    <label for="title">Judul</label>

    <input
        id="title"
        name="title"
        type="text"
        value="{{ old('title', $activity->title ?? '') }}"
        required
    >

    @error('title')
        <p>{{ $message }}</p>
    @enderror
</div>

<br>

<div>
    <label for="description">Deskripsi</label>

    <textarea
        id="description"
        name="description"
    >{{ old('description', $activity->description ?? '') }}</textarea>

    @error('description')
        <p>{{ $message }}</p>
    @enderror
</div>

<br>

<div>
    <label for="start_at">Tanggal dan Waktu Mulai</label>

    <input
        id="start_at"
        name="start_at"
        type="datetime-local"
        value="{{ old(
            'start_at',
            isset($activity) && $activity->start_at
                ? $activity->start_at->format('Y-m-d\TH:i')
                : ''
        ) }}"
        required
    >

    @error('start_at')
        <p>{{ $message }}</p>
    @enderror
</div>

<br>

<div>
    <label for="end_at">Tanggal dan Waktu Selesai</label>

    <input
        id="end_at"
        name="end_at"
        type="datetime-local"
        value="{{ old(
            'end_at',
            isset($activity) && $activity->end_at
                ? $activity->end_at->format('Y-m-d\TH:i')
                : ''
        ) }}"
        required
    >

    @error('end_at')
        <p>{{ $message }}</p>
    @enderror
</div>

<br>

<div>
    <label for="location">Lokasi</label>

    <input
        id="location"
        name="location"
        type="text"
        value="{{ old('location', $activity->location ?? '') }}"
    >

    @error('location')
        <p>{{ $message }}</p>
    @enderror
</div>

<br>

<div>
    <label for="capacity">Kapasitas</label>

    <input
        id="capacity"
        name="capacity"
        type="number"
        min="1"
        max="500"
        value="{{ old('capacity', $activity->capacity ?? '') }}"
        required
    >

    @error('capacity')
        <p>{{ $message }}</p>
    @enderror
</div>

<br>

<div>
    <label for="poster">Poster Kegiatan</label>

    <input
        id="poster"
        name="poster"
        type="file"
        accept="image/*"
    >

    @error('poster')
        <p>{{ $message }}</p>
    @enderror
</div>