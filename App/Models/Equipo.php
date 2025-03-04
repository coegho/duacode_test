<?php

namespace App\Models;

use App\Models\Model;

class Equipo extends Model
{
    const PRIMARY_KEY = 'id';
    const TABLE_NAME = 'Equipos';

    public $id;
    public $nombre;
    public $ciudad;
    public $deporte;
    public $fecha_creacion;

    public function deporte(): ?string
    {
        if (empty($this->deporte)) {
            return null;
        }
        static $deportes = null;
        if (empty($deportes)) {
            $deportes = require_once 'config/deportes.php';
        }
        return $deportes[$this->deporte];
    }

    public function jugadores(): array
    {
        if (empty($this->id)) {
            return [];
        }
        return Jugador::buscarPorEquipo($this->id);
    }

    public function capitan(): ?Jugador
    {
        $jugadores = $this->jugadores();
        foreach ($jugadores as $jugador) {
            if ($jugador->capitan) {
                return $jugador;
            }
        }
        return null;
    }
}
