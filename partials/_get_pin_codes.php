<?php
    if($_SERVER['REQUEST_METHOD']==="POST"){
        $data = file_get_contents('php://input');
        $jsonArray = json_decode($data,true);
        $all_pins=json_decode(file_get_contents('../data/pincodeModified.json'),true);
        echo json_encode($all_pins[$jsonArray['state']][$jsonArray['district']]);
    }
?>