<?php
session_start();
    if($_SERVER['REQUEST_METHOD']==="POST" && isset($_SESSION['user_id'])){
        require "_db_student.php";
        $user_details=mysqli_fetch_assoc(mysqli_query($conn_stu,"SELECT * FROM `student` WHERE `user_id`='{$_SESSION['user_id']}'"));
        if($user_details['banned']){
            require "_logOut.php";
            echo "banned";
            exit(0);
        }
        $profile_image_name=$user_details['profile_image_name'];
        if(mysqli_query($conn_stu,"UPDATE `student` SET `profile_image_name`='' WHERE `user_id`='{$_SESSION['user_id']}'")){
            if(unlink("../profile_images/".$profile_image_name)){
                echo true;
            }
            else {
                echo false;
            }
        }
        else{
            echo false;
        }
    }
?>