@extends('layouts.app')

@section('title', 'Login - GarudaHub')

@section('content')
    <h2>Login GarudaHub</h2>

    <form action="{{ route('login.attempt') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>

        <div class="actions">
            <button type="submit" class="btn btn-primary">Masuk</button>
        </div>
    </form>

    <p style="margin-top: 16px; font-size: 14px; color: #4b5563;">
        Akun dummy seeder: <code>client@garudahub.test</code> / password: <code>password</code>
    </p>
@endsection
