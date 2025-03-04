<html>
    <head>
        <title>Duacode - Prueba técnica PHP</title>
        <link rel="stylesheet" href="<?= APP_URL ?>/public/style.css" />
    </head>
    <body>
        <main>
            <h2>Listado de equipos</h2>
            <ul>
                <?php foreach ($equipos as $equipo): ?>
                <li><a href="equipo?id=<?= $equipo->id ?>" ><?= $equipo->nombre ?></a></li>
                <?php endforeach; ?>
            </ul>
        </main>
        <footer>
            <a href="<?=APP_URL ?>/equipo/new">Crear un equipo</a>
            <a href="<?= APP_URL ?>">Volver a inicio</a>
        </footer>
    </body>
</html>