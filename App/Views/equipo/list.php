<html>
    <head>
        <title>Duacode - Prueba técnica PHP</title>
    </head>
    <body>
        <h2>Listado de equipos</h2>
        <ul>
            <?php foreach ($equipos as $equipo): ?>
            <li><a href="equipo?id=<?= $equipo->id ?>" ><?= $equipo->nombre ?></a></li>
            <?php endforeach; ?>
        </ul>
        <a href="<?=APP_URL ?>/equipo/new">Crear un equipo</a>
        <a href="<?= APP_URL ?>">Volver a inicio</a>
    </body>
</html>