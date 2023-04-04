<?php
session_start();
    if($_SERVER['REQUEST_METHOD']==="POST" && isset($_SESSION['user_id'])){
        $data = file_get_contents('php://input');
        $jsonArray = json_decode($data,true);
        require "_db_student.php";
        $user_details=mysqli_fetch_assoc(mysqli_query($conn_stu,"SELECT * FROM `student` WHERE `user_id`='{$_SESSION['user_id']}'"));
        function save_file($data_in,$dir_name){
            global $conn_stu,$user_details;
            $data=explode(',',$data_in);
            if(stripos($data[0],"application/pdf")!==false)
                $ext="pdf";
            else if(stripos($data[0],"application/vnd.openxmlformats-officedocument.wordprocessingml.document")!==false) {
                $ext="docx";
            }
            $random_name=hash("sha256",time().uniqid()).".".$ext;
            $file_put=file_put_contents("../".$dir_name."/".$random_name,file_get_contents($data_in));
            $pre_file_name=$user_details[substr($dir_name,0,strlen($dir_name)-1)."_name"];
            $unlinked=true;
            if($pre_file_name!=''){
                $unlinked=unlink("../".$dir_name."/".$pre_file_name);
            }
            if($unlinked && $file_put!==false){
                return $random_name;
            }
        }
        $high_school_marksheet_name=save_file($jsonArray['high_school_marksheet'],'high_school_marksheets');
        $intermediate_marksheet_name=save_file($jsonArray['intermediate_marksheet'],'intermediate_marksheets');
        $jsonArray['high_school_performance']=json_encode($jsonArray['high_school_performance']);
        $jsonArray['intermediate_performance']=json_encode($jsonArray['intermediate_performance']);
        $main_query=mysqli_query($conn_stu,"UPDATE `student` SET `high_school_performance`='{$jsonArray['high_school_performance']}', `intermediate_performance`='{$jsonArray['intermediate_performance']}', `high_school_marksheet_name`='$high_school_marksheet_name', `intermediate_marksheet_name`='$intermediate_marksheet_name' WHERE `user_id`='{$_SESSION['user_id']}'");
        if($main_query){
            echo true;
        }
    }
?>