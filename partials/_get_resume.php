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
        $resume_doc_name=$user_details['resume_doc_name'];
        if($resume_doc_name!=''){
        $data = array(
            "doc_name"=>$resume_doc_name,
        );             
        $json = json_encode($data);
        $url = "http://".gethostname()."/placement_cell/resume_doc/_file_fetcher.php";
        $ch = curl_init($url);
         
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($json)
        ));
        $doc_base64 = curl_exec($ch);
        curl_close($ch);
        echo $doc_base64;
    }
    else{
        echo false;
    }
    }
?>