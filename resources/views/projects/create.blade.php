@extends('layouts.app')

@section('title', 'Tambah Proyek - GarudaHub')

@section('content')
    <h2>Tambah Proyek Baru</h2>

    <form action="{{ route('projects.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="client_id">Client</label>
            <select name="client_id" id="client_id" required>
                <option value="">-- Pilih Client --</option>
                @foreach ($clients as $client)
                    <option value="{{ $client->id }}" @selected(old('client_id') == $client->id)>
                        {{ $client->name }} ({{ $client->email }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="title">Judul Proyek</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required>
        </div>

        <div class="form-group">
            <label for="description">Deskripsi</label>
            <textarea name="description" id="description" rows="4" required>{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="budget">Budget (Rp)</label>
            <input type="number" name="budget" id="budget" value="{{ old('budget') }}" min="1" required>
        </div>

        <div class="form-group">
            <label for="deadline">Deadline</label>
            <input type="date" name="deadline" id="deadline" value="{{ old('deadline') }}" required>
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" required>
                @foreach (['open', 'in_progress', 'completed', 'cancelled'] as $status)
                    <option value="{{ $status }}" @selected(old('status', 'open') === $status)>
                        {{ $status }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="actions">
            <button type="submit" class="btn btn-primary">Simpan Proyek</button>
            <a href="{{ route('projects.index') }}" class="btn">Kembali</a>
        </div>
    </form>
@endsection
