@extends('layouts.app')

@section('title', 'Daftar Proyek - GarudaHub')

@section('content')
    <h2>Daftar Proyek</h2>

    <table>
        <thead>
            <tr>
                <th>Judul Proyek</th>
                <th>Client</th>
                <th>Budget</th>
                <th>Deadline</th>
                <th>Status</th>
                <th>Bids</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($projects as $project)
                <tr>
                    <td>
                        <a href="{{ route('projects.show', $project) }}"><strong>{{ $project->title }}</strong></a>
                    </td>
                    <td>{{ $project->client->name ?? '-' }}</td>
                    <td>Rp {{ number_format($project->budget, 0, ',', '.') }}</td>
                    <td>{{ $project->deadline->format('d M Y') }}</td>
                    <td>{{ $project->status }}</td>
                    <td>{{ $project->bids_count }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('projects.show', $project) }}" class="btn">Detail</a>
                            <a href="{{ route('projects.edit', $project) }}" class="btn">Edit</a>
                            <form action="{{ route('projects.destroy', $project) }}" method="POST" onsubmit="return confirm('Hapus proyek ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Belum ada data proyek.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
