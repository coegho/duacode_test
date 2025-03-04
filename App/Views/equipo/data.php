<html>
    <head>
        <title>Duacode - Prueba técnica PHP</title>
        <link rel="stylesheet" href="<?= APP_URL ?>/public/style.css" />
    </head>
    <body>
        <main>
            <h1><?= $equipo->nombre ?></h1>
            <p>Deporte: <?= $equipo->deporte() ?></p>
            <?php if (!empty($equipo->ciudad)): ?>
                <p>Ciudad: <?= $equipo->ciudad ?></p>
            <?php endif; ?>
            <p>Fecha creación: <?= $equipo->fecha_creacion ?></p>
            <a href="<?= APP_URL ?>/equipo/edit?id=<?= $_GET['id'] ?>">Editar</a>
        </main>
        <footer>
            <a href="<?=APP_URL ?>/equipos">Volver al listado</a>
        </footer>
    </body>
</html>
