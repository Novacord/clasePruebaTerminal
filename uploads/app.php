<?php

    require "../vendor/autoload.php";

    $router = new \Bramus\Router\Router();

    $dotenv = Dotenv\Dotenv::createImmutable("../");
    $dotenv->load();

    $credenciales = new App\connect();

    $router->post('/persona', function() {
        $_DATA = json_decode(file_get_contents("php://input"), true);
        global $credenciales;
        $conn = $credenciales->getConnection();
        $res = $conn->prepare("INSERT INTO person (nombre, apellido1, apellido2, DNI) VALUES (:nombre, :apellido1, :apellido2, :DNI)");
        $res->bindParam("nombre", $_DATA['nombre']);
        $res->bindParam("apellido1", $_DATA['apellido1']);
        $res->bindParam("apellido2", $_DATA['apellido2']);
        $res->bindParam("DNI", $_DATA['DNI']);
        $res->execute();
        $res = $res->rowCount();
        echo json_encode($res);
    });

    $router->get('/persona', function() {
        global $credenciales;
        $conn = $credenciales->getConnection();
        $res = $conn->prepare('SELECT * FROM person');
        $res -> execute();
        $res = $res->fetchAll(\PDO::FETCH_ASSOC);
        echo json_encode($res);
    });

    $router->get("/persona/{id}", function($id){
        global $credenciales;
        $conn = $credenciales->getConnection();
        $res = $conn->prepare("SELECT * FROM person WHERE id = :ID");
        $res->bindParam("ID", $id);
        $res -> execute();
        $res = $res->fetchAll(\PDO::FETCH_ASSOC);
        echo json_encode($res);
        // print_r(file_get_contents('php://input'));
    });

    $router->put('/persona', function() {
        $_DATA = json_decode(file_get_contents('php://input'),true);
        global $credenciales;
        $conn = $credenciales->getConnection();
        $res = $conn->prepare('UPDATE person SET nombre = :nombre, apellido1 = :apellido1, apellido2 = :apellido2, DNI = :DNI WHERE id=:id');
        $res->bindvalue("id", $_DATA['id']);
        $res->bindvalue("nombre", $_DATA['nombre']);
        $res->bindvalue("apellido1", $_DATA['apellido1']);
        $res->bindvalue("apellido2", $_DATA['apellido2']);
        $res->bindvalue("DNI", $_DATA['DNI']);
        $res->execute();
        $res = $res->rowCount();
        echo json_encode($res);
    });

    $router->delete("/persona", function(){
        $_DATA = json_decode(file_get_contents("php://input"), true);
        global $credenciales;
        $conn = $credenciales->getConnection();
        $res = $conn->prepare("DELETE FROM person WHERE id = :id");
        $res->bindParam("id", $_DATA['id']);
        $res->execute();
        $res = $res->rowCount();
        echo json_encode($res);
    });



    $router->run();

?>