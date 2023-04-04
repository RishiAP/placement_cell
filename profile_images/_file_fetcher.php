<?php
    if($_SERVER['REQUEST_METHOD']==="POST"){
        $data = file_get_contents('php://input');
        $jsonArray = json_decode($data,true);
        if(isset($jsonArray['image_name'])){
            echo base64_encode(file_get_contents($jsonArray['image_name']));
        }
    }
?>