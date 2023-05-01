<?php
session_start();
    if($_SERVER['REQUEST_METHOD']==="POST" && isset($_SESSION['user_id'])){
        $data = file_get_contents('php://input');
        $jsonArray = json_decode($data,true);
        require "_db_student.php";
        $user_details=mysqli_fetch_assoc(mysqli_query($conn_stu,"SELECT * FROM `student` WHERE `user_id`='{$_SESSION['user_id']}'"));
        if($user_details['banned']){
            require "_logOut.php";
            echo "banned";
            exit(0);
        }
        $jsonArray['gender']=strtoupper($jsonArray['gender']);
        if(strpos($jsonArray['graduation_status'],'year')!==false){
            $jsonArray['graduation_status']=strtoupper(substr($jsonArray['graduation_status'],1).substr($jsonArray['graduation_status'],0,1));
        }
        elseif ($json
        ['graduation_status']==="final_year") {
            $jsonArray['graduation_status']="FINAL_YEAR";
        }
        if(mysqli_query($conn_stu,"UPDATE `student` SET `f_name`='{$jsonArray['f_name']}', `l_name`='{$jsonArray['l_name']}',`c_email`='{$jsonArray['c_email']}',`ph_no`='{$jsonArray['phone_no']}',`DOB`='{$jsonArray['DOB']}',`gender`='{$jsonArray['gender']}',`graduation_institute`='{$jsonArray['graduation_institute']}',`course_name`='{$jsonArray['course_name']}',`graduation_status`='{$jsonArray['graduation_status']}',`address`='{$jsonArray['address']}',`state`='{$jsonArray['state']}',`district`='{$jsonArray['district']}',`city`='{$jsonArray['city']}',`pin_code`='{$jsonArray['pin_code']}',`aadhar_no`='{$jsonArray['aadhar_no']}'  WHERE `user_id`='{$_SESSION['user_id']}'")){
            echo true;
        }
    }
?>