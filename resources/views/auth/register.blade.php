<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">
<body>
    <div class="main">

        <h1>Register</h1>
    
        @if ($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    
        <form method="POST" action="{{ url('/register') }}">
            @csrf
    
            <label for="name">Name</label>
            <input type="text" name="name" id="name" placeholder="Juan Torres" value="{{ old('name') }}" required>
    
            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="email@example.com" value="{{ old('email') }}" required>
    
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="********" required>
    
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="********" required>
    
            <button type="submit">Register</button>
            <p>¿Ya tines una cuenta? <a href="{{ route('login') }}">Inicia sesión</a></p>
        </form>
    </div>
</body>
</html>
