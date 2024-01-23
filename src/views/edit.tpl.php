<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Perfil</title>
</head>
<body>
    <?php if (isset($user)): ?>
        <h1>Editar Perfil</h1>
        
        <form method="post" action="/edit">
            <label for="password">Nueva Contraseña:</label>
            <input type="password" name="password" required>
            <label for="repeat_password">Repetir Contraseña:</label>
            <input type="password" name="repeat_password" required>
            <button type="submit">Cambiar Contraseña</button>
        </form>
    <?php else: ?>
        <p>Usuario no encontrado.</p>
    <?php endif; ?>
</body>
</html>
