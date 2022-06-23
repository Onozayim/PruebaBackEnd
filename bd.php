<?php

class BD 
{
    private $con;

    public function __construct()
    {
        $this->con = new mysqli("localhost", "root", "" , "prueba");   
    }

    public function getAllTasks()
    {
        $sql = "SELECT * FROM task";
        $res = $this->con->query($sql);

        if(!$res) return false;

        $jsonArray = array();

        while($r = $res->fetch_assoc()){
            $jsonArray[] = $r;
        }

        return json_encode($jsonArray, JSON_PRETTY_PRINT);
    }

    public function createTask($description, $createdAt, $name) {
        $sql =

        "INSERT INTO 
            task (task.name, task.description, task.created_at)
        VALUES 
            ('$name', '$description', '$createdAt')";

        $res = $this->con->query($sql);

        if(!$res) return false;

        return $this->con->insert_id;
    }

    public function updateTask($description, $createdAt, $name, $id) {
        $sql = 

        "UPDATE
            task
        SET
            task.description = '$description',
            task.name = '$name',
            task.created_at = '$createdAt'
        WHERE
            task.id = $id";

        $res = $this->con->query($sql);       
        
        if(!$res) return false;

        return true;
    }

    public function deleteTask($id) {
        $sql =

        "DELETE FROM
            task
        WHERE
            id = $id";

        $res = $this->con->query($sql);

        if(!$res) return false;

        return true;
    }

    public function completeTask($id, $completed) {

        if($completed == 1) $value = 0;
        else $value = 1;

        $sql =
        
        "UPDATE
            task
        SET
            task.completed = $value
        WHERE
          task.id = $id";

        $res = $this->con->query($sql);

        if(!$res) return false;

        return true;
    }
}

?>