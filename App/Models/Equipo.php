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
    public $capitan_id;

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

    public function capitan(): ?Jugador
    {
        if (empty($this->capitan_id)) {
            return null;
        }
        return Jugador::read($this->capitan_id);
    }

    public function jugadores(): array
    {
        if (empty($this->id)) {
            return [];
        }
        return Jugador::buscarPorEquipo($this->id);
    }
}
