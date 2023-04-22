<?php
    session_start();
    require '../vendor/autoload.php';
    use \Ds\Set;
    if($_SERVER['REQUEST_METHOD']==="POST" && isset($_SESSION['user_id'])){
        $data = file_get_contents('php://input');
        $jsonArray = json_decode($data,true);
        require "_db_student.php";
        $user_details=mysqli_fetch_assoc(mysqli_query($conn_stu,"SELECT * FROM `student` WHERE `user_id`='{$_SESSION['user_id']}'"));
        if($user_details['banned']){
            require "_logOut.php";
            echo "banned";
            exit(0);
        }
        $all_applicants=new Set(json_decode(mysqli_fetch_assoc(mysqli_query($conn_stu,"SELECT * FROM `company` WHERE `company_id`='{$jsonArray['company_id']}'"))['applicants_id']));
        $all_applied=new Set(json_decode($user_details['applied']));
        $all_applicants->add((int)$_SESSION['user_id']);
        $all_applied->add((int)$jsonArray['company_id']);
        $all_applicants=json_encode($all_applicants);
        $all_applied=json_encode($all_applied);
        if(mysqli_query($conn_stu,"UPDATE `company` SET `applicants_id`='$all_applicants' WHERE `company_id`='{$jsonArray['company_id']}'") && mysqli_query($conn_stu,"UPDATE `student` SET `applied`='$all_applied' WHERE `user_id`='{$_SESSION['user_id']}'")){
            echo true;
        }
    }
?>