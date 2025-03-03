<html>
    <head>
        <title>Duacode - Prueba técnica PHP</title>
    </head>
    <body>
        <ul>
            <?php foreach ($equipos as $equipo): ?>
            <li><?= $equipo->nombre ?></li>
            <?php endforeach; ?>
        </ul>
    </body>
</html>