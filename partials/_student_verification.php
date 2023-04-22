<?php
    if($_SERVER['REQUEST_METHOD']==="POST"){
        $data = file_get_contents('php://input');
        $jsonArray = json_decode($data,true);
        if(isset($jsonArray['username'],$jsonArray['password'])){
            require "_db_student.php";
            $jsonArray['username']=strtolower($jsonArray['username']);
            $result=mysqli_query($conn_stu,"SELECT * FROM `student` WHERE MATCH(`user_name`,`user_email`) AGAINST('{$jsonArray['username']}')");
            if(mysqli_num_rows($result)==1){
                $user_details=mysqli_fetch_assoc($result);
                if($user_details['user_name']===$jsonArray['username'] || $user_details['user_email']===$jsonArray['username']){
                    if($user_details['banned']){
                        echo "banned";
                        exit(0);
                    }
                    if(password_verify($jsonArray['password'],$user_details['user_password'])){
                        session_start();
                        require "_logOut.php";
                        $_SESSION['user_name']=$user_details['user_name'];
                        $_SESSION['user_id']=$user_details['user_id'];
                        $_SESSION['user_email']=$user_details['user_email'];
                        $_SESSION['person_name']=$user_details['person_name'];
                        echo true;
                    }
                    else{
                        echo false;
                    }
                }
                else{
                    echo "falseUser";
                }
            }
            else{
                echo "falseUser";
            }
        }
    }
?>