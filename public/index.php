<?php

require_once __DIR__ . '/../vendor/autoload.php';

use app\Router;
use app\Controllers\TicketController;


$router = new Router();
// Ticket Routes
$router->get('/', [TicketController::class, 'dashboard']);
$router->get('/tickets', [TicketController::class, 'index']);
$router->get('/tickets/view', [TicketController::class, 'view']);
$router->post('/tickets/view', [TicketController::class, 'view']);
$router->get('/tickets/create', [TicketController::class, 'create']);
$router->post('/tickets/create', [TicketController::class, 'create']);
$router->get('/tickets/update', [TicketController::class, 'update']);
$router->post('/tickets/update', [TicketController::class, 'update']);
$router->post('/tickets/delete', [TicketController::class, 'delete']);


$router->resolve();
