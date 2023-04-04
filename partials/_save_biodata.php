<?php
session_start();
    if($_SERVER['REQUEST_METHOD']==="POST" && isset($_SESSION['user_id'])){
        $data = file_get_contents('php://input');
        $jsonArray = json_decode($data,true);
        require "_db_student.php";
        if(mysqli_query($conn_stu,"UPDATE `student` SET `f_name`='{$jsonArray['f_name']}', `l_name`='{$jsonArray['l_name']}',`c_email`='{$jsonArray['c_email']}',`ph_no`='{$jsonArray['phone_no']}',`DOB`='{$jsonArray['DOB']}',`gender`='{$jsonArray['gender']}',`address`='{$jsonArray['address']}',`state`='{$jsonArray['state']}',`district`='{$jsonArray['district']}',`city`='{$jsonArray['city']}',`pin_code`='{$jsonArray['pin_code']}',`aadhar_no`='{$jsonArray['aadhar_no']}'  WHERE `user_id`='{$_SESSION['user_id']}'")){
            echo true;
        }
    }
?>