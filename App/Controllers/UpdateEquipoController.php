<?php

namespace App\Controllers;

use App\Models\Equipo;

class UpdateEquipoController
{
    public function get()
    {
        if (empty($_GET['id'])) {
            header('Location: ' . APP_URL .'/equipos');
            exit;
        }

        $equipo = Equipo::read($_GET['id']);

        $deportes = require 'config/deportes.php';

        return ['equipo.create', [
            'deportes' => $deportes,
            'title' => 'Editar equipo ' . $equipo->nombre,
            'submit_text' => 'Guardar',
            'equipo' => $equipo,
            'action' => APP_URL . '/equipo/edit',
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
            header('Location: ' . APP_URL .'/equipo/edit?id=' . $_POST['id']);
            exit;
        }

        $equipo = Equipo::read($_POST['id']);
        $equipo->nombre = $_POST['nombre'];
        $equipo->ciudad = $_POST['ciudad'] ?? null;
        $equipo->deporte = $_POST['deporte'];
        $equipo->fecha_creacion = $_POST['fecha_creacion'];
        $equipo->update();
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

        if (empty($_POST['deporte'])) {
            $errors[] = 'El campo "deporte" es obligatorio.';
        } elseif (strlen($_POST['deporte']) > 128) {
            $errors[] = 'El campo "deporte" tiene un tamaño máximo de 128 caracteres.';
        }

        if (!empty($_POST['ciudad']) && strlen($_POST['ciudad']) > 128) {
            $errors[] = 'El campo "ciudad" tiene un tamaño máximo de 128 caracteres.';
        }
        
        if (empty($_POST['fecha_creacion'])) {
            $errors[] = 'El campo "fecha creación" es obligatorio.';
        } elseif (strtotime($_POST['fecha_creacion']) === false) {
            $errors[] = 'El campo "fecha creación" no es válido.';
        }

        return $errors;
    }
}
