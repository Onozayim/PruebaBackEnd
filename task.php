<?php
require("taskManager.php");
header('Access-Control-Allow-Origin: *'); 
header("Access-Control-Allow-Credentials: true");
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

switch ($_SERVER["REQUEST_METHOD"]) {
    case 'GET':
        getAllTasksManager();
        break;
    
    case "POST":
        createTaskManeger();
        break;

    case "PUT":
        updateTaskManager();
        break;

    case "DELETE":
        deleteTaskManager();
        break;
}
?>