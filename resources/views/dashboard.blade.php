<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>

    <!-- Vincular archivo CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>
    <nav class="navbar">
        <h1 class="nav-item">Bienvenido {{ auth()->user()->name }}</h1>
        <form class="nav-item" action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button class="nav-button" type="submit">Cerrar sesión</button>
        </form>
    </nav>

    @if(session('success'))
        <p style="color: green">{{ session('success') }}</p>
    @endif
    <div class="content">
        <div class="container">
            <form action="{{ route('dashboard.store') }}" method="POST">
                @csrf
                <input class="title-input" type="text" name="title" placeholder="Título" required class="input-text"><br>
                <textarea  name="message" placeholder="Mensaje" rows="4" required></textarea><br>
                <button class="send-message" type="submit">Publicar</button>
            </form>
        </div>
        <div style="width:100%">
            <h2>Publicaciones recientes</h2>

            <div class="card-container">
                @foreach($publications as $pub)
                    <div class="card">
                        <h2 class="h2-name">{{ $pub->user->name ?? 'Usuario desconocido' }}</h2>
                        <h3>{{ $pub->title }}</h3>
                        <p class="message">{{ $pub->message }}</p>
                        <small>{{ $pub->created_at }}</small><br>
            
                        @if ($pub->iduser_fk === auth()->id())
                            <form action="{{ route('publication.destroy', $pub->id_publication) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="del-button" type="submit" onclick="return confirm('¿Seguro que deseas eliminar esta publicación?')"><i class="fas fa-trash-alt"></i></button>
                            </form>
                            <a class="edit-button" href="{{ route('publication.edit', $pub->id_publication) }}"><i class="fas fa-edit"></i></a>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>
