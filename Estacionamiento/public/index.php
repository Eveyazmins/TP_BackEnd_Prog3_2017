<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require 'vendor/autoload.php';
require_once 'vendor/autoload.php';
require_once 'clases/Usuario.php';
require_once 'clases/AccesoDatos.php';
require_once 'clases/Cochera.php';
require_once 'clases/Vehiculo.php';
require_once 'clases/RegistroAutos.php';
require_once 'clases/RegistroUsuarios.php';

/*$app = new \Slim\App;
$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;

});
*/


#RETORNAR USUARIOS EXISTENTES

$app->get('/usuarios[/]', function ($request, $response, $args) 
{
     $listado = Usuario::TraerUsuarios();
     return $response->withJson($listado);
});

#AGREGAR USUARIO A DB

$app->post('/CargarUsuario', function ($request, $response, $args)
{
    $usuario = new Usuario($_POST["password"], $_POST["nombre"], $_POST["apellido"], $_POST["tipo"], $_POST["turno"], $_POST["estado"]);
	return Usuario::AgregarUsuario($usuario->_nombre, $usuario_apellido, $usuario_password, $usuario_tipo, $usuario_turno, $usuario_habilitado, $usuario_cantOperaciones);
});

#LOGIN

$app->post('/Login', function ($request, $response, $args)
{
    $usuarioLogin = new stdclass(); //Obj genérico
    $usuarioLogin->id = $_POST["id"];
    $usuarioLogin->password = $_POST["password"];

    date_default_timezone_set('America/Argentina/Buenos_Aires');
    $dia = date(d)."/".date(m)."/".date(o);
    $horario = date(H).":".date(i).":".date(s);

    $validacion = Usuario::ValidacionPassword($usuarioLogin->id,$usuarioLogin->password);

    if ($validacion == false)
    {
        $resultado = "Error al ingresar datos";
    }           
    else
    {
        $resultado = "Usuario encontrado en la base de datos!";
        $usuarioLogin = $validacion;
        //CREAR TOKEN ACAAAAAAAAAAAAAA
  
        if($usuarioLogin->tipo == "Empleado")
        {
            //agregar registro
             //$registro=RegistroUsuario::AgregarRegistro($usuarioLogin->nombre, $usuarioLogin->apellido, $dia, $horario);
        
             echo("Agregar registro!!!!");
        }
    }
    
    //$response = $response->withJson($resultado);
    return $resultado;
});

$app->get('/coches[/]', function ($request, $response, $args) 
{
    //VERIFICAR TOKEN
    if(true)
    {
         $listado=Coche::TraerCoches();
         return $response->withJson($listado);
    }
    return "Sesion no iniciada";
});



$app->run();