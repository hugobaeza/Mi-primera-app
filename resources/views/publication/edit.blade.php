<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Publicación</title>
</head>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<body>
    <div class="container">
        <h1>Editar Publicación</h1>
        <!-- Mostrar mensaje de éxito -->
        @if(session('success'))
            <p style="color: green">{{ session('success') }}</p>
        @endif
    
        <form action="{{ route('publication.update', $publication->id_publication) }}" method="POST">
            @csrf
            @method('PUT')
    
            <div>
                <input type="text" name="title" id="title" value="{{ $publication->title }}" required>
            </div>
    
            <div>
                <textarea name="message" id="message" rows="4" required>{{ $publication->message }}</textarea>
            </div>
    
            <button type="submit">Actualizar Publicación</button>
        </form>
    
        <br>
        <a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a>
    </div>
</body>
</html>
