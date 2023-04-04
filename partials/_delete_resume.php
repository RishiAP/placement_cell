<?php
session_start();
if(isset($_SESSION['user_id']) && $_SERVER['REQUEST_METHOD']==="POST"){
    require "_db_student.php";
    $filename=mysqli_fetch_assoc(mysqli_query($conn_stu,"SELECT * FROM `student` WHERE `user_id`='{$_SESSION['user_id']}'"))['resume_doc_name'];
    if(unlink('../resume_doc/'.$filename) && mysqli_query($conn_stu,"UPDATE `student` SET `resume_doc_name`='' WHERE `user_id`='{$_SESSION['user_id']}'")){
        echo true;
    }
}
?>