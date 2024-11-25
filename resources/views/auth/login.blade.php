<!DOCTYPE html>
<html>
<head>
    <title>Iniciar Sesión</title>
</head>
<body>
    <h1>Bienvenido a la Aplicación</h1>
    <form action="#" method="POST">
        @csrf
        <div>
            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username" disabled>
        </div>
        <div>
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" disabled>
        </div>
        <button type="submit" disabled>Iniciar Sesión</button>
    </form>

    <p>O</p>

    <a href="{{ route('login') }}">
        <button>Iniciar Sesión con Microsoft</button>
    </a>
</body>
</html>
