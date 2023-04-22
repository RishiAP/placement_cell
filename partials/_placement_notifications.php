<?php
session_start();
    if(isset($_SESSION['user_id']) && $_SERVER['REQUEST_METHOD']==="POST"){
        require "_db_student.php";
        $user_details_fetch=mysqli_fetch_assoc(mysqli_query($conn_stu,"SELECT * FROM `student` WHERE `user_id`='{$_SESSION['user_id']}'"));
        if($user_details_fetch['banned']){
            require "_logOut.php";
            echo "banned";
            exit(0);
        }
        $approved=json_decode($user_details_fetch['approved']);
        $all_data=array();
        if(count($approved->unseen)>0){
          $all_prices=json_decode($user_details_fetch['offers'],true);
          foreach ($approved->unseen as $key => $value) {
            $notification_company_details=mysqli_fetch_assoc(mysqli_query($conn_stu,"SELECT * FROM `company` WHERE `company_id`='$value'"));
            array_push($all_data,array(
                "company_logo_url"=>$notification_company_details['company_logo_url'],
                "company_name"=>$notification_company_details['company_name'],
                "amount"=>$all_prices[$notification_company_details['company_id']]
            ));
          }
        }
        echo json_encode($all_data);
      }
?>