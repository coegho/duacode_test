<html>
    <head>
        <title>Duacode - Prueba técnica PHP</title>
    </head>
    <body>
        <ul>
            <?php foreach ($equipos as $equipo): ?>
            <li><a href="equipo?id=<?= $equipo->id ?>" ><?= $equipo->nombre ?></a></li>
            <?php endforeach; ?>
        </ul>
    </body>
</html>