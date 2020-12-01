<?php


use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\ServerHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Factory\AppFactory;
use Config\Database;
use App\Controllers\UserController;
use App\Controllers\MascotaController;
use App\Controllers\TurnoController;
use Slim\Routing\RouteCollectorProxy;
use App\Middlewares\JsonMiddleware;
use App\Middlewares\RegistrarUsuarioMiddleware;
use App\Middlewares\LoginMiddleware;
use App\Middlewares\RegistrarMascotaMiddleware;
use App\Middlewares\GenerarTurnoMiddleware;


require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$app->setBasePath('/recuperatorio_SP/public');

new Database;

$app->group('/users', function(RouteCollectorProxy $group)
{
    $group->post('', UserController::class. ":agregarUsuario")->add(new RegistrarUsuarioMiddleware());

})->add(new JsonMiddleware());

$app->post('/login', UserController::class. ":login")->add(new LoginMiddleware())->add(new JsonMiddleware());

$app->post('/mascota', MascotaController::class. ":agregarMascota")->add(new RegistrarMascotaMiddleware())->add(new JsonMiddleware());

$app->post('/turno', TurnoController::class. ":generarTurnoMascota")->add(new GenerarTurnoMiddleware())->add(new JsonMiddleware());

//$app->get('/turnos', MascotaController::class. ":generarTurnoMascota")->add(new GenerarTurnoMiddleware())->add(new JsonMiddleware());



$app->addBodyParsingMiddleware();
$app->run();

?>

