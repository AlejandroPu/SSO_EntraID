<!DOCTYPE html>
<html>
<head>
    <title>Página de Inicio</title>
</head>
<body>
    <h1>Bienvenido, {{ Auth::user()->name }}</h1>
    <p>Has iniciado sesión con éxito.</p>
    <!-- Botón de Cerrar Sesión -->
	<form action="{{ route('logout') }}" method="POST">
		@csrf
		<button type="submit">Cerrar Sesión</button>
	</form>
</body>
</html>
