<?php
    session_start();
    require '../vendor/autoload.php';
    use \Ds\Set;
    if(isset($_SESSION['company_id']) && $_SERVER['REQUEST_METHOD']==="POST"){
        $data = file_get_contents('php://input');
        $jsonArray = json_decode($data,true);
        require "_db_student.php";
        $user_details=mysqli_fetch_assoc(mysqli_query($conn_stu,"SELECT * FROM `student` WHERE `user_name`='{$jsonArray['username']}'"));
        if($user_details['banned']){
            echo "banned";
            exit(0);
        }
        $company_details=mysqli_fetch_assoc(mysqli_query($conn_stu,"SELECT * FROM `company` WHERE `company_id`='{$_SESSION['company_id']}'"));
        $all_applicants=new Set(json_decode($company_details['applicants_id']));
        if($all_applicants->contains((int)$user_details['user_id'])){
            $all_approved_user=new Set(json_decode($company_details['approved_applicants']));
        $all_approved_companies=json_decode($user_details['approved']);
        $all_approved_companies_unseen=new Set($all_approved_companies->unseen);
        $all_approved_user->add((int)$user_details['user_id']);
        $offers=json_decode($user_details['offers'],true);
        $offers[$_SESSION['company_id']]=$jsonArray['amount'];
        $offers=json_encode($offers);
        $all_approved_companies_unseen->add((int)$_SESSION['company_id']);
        $all_approved_companies->unseen=$all_approved_companies_unseen;
        $all_approved_companies=json_encode($all_approved_companies);
        $all_approved_user=json_encode($all_approved_user);
        if(mysqli_query($conn_stu,"UPDATE `company` SET `approved_applicants`='$all_approved_user' WHERE `company_id`='{$_SESSION['company_id']}'") && mysqli_query($conn_stu,"UPDATE `student` SET `approved`='$all_approved_companies',`offers`='$offers' WHERE `user_id`='{$user_details['user_id']}'")){
            echo true;
        }
        }
    }
?>