<?php

namespace App\Models;

use App\Models\Model;
use \DateTime;
use \PDO;

class Jugador extends Model
{
    const PRIMARY_KEY = 'id';
    const TABLE_NAME = 'Jugadores';

    public $id;
    public $nombre;
    public $numero;
    public $capitan;
    public $fecha_nacimiento;

    public function edad(): ?int
    {
        if (empty($this->fecha_nacimiento)) {
            return null;
        }
        $fechaNac = new DateTime($this->fecha_nacimiento);
        $now = new DateTime();
        return $now->diff($fechaNac)->y;
    }

    public function equipo(): ?Equipo
    {
        if (empty($this->equipo_id)) {
            return null;
        }
        return Equipo::read($this->equipo_id);
    }

    public static function buscarPorEquipo(int $equipo_id): array
    {
        $sth = db()->prepare('SELECT * FROM ' . static::getTableName() . ' WHERE equipo_id = :equipo_id');
        $sth->execute(['equipo_id' => $equipo_id]);
        $sth->setFetchMode(PDO::FETCH_CLASS, \get_called_class());
        $model = $sth->fetchAll();
        if ($model) return $model;
        else return [];
    }
}
