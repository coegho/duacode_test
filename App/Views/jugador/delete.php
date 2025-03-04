<html>
    <head>
        <title>Duacode - Prueba técnica PHP</title>
        <link rel="stylesheet" href="<?= APP_URL ?>/public/style.css" />
    </head>
    <body>
        <main>
            <h2>Confirma la operación</h2>
            <p>¿Estás seguro de que deseas borrar el jugador <?= $jugador->nombre ?>? Esta acción no es reversible.</p>

            <form method="post" action="<?= APP_URL ?>/jugador/delete">
                <input type="hidden" name="id" value="<?= $jugador->id ?>" />
                <button type="submit">Eliminar</button>
            </form>
        </main>
        <footer>
            <a href="<?=APP_URL ?>/equipo?id=<?= $jugador->equipo_id ?>">Volver al equipo</a>
        </footer>
    </body>
</html>
