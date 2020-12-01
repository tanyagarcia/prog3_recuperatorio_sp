<?php
namespace App\Middlewares;

use Slim\Psr7\Response as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use App\Models\Turno;
use \Firebase\JWT\JWT;

class GenerarTurnoMiddleware
{
    public function __invoke(Request $request, RequestHandler $handler): Response
    {
        $headers = $request->getParsedBody();
        $token = getallheaders();
        $token = $token['token'] ?? '';
        $resp = new Response();

        if(isset($token) && $token !="")
        {
            try
            {
                $decoded = JWT::decode($token, 'usuario', array('HS256'));
                
                if($decoded->tipo == "cliente")
                {
                    if ((isset($headers['tipo']) && $headers['tipo']!="") 
                    && (isset($headers['fecha']) && $headers['fecha']!=""))
                    {
                        $tipo = strtolower($headers['tipo']);
                        if($tipo == "perro" || $tipo == "gato" || $tipo == "huron")
                        {
                            $response = $handler->handle($request);
                            $existingContent = (string) $response->getBody();
                            $resp->getBody()->write($existingContent);
                        }
                    }
                }
                else
                {
                    $array = array(
                    "status" =>"fail",
                    "message" => "No es un tipo de usuario válido");
                    $resp->getBody()->write(json_encode($array));
                }  
            }
            catch(\Throwable $th)
            {
                echo $th->getMessage();
            }
        }

        return $resp->withHeader('Content-type', 'application/json');
    }



}