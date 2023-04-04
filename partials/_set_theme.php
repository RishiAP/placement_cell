<?php
    if($_SERVER['REQUEST_METHOD']==="POST"){
        $data = file_get_contents('php://input');
        $jsonArray = json_decode($data,true);
        if(isset($jsonArray['theme'])){
            session_start();
            $_SESSION['theme']=$jsonArray['theme'];
        }
    }
?>