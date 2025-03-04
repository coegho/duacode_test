<?php

return [
    "/" => App\Controllers\IndexController::class,
    "/equipo" => App\Controllers\ReadEquipoController::class,
    "/equipos" => App\Controllers\ListEquiposController::class,
    "/equipo/new" => App\Controllers\CreateEquipoController::class,
    "/equipo/edit" => App\Controllers\UpdateEquipoController::class,
];
