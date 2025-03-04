<?php

namespace App\Controllers;

use App\Models\Equipo;
use App\Models\Jugador;

class DeleteJugadorController
{
    public function get()
    {
        if (empty($_GET['id'])) {
            header('Location: ' . APP_URL .'/equipos');
            exit;
        }

        
        $jugador = Jugador::read($_GET['id']);
        if (empty($jugador)) {
            header('Location: ' . APP_URL .'/equipos');
            exit;
        }

        return ['jugador.delete', ['jugador' => $jugador]];
    }

    public function post()
    {
        if (empty($_POST['id'])) {
            header('Location: ' . APP_URL .'/equipos');
            exit;
        }

        
        $jugador = Jugador::read($_POST['id']);
        if (empty($jugador)) {
            header('Location: ' . APP_URL .'/equipos');
            exit;
        }

        $equipo = $jugador->equipo();

        if (!empty($equipo) && $equipo->capitan_id === $jugador->id) {
            $equipo->capitan_id = null;
            $equipo->update();
        }

        $jugador->delete();

        flash('Se ha eliminado correctamente el jugador ' . $jugador->nombre . '.');
        header('Location: ' . APP_URL . '/equipo?id=' . $jugador->equipo_id);
        exit;
    }
}
