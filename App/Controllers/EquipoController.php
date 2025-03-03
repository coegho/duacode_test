<?php

namespace App\Controllers;

use App\Models\Equipo;

class EquipoController
{
    public function get()
    {
        if (empty($_GET['id'])) {
            header('Location: equipos');
            exit;
        }

        $equipo = Equipo::read($_GET['id']);
        if (is_null($equipo)) {
            \http_response_code(404);
            exit;
        }
        return ['equipo.data', ['equipo' => $equipo]];
    }
}
