<?php

namespace App\Controllers;

use App\Models\Equipo;

class CreateEquipoController
{
    public function get()
    {
        $deportes = require 'config/deportes.php';

        return ['equipo.create', [
            'deportes' => $deportes,
            'title' => 'Crear un nuevo equipo',
            'submit_text' => 'Crear',
            'action' => APP_URL . '/equipo/new',
            'equipo' => null,
            ]];
    }

    public function post()
    {
        $errors = $this->validatePost();
        
        if (count($errors) > 0) {
            foreach ($errors as $error) {
                flash($error);
            }
            header('Location: ' . APP_URL .'/equipo/new');
            exit;
        }

        $equipo = new Equipo;
        $equipo->nombre = $_POST['nombre'];
        $equipo->ciudad = $_POST['ciudad'] ?? null;
        $equipo->deporte = $_POST['deporte'];
        $equipo->fecha_creacion = $_POST['fecha_creacion'];
        $equipo->create();
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
