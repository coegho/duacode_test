<?php

namespace App\Controllers;

use App\Models\Equipo;

class ListEquiposController
{
    public function get()
    {
        $equipos = Equipo::all();
        return ['equipo.list', ['equipos' => $equipos]];
    }
}
