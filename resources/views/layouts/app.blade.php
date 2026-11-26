<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'GarudaHub')</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 24px; background: #f8f9fa; color: #1f2937; }
        .container { max-width: 960px; margin: 0 auto; background: #fff; padding: 24px; border-radius: 8px; border: 1px solid #e5e7eb; }
        .topbar { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding-bottom: 12px; border-bottom: 1px solid #e5e7eb; }
        .topbar a { text-decoration: none; color: #111827; font-weight: bold; }
        .btn { display: inline-block; padding: 8px 14px; border-radius: 6px; border: 1px solid #d1d5db; background: #fff; color: #111827; text-decoration: none; font-size: 14px; cursor: pointer; }
        .btn-primary { background: #1d4ed8; border-color: #1d4ed8; color: #fff; }
        .btn-danger { background: #dc2626; border-color: #dc2626; color: #fff; }
        table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        th, td { padding: 10px; border-bottom: 1px solid #e5e7eb; text-align: left; vertical-align: top; }
        th { background: #f3f4f6; }
        .form-group { margin-bottom: 14px; }
        label { display: block; font-weight: bold; margin-bottom: 6px; }
        input, select, textarea { width: 100%; padding: 8px 10px; border: 1px solid #d1d5db; border-radius: 6px; box-sizing: border-box; }
        .alert-success { padding: 12px; background: #dcfce7; border: 1px solid #86efac; color: #166534; border-radius: 6px; margin-bottom: 16px; }
        .alert-error { padding: 12px; background: #fee2e2; border: 1px solid #fca5a5; color: #991b1b; border-radius: 6px; margin-bottom: 16px; }
        .actions { display: flex; gap: 6px; flex-wrap: wrap; }
    </style>
</head>
<body>
    <div class="container">
        <div class="topbar">
            <a href="{{ route('projects.index') }}">GarudaHub Projects</a>
            <div class="actions">
                @auth
                    <span>{{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
                    <a href="{{ route('projects.create') }}" class="btn btn-primary">+ Tambah Proyek</a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                @endauth
            </div>
        </div>

        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert-error">
                <strong>Periksa kembali input kamu:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>
