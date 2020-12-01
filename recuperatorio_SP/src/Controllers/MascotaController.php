<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Mascota;

class MascotaController
{
    public function agregarMascota(Request $request, Response $response, $args)
    {
        
        $respuesta = $request->getParsedBody();
        $mascota = new Mascota;
        $mascota->tipo_mascota = $respuesta['tipo'];
        $mascota->precio_mascota = $respuesta['precio'];
        $mascota->save();
        $rta = json_encode(array("status" => "success",
        "message" => "ok"));
        $response->getBody()->write($rta);
        $response->withHeader('Content-type', 'application/json');
        return $response;
        
    }
   
}