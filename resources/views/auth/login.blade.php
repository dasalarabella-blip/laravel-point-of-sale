<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>POS Login</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <main>
        @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-error">
        {{ $errors->first() }}
    </div>
@endif
        <form
            class="form-card login-card"
            method="POST"
            action="{{ url('/login') }}"
        >
            @csrf

            <h1>Staff Login</h1>
            <p>Sign in to access the point-of-sale system.</p>

            <div class="form-group">
                <label for="username">Username</label>

                <input
                    id="username"
                    name="username"
                    type="text"
                    value="{{ old('username') }}"
                    required
                    autofocus
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    required
                >
            </div>

            <button class="button" type="submit">
                Log In
            </button>
        </form>
    </main>
</body>
</html>