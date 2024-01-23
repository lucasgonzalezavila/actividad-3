<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
</head>
<body>
    <h1>Perfil de Usuario</h1>
    <a href="edit">Ajustes</a>
    
    <?php if ($user): ?>
        <p>ID: <?= $user->id ?></p>
        <p>Nombre: <?= $user->username ?></p>
        <p>Correo: <?= $user->email ?></p>
        <p>Role: <?= $user->role ?></p>
    <?php else: ?>
        <p>No se encontraron datos de usuario.</p>
    <?php endif; ?>
</body>
</html>
