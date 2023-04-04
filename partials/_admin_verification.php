<?php
    if($_SERVER['REQUEST_METHOD']==="POST"){
        $data = file_get_contents('php://input');
        $jsonArray = json_decode($data,true);
        if(isset($jsonArray['username'],$jsonArray['password'])){
            require "_db_student.php";
            $jsonArray['username']=strtolower($jsonArray['username']);
            $result=mysqli_query($conn_stu,"SELECT * FROM `admin` WHERE MATCH(`admin_username`,`admin_email`) AGAINST('{$jsonArray['username']}')");
            if(mysqli_num_rows($result)==1){
                $admin_details=mysqli_fetch_assoc($result);
                if($admin_details['admin_username']===$jsonArray['username'] || $admin_details['admin_email']===$jsonArray['username']){
                    if(password_verify($jsonArray['password'],$admin_details['admin_password'])){
                        session_start();
                        require "_logOut.php";
                        $_SESSION['admin_username']=$admin_details['admin_username'];
                        $_SESSION['admin_id']=$admin_details['admin_id'];
                        $_SESSION['admin_email']=$admin_details['admin_email'];
                        $_SESSION['person_name']=$admin_details['person_name'];
                        echo true;
                    }
                    else{
                        echo false;
                    }
                }
                else{
                    echo "falseAdmin";
                }
            }
            else{
                echo "falseAdmin";
            }
        }
    }
?>