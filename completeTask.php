<?php
require("taskManager.php");
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true"); 
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

switch ($_SERVER["REQUEST_METHOD"]) {
    case "PUT":
        completeTask();
        break;
}
?>