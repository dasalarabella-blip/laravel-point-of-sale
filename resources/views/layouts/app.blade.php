<!DOCTYPE html>
<html>
<head>
    <title>{{ $title ?? 'Point of Sale System' }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ filemtime(public_path('css/style.css')) }}">
</head>
<body>

<nav>
    <a href="{{ route('products.index') }}">Products</a>
    <a href="{{ route('customers.index') }}">Customers</a>
    <a href="{{ route('users.index') }}">Staff</a>
    <a href="{{ route('sales.create') }}">Record Sale</a>
    <a href="{{ route('sales.history') }}">Sales History</a>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
</nav>

<main>
    @yield('content')
</main>

</body>
</html>