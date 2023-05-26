<?php
    $user_type="";
    if(isset($_SESSION['user_id'])){
      if($_SERVER['REQUEST_URI']==='/placement_cell/'){
        require "partials/_db_student.php";
      }
      else{
        require "../partials/_db_student.php";
      }
      $user_details_fetch=mysqli_fetch_assoc(mysqli_query($conn_stu,"SELECT * FROM `student` WHERE `user_id`='{$_SESSION['user_id']}'"));
      if($user_details_fetch['banned']){
        require "_logOut.php";
        header("location:/placement_cell/login/student_login.php");
        exit(0);
      }
      $user_type="student";
  }
  if(isset($_SESSION['company_id']) && strpos($_SERVER['REQUEST_URI'],"/placement_cell/student_profile/")!==false){
    require "../partials/_db_student.php";
    $student_usn=explode('/',$_SERVER['REQUEST_URI'])[3];
    $user_details_fetch=mysqli_fetch_assoc(mysqli_query($conn_stu,"SELECT * FROM `student` WHERE `user_name`='$student_usn'"));
    $company_details_fetch=mysqli_fetch_assoc(mysqli_query($conn_stu,"SELECT * FROM `company` WHERE `company_id`='{$_SESSION['company_id']}'"));
    $user_type="company";
  }
  if((isset($_SESSION['admin_id']) || isset($_SESSION['user_id'])) && strpos($_SERVER['REQUEST_URI'],"/placement_cell/company_profile/")!==false){
    require "../partials/_db_student.php";
    $company_name=explode('/',$_SERVER['REQUEST_URI'])[3];
    $company_details_fetch=mysqli_fetch_assoc(mysqli_query($conn_stu,"SELECT * FROM `company` WHERE `company_name`='$company_name'"));
    $user_type="admin";
    if(isset($_SESSION['admin_id'])){
      $admin_details_fetch=mysqli_fetch_assoc(mysqli_query($conn_stu,"SELECT * FROM `admin` WHERE `admin_id`='{$_SESSION['admin_id']}'"));
    }
    else{
      $user_details_fetch=mysqli_fetch_assoc(mysqli_query($conn_stu,"SELECT * FROM `student` WHERE `user_id`='{$_SESSION['user_id']}'"));
    }
  }
  elseif(isset($_SESSION['admin_id']) && strpos($_SERVER['REQUEST_URI'],"/placement_cell/student_profile/")!==false){
    require "../partials/_db_student.php";
    $user_type="admin";
    $student_usn=explode('/',$_SERVER['REQUEST_URI'])[3];
    $user_details_fetch=mysqli_fetch_assoc(mysqli_query($conn_stu,"SELECT * FROM `student` WHERE `user_name`='$student_usn'"));
    $admin_details_fetch=mysqli_fetch_assoc(mysqli_query($conn_stu,"SELECT * FROM `admin` WHERE `admin_id`='{$_SESSION['admin_id']}'"));
  }
  else if(isset($_SESSION['company_id'])){
    $user_type="company";
    if($_SERVER['REQUEST_URI']==='/placement_cell/'){
      require "partials/_db_student.php";
    }
    else{
      require "../partials/_db_student.php";
    }
      $company_details_fetch=mysqli_fetch_assoc(mysqli_query($conn_stu,"SELECT * FROM `company` WHERE `company_id`='{$_SESSION['company_id']}'"));
  }
  if(!isset($_SESSION['theme'])){
    $_SESSION['theme']="light";
  }
  else if(isset($_SESSION['admin_id'])){
    $user_type="admin";
    if($_SERVER['REQUEST_URI']==='/placement_cell/'){
      require "partials/_db_student.php";
    }
    else{
      require "../partials/_db_student.php";
    }
    $admin_details_fetch=mysqli_fetch_assoc(mysqli_query($conn_stu,"SELECT * FROM `admin` WHERE `admin_id`='{$_SESSION['admin_id']}'"));
  }
  if((isset($_SESSION['user_id']) || isset($_SESSION['admin_id']) || isset($_SESSION['company_id'])) && isset($user_details_fetch['profile_image_name']) && $user_details_fetch['profile_image_name']!=''){
    $user_type="student";
    $data = array(
          "image_name"=>$user_details_fetch['profile_image_name'],
      );
       
      $json = json_encode($data);
  $url = "http://".gethostname()."/placement_cell/profile_images/_file_fetcher.php";
  $ch = curl_init($url);
   
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json',
      'Content-Length: ' . strlen($json)
  ));
  $image_base64 = curl_exec($ch);
  curl_close($ch);
  $ext = pathinfo($user_details_fetch['profile_image_name'], PATHINFO_EXTENSION);
  }
?>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/mobile.css">
<link rel="icon" href="/placement_cell/img/favicon.ico">