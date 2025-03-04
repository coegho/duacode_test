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

            <h2><?= $title ?></h2>
            <form method="post" action="<?= $action ?>">
                <label for="nombre">Nombre*:</label>
                <input required type="text" id="nombre" name="nombre" placeholder="Nombre..." maxlength="128" value="<?= $jugador?->nombre ?>" />
                <label required for="numero">Número*:</label>
                <input required type="number" id="numero" name="numero" placeholder="Número..." min="1" max="100" step="1" value="<?= $jugador?->numero ?>" />
                <label for="fecha_nacimiento">Fecha de nacimiento:</label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" max="<?= date('Y-m-d', strtotime('16 years ago')) ?>" value="<?= $jugador?->fecha_nacimiento ?>" />
                <?php if (!empty($_GET['id'])): ?> <input type="hidden" value="<?= $_GET['id'] ?>" name="id" /> <?php endif; ?>
                <?php if (!empty($jugador?->equipo_id)): ?> <input type="hidden" value="<?= $jugador?->equipo_id ?>" name="equipo_id" />
                <?php elseif (!empty($_GET['equipo_id'])): ?> <input type="hidden" value="<?= $_GET['equipo_id'] ?>" name="equipo_id" /> <?php endif; ?>
                <button type="submit"><?= $submit_text ?></button>
            </form>
        </main>
        <footer>
            <a href="<?=APP_URL ?>/equipo?id=<?= $equipo->id ?>">Volver al equipo</a>
        </footer>
    </body>
</html>
