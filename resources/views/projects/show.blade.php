@extends('layouts.app')

@section('title', $project->title . ' - GarudaHub')

@section('content')
    <h2>{{ $project->title }}</h2>

    <p><strong>Client:</strong> {{ $project->client->name ?? '-' }}</p>
    <p><strong>Budget:</strong> Rp {{ number_format($project->budget, 0, ',', '.') }}</p>
    <p><strong>Deadline:</strong> {{ $project->deadline->format('d M Y') }}</p>
    <p><strong>Status:</strong> {{ $project->status }}</p>
    <p><strong>Deskripsi:</strong></p>
    <p>{{ $project->description }}</p>

    <div class="actions" style="margin-top: 16px; margin-bottom: 24px;">
        <a href="{{ route('projects.edit', $project) }}" class="btn btn-primary">Edit Proyek</a>
        <a href="{{ route('projects.index') }}" class="btn">Kembali ke Daftar</a>
    </div>

    <h3>Daftar Penawaran (Bids)</h3>
    <table>
        <thead>
            <tr>
                <th>Freelancer</th>
                <th>Harga Ditawarkan</th>
                <th>Estimasi</th>
                <th>Proposal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($project->bids as $bid)
                <tr>
                    <td>{{ $bid->freelancer->name ?? '-' }}</td>
                    <td>Rp {{ number_format($bid->offered_price, 0, ',', '.') }}</td>
                    <td>{{ $bid->estimated_days }} hari</td>
                    <td>{{ $bid->proposal }}</td>
                    <td>{{ $bid->status }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">Belum ada penawaran masuk untuk proyek ini.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
