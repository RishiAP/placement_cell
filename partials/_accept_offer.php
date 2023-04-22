<?php
session_start();
    if(isset($_SESSION['user_id']) && $_SERVER['REQUEST_METHOD']==="POST"){
        $data=file_get_contents("php://input");
        $jsonArray=json_decode($data,true);
        require "_db_student.php";
        $user_details=mysqli_fetch_assoc(mysqli_query($conn_stu,"SELECT * FROM `student` WHERE `user_id`='{$_SESSION['user_id']}'"));
        if($user_details['banned']){
            require "_logOut.php";
            echo "banned";
            exit(0);
        }
        $company_offered=json_decode($user_details['offers'],true);
        if($user_details['accepted_offer']==0 && isset($company_offered[(string)$jsonArray['company_id']])){
            if(mysqli_query($conn_stu,"UPDATE `student` SET `accepted_offer`='{$jsonArray['company_id']}' WHERE `user_id`='{$_SESSION['user_id']}'")){
                echo true;
            }
        }
    }
?>