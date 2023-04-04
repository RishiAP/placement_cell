<?php
    if($_SERVER['REQUEST_METHOD']==="POST"){
        $data = file_get_contents('php://input');
        $jsonArray = json_decode($data,true);
        if(isset($jsonArray['email'])){
            $jsonArray['email']=strtolower($jsonArray['email']);
            require "_db_student.php";
            $result=mysqli_query($conn_stu,"SELECT * FROM `student` WHERE `user_email`='{$jsonArray['email']}'");
            if(mysqli_num_rows($result)==1 && mysqli_fetch_assoc($result)['user_email']===$jsonArray['email']){
                echo true;
            }
            else{
                echo false;
            }
            
        }
    }
?>