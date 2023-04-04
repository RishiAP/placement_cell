<?php
    if($_SERVER['REQUEST_METHOD']==="POST"){
        $data = file_get_contents('php://input');
        $jsonArray = json_decode($data,true);
        if(isset($jsonArray['username'],$jsonArray['password'],$jsonArray['person_name'],$jsonArray['email'],$jsonArray['cnf_pass']) && $jsonArray['password']===$jsonArray['cnf_pass']){
            require "_db_student.php";
            $jsonArray['username']=strtolower($jsonArray['username']);
            $hash=password_hash($jsonArray['password'],PASSWORD_ARGON2ID);
            $time=time();
            $result=mysqli_query($conn_stu,"INSERT INTO `student` (`user_name`,`user_email`,`user_password`,`person_name`,`joined_date`) VALUES('{$jsonArray['username']}','{$jsonArray['email']}','$hash','{$jsonArray['person_name']}','$time')");
            if($result){
                echo true;
            }
            else{
                echo false;
            }
        }
    }
?>