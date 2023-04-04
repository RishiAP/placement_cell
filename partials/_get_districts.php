<?php
    if($_SERVER['REQUEST_METHOD']==="POST"){
        $data = file_get_contents('php://input');
        $jsonArray = json_decode($data,true);
        session_start();
        if(isset($_SESSION['user_id'],$jsonArray['state'])){
            $data=json_decode(file_get_contents("../data/statesAndDistrictsOfIndia(Updated).json"),true);
            // echo var_dump($data->states);
            echo json_encode($data[$jsonArray['state']]);
        }
    }
?>