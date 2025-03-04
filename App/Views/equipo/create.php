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
                <input required type="text" id="nombre" name="nombre" placeholder="Nombre..." maxlength="128" value="<?= $equipo?->nombre ?>" />
                <label for="ciudad">Ciudad:</label>
                <input type="text" id="ciudad" name="ciudad" placeholder="Ciudad..." maxlength="128" value="<?= $equipo?->ciudad ?>" />
                <label for="deporte">Deporte*:</label>
                <select required id="deporte" name="deporte">
                    <option value>Selecciona deporte...</option>
                    <?php foreach ($deportes as $id => $deporte): ?>
                        <option value="<?= $id ?>"  <?php if ($equipo?->deporte === $id): ?> selected <?php endif; ?> ><?= $deporte ?></option>
                    <?php endforeach; ?>
                </select>
                <label required for="fecha_creacion">Fecha de creación*:</label>
                <input type="date" id="fecha_creacion" name="fecha_creacion" max="<?= date('Y-m-d') ?>" value="<?= $equipo?->fecha_creacion ?>" />
                <?php if (!empty($_GET['id'])): ?> <input type="hidden" value="<?= $_GET['id'] ?>" name="id" /> <?php endif; ?>
                <button type="submit"><?= $submit_text ?></button>
            </form>
        </main>
        <footer>
            <a href="<?=APP_URL ?>/equipos">Volver al listado</a>
        </footer>
    </body>
</html>
