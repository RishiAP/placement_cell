<?php
    if($_SERVER['REQUEST_METHOD']==="POST"){
        $data = file_get_contents('php://input');
        $jsonArray = json_decode($data,true);
        if(isset($jsonArray['username'],$jsonArray['password'],$jsonArray['email'],$jsonArray['cnf_pass']) && $jsonArray['password']===$jsonArray['cnf_pass']){
            require "_db_student.php";
            $hash=password_hash($jsonArray['password'],PASSWORD_ARGON2ID);
            $time=time();
            $result=mysqli_query($conn_stu,"INSERT INTO `company` (`company_name`,`company_email`,`company_password`,`joined_date`) VALUES('{$jsonArray['username']}','{$jsonArray['email']}','$hash','$time')");
            if($result){
                echo true;
            }
            else{
                echo false;
            }
        }
    }
?>