<html>
    <head>
        <title>Duacode - Prueba técnica PHP</title>
    </head>
    <body>
        <?php foreach (flash() as $error): ?>
            <p><?= $error ?></p>
        <?php endforeach; ?>

        <h2>Crear un nuevo equipo</h2>
        <form method="post" action="<?= $action ?>">
            <label for="nombre">Nombre*:</label>
            <input required type="text" id="nombre" name="nombre" placeholder="Nombre..." maxlength="128"/>
            <label for="ciudad">Ciudad:</label>
            <input type="text" id="ciudad" name="ciudad" placeholder="Ciudad..." maxlength="128"/>
            <label for="deporte">Deporte*:</label>
            <select required id="deporte" name="deporte">
                <option value>Selecciona deporte...</option>
                <?php foreach ($deportes as $id => $deporte): ?>
                    <option value="<?= $id ?>"><?= $deporte ?></option>
                <?php endforeach; ?>
            </select>
            <label required for="fecha_creacion">Fecha de creación*:</label>
            <input type="date" id="fecha_creacion" name="fecha_creacion" max="<?= date('Y-m-d') ?>" />
            <button type="submit">Crear</button>
        </form>
    </body>
</html>
