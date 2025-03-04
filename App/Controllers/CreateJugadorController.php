<?php

namespace App\Controllers;

use App\Models\Equipo;
use App\Models\Jugador;

class CreateJugadorController
{
    public function get()
    {
        if (empty($_GET['equipo_id'])) {
            header('Location: ' . APP_URL .'/equipos');
            exit;
        }

        $equipo = Equipo::read($_GET['equipo_id']);

        return ['jugador.create', [
            'title' => 'Crear un nuevo jugador',
            'submit_text' => 'Crear',
            'equipo' => $equipo,
            'jugador' => null,
            'action' => APP_URL . '/jugador/new',
            ]];
    }

    public function post()
    {
        $errors = $this->validatePost();
        
        if (empty($_POST['equipo_id'])) {
            header('Location: ' . APP_URL .'/equipos');
            exit;
        }

        $equipo = Equipo::read($_POST['equipo_id']);

        if (empty($equipo)) {
            header('Location: ' . APP_URL .'/equipos');
            exit;
        }

        if (count($errors) > 0) {
            foreach ($errors as $error) {
                flash($error);
            }
            header('Location: ' . APP_URL .'/jugador/new?equipo_id=' . $_POST['equipo_id']);
            exit;
        }

        $jugador = new Jugador;
        $jugador->nombre = $_POST['nombre'];
        $jugador->numero = $_POST['numero'];
        $jugador->fecha_nacimiento = $_POST['fecha_nacimiento'] ?? null;
        $jugador->equipo_id = $equipo->id;
        $jugador->create();
        flash('Jugador creado correctamente.');
        header('Location: ' . APP_URL .'/equipo?id=' . $equipo->id);
        exit;
    }

    private function validatePost(): array
    {
        $errors = [];
        if (empty($_POST['nombre'])) {
            $errors[] = 'El campo "nombre" es obligatorio.';
        } elseif (strlen($_POST['nombre']) > 128) {
            $errors[] = 'El campo "nombre" tiene un tamaño máximo de 128 caracteres.';
        }

        if (empty($_POST['numero'])) {
            $errors[] = 'El campo "número" es obligatorio.';
        } elseif (!is_numeric($_POST['numero'])) {
            $errors[] = 'El campo "número" debe ser un valor numérico.';
        } elseif ($_POST['numero'] > 100 || $_POST['numero'] < 1) {
            $errors[] = 'El campo "número" tiene un valor mínimo de 1 y máximo de 100.';
        }
        
        if (!empty($_POST['fecha_nacimiento']) && strtotime($_POST['fecha_nacimiento']) === false) {
            $errors[] = 'El campo "fecha nacimiento" no es válido.';
        }

        return $errors;
    }
}
