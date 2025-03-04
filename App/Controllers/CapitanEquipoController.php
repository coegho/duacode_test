<?php

namespace App\Controllers;

use App\Models\Equipo;
use App\Models\Jugador;

class CapitanEquipoController
{
    public function get()
    {
        if (empty($_GET['id']) || empty($_GET['jugador_id'])) {
            header('Location: ' . APP_URL .'/equipos');
            exit;
        }

        $equipo = Equipo::read($_GET['id']);
        if (empty($equipo)) {
            header('Location: ' . APP_URL .'/equipos');
            exit;
        }

        $jugador = Jugador::read($_GET['jugador_id']);
        if (empty($jugador)) {
            header('Location: ' . APP_URL .'/equipos');
            exit;
        }

        if ($jugador->equipo_id !== $equipo->id) {
            flash('El jugador no forma parte de este equipo.');
            header('Location: ' . APP_URL .'/equipo?id=' . $equipo->id);
            exit;
        }

        $equipo->capitan_id = $jugador->id;
        $equipo->update();
        header('Location: ' . APP_URL .'/equipo?id=' . $equipo->id);
        exit;
    }
}
