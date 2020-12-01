<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\User;
use App\Models\Mascota;
use App\Models\Turno;
use \Firebase\JWT\JWT;

class TurnoController
{

    public function generarTurnoMascota(Request $request, Response $response, $args)
    {
        $headers = getallheaders();
        $token = $headers['token'];
        
        try
        {
            $decoded = JWT::decode($token, 'usuario', array('HS256'));
        }
        catch(\Throwable $th)
        {
            echo $th->getMessage();
        }
       
        $email = $decoded->email;
        $usuarioEncontrado = json_decode(User::where('email', $email)
        ->get());

        $respuesta = $request->getParsedBody();
        $tipo_mascota = $respuesta['tipo'];
        $fecha_turno = $respuesta['fecha'];
        $mascotaTurno = json_decode(Mascota::where('tipo_mascota', $tipo_mascota)
        ->get());

        if($mascotaTurno != [])
        {
            $turno = new Turno;
            $turno->id_cliente = $usuarioEncontrado[0]->id;
            $turno->id_mascota = $mascotaTurno[0]->id_mascota;
            $turno->save();
            
            $registroOk = Mascota::where('tipo_mascota', $tipo_mascota)
            ->update(['turno' => 1]);

            $registroOk2 = Mascota::where('tipo_mascota', $tipo_mascota)
            ->update(['fecha_turno' => $fecha_turno]);
        }


        if($registroOk == 1 && $registroOk2 == 1)
        {
            $array = array("status" =>"success",
            "message" => "Turno registrado");
            $response->getBody()->write(json_encode($array));
        }
        else{
            $array = array(
                "status" =>"fail",
                "message" => "No se encontró mascota o ya tiene turno");
            $response->getBody()->write(json_encode($array));
        }

        $response->withHeader('Content-type', 'application/json');
        return $response;
    }

}
    
?>
