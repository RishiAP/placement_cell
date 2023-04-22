<?php
session_start();
    if($_SERVER['REQUEST_METHOD']==="POST" && isset($_SESSION['user_id'])){
        require "_db_student.php";
        $user_details=mysqli_fetch_assoc(mysqli_query($conn_stu,"SELECT * FROM `student` WHERE `user_id`='{$_SESSION['user_id']}'"));
        if($user_details['banned']){
            require "_logOut.php";
            echo "banned";
            exit(0);
        }
        if($user_details['high_school_marksheet_name']!=''){
            $data_response=array(
                "high_school_marksheet"=>'',
                "intermediate_marksheet"=>''
            );
        $data = array(
            "doc_name"=>$user_details['high_school_marksheet_name'],
        );             
        $json = json_encode($data);
        $url = "http://".gethostname()."/placement_cell/high_school_marksheets/_file_fetcher.php";
        $ch = curl_init($url);
         
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($json)
        ));
        $data_response['high_school_marksheet'] = curl_exec($ch);
        curl_close($ch);
        $data = array(
            "doc_name"=>$user_details['intermediate_marksheet_name'],
        );             
        $json = json_encode($data);
        $url = "http://".gethostname()."/placement_cell/intermediate_marksheets/_file_fetcher.php";
        $ch = curl_init($url);
         
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($json)
        ));
        $data_response['intermediate_marksheet'] = curl_exec($ch);
        curl_close($ch);
        echo json_encode($data_response);
    }
    else{
        echo false;
    }
    }
?>