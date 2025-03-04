<?php

namespace App\Controllers;

use App\Models\Equipo;
use App\Models\Jugador;

class UpdateJugadorController
{
    public function get()
    {
        if (empty($_GET['id'])) {
            header('Location: ' . APP_URL .'/equipos');
            exit;
        }

        $jugador = Jugador::read($_GET['id']);
        $equipo = $jugador->equipo();

        return ['jugador.create', [
            'title' => 'Editar jugador ' . $jugador->nombre,
            'submit_text' => 'Guardar',
            'jugador' => $jugador,
            'equipo' => $equipo,
            'action' => APP_URL . '/jugador/edit',
            ]];
    }

    public function post()
    {
        if (empty($_POST['id'])) {
            header('Location: ' . APP_URL .'/equipos');
            exit;
        }

        $errors = $this->validatePost();
        
        if (count($errors) > 0) {
            foreach ($errors as $error) {
                flash($error);
            }
            header('Location: ' . APP_URL .'/jugador/edit?id=' . $_POST['id']);
            exit;
        }

        $jugador = Jugador::read($_POST['id']);
        $jugador->nombre = $_POST['nombre'];
        $jugador->numero = $_POST['numero'];
        $jugador->fecha_nacimiento = $_POST['fecha_nacimiento'] ?? null;
        $jugador->update();
        header('Location: ' . APP_URL .'/equipo?id=' . $jugador->equipo_id);
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
        
        if (empty($_POST['fecha_nacimiento'])) {
            $errors[] = 'El campo "fecha nacimiento" es obligatorio.';
        } elseif (strtotime($_POST['fecha_nacimiento']) === false) {
            $errors[] = 'El campo "fecha nacimiento" no es válido.';
        }

        return $errors;
    }
}
