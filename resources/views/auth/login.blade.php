<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
<body>
    <div class="main">
        <h1>Login</h1>
    
        @if ($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    
        <form method="POST" action="{{ url('/login') }}">
        @csrf
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="email@example.com" value="{{ old('email') }}" required>
    
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="******" required>
    
            <button type="submit">Login</button>
            <p>¿Aun no tines cuenta? <a href="{{ route('register') }}">Registrate</a></p>
        </form>
    </div>

</body>
</html>
