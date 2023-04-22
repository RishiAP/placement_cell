<?php
    if($_SERVER['REQUEST_METHOD']==="POST"){
        $data = file_get_contents('php://input');
        $jsonArray = json_decode($data,true);
        session_start();
        if(isset($_SESSION['user_id'],$jsonArray['doc_data'])){
            require "_db_student.php";
            $user_details=mysqli_fetch_assoc(mysqli_query($conn_stu,"SELECT * FROM `student` WHERE `user_id`='{$_SESSION['user_id']}'"));
            if($user_details['banned']){
                require "_logOut.php";
                echo "banned";
                exit(0);
            }
            $data=explode(',',$jsonArray['doc_data']);
            $ext="";
            if(stripos($data[0],"application/pdf")!==false)
                $ext="pdf";
            else if(stripos($data[0],"application/vnd.openxmlformats-officedocument.wordprocessingml.document")!==false) {
                $ext="docx";
            }
            $random_name=hash("sha256",time().uniqid()).".".$ext;
            file_put_contents("../resume_doc/".$random_name,file_get_contents($jsonArray['doc_data']));
            $pre_file_name=$user_details['resume_doc_name'];
            $unlinked=true;
            if($pre_file_name!=''){
                $unlinked=unlink("../resume_doc/".$pre_file_name);
            }
            $result=mysqli_query($conn_stu,"UPDATE `student` SET `resume_doc_name`='$random_name' WHERE `user_id`='{$_SESSION['user_id']}'");
            if($result && $unlinked){
                echo true;
            }
        }
    }
?>