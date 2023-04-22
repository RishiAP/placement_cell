<?php
    session_start();
    if((isset($_SESSION['company_id']) || isset($_SESSION['user_id']) || isset($_SESSION['admin_id'])) && $_SERVER['REQUEST_METHOD']==="POST"){
        $data = file_get_contents('php://input');
        $jsonArray = json_decode($data,true);
        if(isset($_SESSION['user_id'])){
            $jsonArray['username']=$_SESSION['user_name'];
        }
        require "_db_student.php";
        $user_details=mysqli_fetch_assoc(mysqli_query($conn_stu,"SELECT * FROM `student` WHERE `user_name`='{$jsonArray['username']}'"));
        if(isset($_SESSION['user_id']) && $user_details['banned']){
            require "_logOut.php";
            echo "banned";
            exit(0);
        }elseif (isset($_SESSION['company_id']) && $user_details['banned']) {
            echo "student_banned";
            exit(0);
        }
        $doc_label="";
        $dir="";
        if($jsonArray['doc_type']==="doc_resume"){
            $doc_label="resume_doc_name";
            $dir="resume_doc";
        }
        elseif($jsonArray['doc_type']==="doc_high_school"){
            $doc_label="high_school_marksheet_name";
            $dir="high_school_marksheets";
        }
        elseif($jsonArray['doc_type']==="doc_intermediate"){
            $doc_label="intermediate_marksheet_name";
            $dir="intermediate_marksheets";
        }
        $doc_name=$user_details[$doc_label];
        $data = array(
            "doc_name"=>$doc_name,
        );
         
        $json = json_encode($data);
    $url = "http://".gethostname()."/placement_cell/".$dir."/_file_fetcher.php";
    $ch = curl_init($url);
     
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($json)
    ));
    $image_base64 = curl_exec($ch);
    curl_close($ch);
    echo $image_base64;
    }
?>