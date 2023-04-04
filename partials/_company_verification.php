<?php
    if($_SERVER['REQUEST_METHOD']==="POST"){
        $data = file_get_contents('php://input');
        $jsonArray = json_decode($data,true);
        if(isset($jsonArray['username'],$jsonArray['password'])){
            require "_db_student.php";
            $result=mysqli_query($conn_stu,"SELECT * FROM `company` WHERE MATCH(`company_name`,`company_email`) AGAINST('{$jsonArray['username']}')");
            if(mysqli_num_rows($result)==1){
                $company_details=mysqli_fetch_assoc($result);
                if($company_details['company_name']===$jsonArray['username'] || $company_details['company_email']===$jsonArray['username']){
                    if(password_verify($jsonArray['password'],$company_details['company_password'])){
                        session_start();
                        $_SESSION['company_name']=$company_details['company_name'];
                        $_SESSION['company_id']=$company_details['company_id'];
                        $_SESSION['company_email']=$company_details['company_email'];
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