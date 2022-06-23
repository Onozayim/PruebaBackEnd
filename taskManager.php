<?php 
require_once("bd.php");

function getAllTasksManager() {
    $bd = new BD();
    $res = $bd->getAllTasks();

    if(!$res) {
        returnError();   
        return;
    }

    http_response_code(200);
    echo $res;
    return;
}

function createTaskManeger() {
    $bd = new BD();
    $data = json_decode(file_get_contents("php://input"));

    if(checkData($data->name, $data->description, $data->created_at)) {
        emptyData();
        return;
    }

    $res = $bd->createTask($data->description, $data->created_at, $data->name);

    if(!$res) {
        returnError();
        return;
    }

    http_response_code(200);

    $ret = array(
        "id" => $res,
        "name" => $data->name,
        "description" => $data->description,
        "completed" => 0,
        "created_at" => $data->created_at
    );

    echo json_encode($ret, JSON_PRETTY_PRINT);
    return;
}

function updateTaskManager() {
    $bd = new BD();
    $data = json_decode(file_get_contents("php://input"));

    if(checkData($data->name, $data->description, $data->created_at)) {
        emptyData();
        return;
    }

    $res = $bd->updateTask($data->description, $data->created_at, $data->name, $data->id);

    if(!$res) {
        returnError();
        return;
    }

    http_response_code(200);

    $ret = array(
        "id" => $data->id,
        "name" => $data->name,
        "description" => $data->description,
        "completed" => $data->completed,
        "created_at" => $data->created_at
    );

    echo json_encode($ret, JSON_PRETTY_PRINT);
    return;
}

function deleteTaskManager() {
    $bd = new BD();
    $data = json_decode(file_get_contents("php://input"));

    if($data->id == null || !$data) {
        emptyData();
        return;
    }

    $res = $bd->deleteTask($data->id);

    if(!$res) {
        returnError();
        return;
    }

    $ret = array(
        "id" => $data->id
    );

    http_response_code(200);

    echo json_encode($ret, JSON_PRETTY_PRINT);
    return;
}

function completeTask() {
    $bd = new BD();
    $data = json_decode(file_get_contents("php://input"));

    if($data->id == null || !$data) {
        emptyData();
        return;
    }

    $res = $bd->completeTask($data->id, $data->completed);

    if(!$res) {
        returnError();
        return;
    }
    
    http_response_code(200);

    echo "done";
    return;
}

function returnError() {
    http_response_code(400);
    $ret["error"] = "Error";

    echo json_encode($ret, JSON_PRETTY_PRINT);
    return;
}

function emptyData() {
    http_response_code(400);
    $ret["error"] = "Los campos no pueden estar vacíos";
    echo json_encode($ret, JSON_PRETTY_PRINT);
    return;
}

function checkData($name, $desc, $date) {
    return trim($name) == "" || trim($desc) == "" || trim($date) == "";
}
?>