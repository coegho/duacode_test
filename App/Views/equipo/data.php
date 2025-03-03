<html>
    <head>
        <title>Duacode - Prueba técnica PHP</title>
    </head>
    <body>
        <h1><?= $equipo->nombre ?></h1>
        <h2><?= $equipo->deporte() ?></h2>
        <?php if (!empty($equipo->ciudad)): ?>
            <p>Ciudad: <?= $equipo->ciudad ?></p>
        <?php endif; ?>
        <p>Fecha creación: <?= $equipo->fecha_creacion ?></p>
        <a href="equipos">Volver al listado</a>
    </body>
</html>
