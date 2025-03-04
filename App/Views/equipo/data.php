<html>
    <head>
        <title>Duacode - Prueba técnica PHP</title>
        <link rel="stylesheet" href="<?= APP_URL ?>/public/style.css" />
    </head>
    <body>
        <main>
            <?php foreach (flash() as $error): ?>
                <p><?= $error ?></p>
            <?php endforeach; ?>

            <h1><?= $equipo->nombre ?></h1>
            <?php if (!empty($capitan)): ?>
                <p>Capitán: <?= $capitan->nombre ?></p>
            <?php endif; ?>
            <p>Deporte: <?= $equipo->deporte() ?></p>
            <?php if (!empty($equipo->ciudad)): ?>
                <p>Ciudad: <?= $equipo->ciudad ?></p>
            <?php endif; ?>
            <p>Fecha creación: <?= $equipo->fecha_creacion ?></p>
            <a href="<?= APP_URL ?>/equipo/edit?id=<?= $_GET['id'] ?>">Editar equipo</a>
            <hr/>
            <h3>Jugadores</h3>
            <table>
                <tr>
                    <th>Nombre</th>
                    <th>Edad</th>
                    <th>Número</th>
                    <th>Acciones</th>
                </tr>
                <?php foreach ($equipo->jugadores() as $jugador): ?>
                    <tr>
                        <td><?= $jugador->nombre ?></td>
                        <td><?= $jugador->edad() ?></td>
                        <td><?= $jugador->numero ?></td>
                        <td>
                            <?php if (empty($capitan) || $capitan->id !== $jugador->id): ?>
                                <a href="<?= APP_URL ?>/equipo/capitan?id=<?= $equipo->id ?>&jugador_id=<?= $jugador->id ?>">Hacer capitán</a>
                            <?php endif; ?>
                            <a href="<?= APP_URL ?>/jugadores/edit?id=<?= $jugador->id ?>">Editar</a>
                            <a style="background-color: #a00000; color: white;" href="<?= APP_URL ?>/jugadores/delete?id=<?= $jugador->id ?>">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </main>
        <footer>
            <a href="<?=APP_URL ?>/equipos">Volver al listado</a>
        </footer>
    </body>
</html>
