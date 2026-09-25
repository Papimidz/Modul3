<label for="title">Judul</label>
<input
    id="title"
    name="title"
    type="text"
    value="{{ old('title', $activity->title ?? '') }}"
>

@error('title')
    <p>{{ $message }}</p>
@enderror

<br>

<label for="description">Deskripsi</label>
<textarea
    id="description"
    name="description"
>{{ old('description', $activity->description ?? '') }}</textarea>

@error('description')
    <p>{{ $message }}</p>
@enderror

<br>

<label for="activity_date">Tanggal Kegiatan</label>
<input
    id="activity_date"
    name="activity_date"
    type="date"
    value="{{ old('activity_date', isset($activity) ? $activity->activity_date->format('Y-m-d') : '') }}"
>

@error('activity_date')
    <p>{{ $message }}</p>
@enderror

<br>

<label for="category">Kategori</label>
<input
    id="category"
    name="category"
    type="text"
    value="{{ old('category', $activity->category ?? '') }}"
>

@error('category')
    <p>{{ $message }}</p>
@enderror

<br>

<label for="status">Status</label>
<select id="status" name="status">
    @foreach (['Planned', 'Ongoing', 'Done'] as $status)
        <option
            value="{{ $status }}"
            @selected(old('status', $activity->status ?? 'Planned') === $status)
        >
            {{ $status }}
        </option>
    @endforeach
</select>

@error('status')
    <p>{{ $message }}</p>
@enderror