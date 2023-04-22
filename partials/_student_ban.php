<?php
    session_start();
    if($_SERVER['REQUEST_METHOD']==="POST" && isset($_SESSION['admin_id'])){
        $data = file_get_contents('php://input');
        $jsonArray = json_decode($data,true);
        require "_db_student.php";
        if(mysqli_query($conn_stu,"UPDATE `student` SET `banned`=1 WHERE `user_name`='{$jsonArray['username']}'")){
            echo true;
        }
    }
?>