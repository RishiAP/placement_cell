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
<nav class="navbar fixed-top navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="/placement_cell/"><img style="max-width:50px;" src="/placement_cell/img/PC_icon.png" alt=""></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/placement_cell/">Home</a>
        </li>
      </ul>
      <?php
          if(isset($_SESSION['admin_id']) || isset($_SESSION['company_id']) || isset($_SESSION['user_id'])){
            if(isset($_SESSION['admin_id'])){
              $placeholder="Search (Type @<User> for user search and #<Company> for company search)";
            }
            elseif(isset($_SESSION['company_id'])){
              $placeholder="Search for students";
            }
            else{
              $placeholder="Search for companies";
            }
            echo '<section class="d-flex flex-column m-auto" style="position:relative;">
            <input type="search" name="main_search" id="main_search" class="plh-none w-auto form-control" placeholder="'.$placeholder.'"><ul class="list-group" id="search_results"></section>';
          }
        ?>
      <svg stroke="var(--bs-body-color)" id="theme_change_btn" fill="var(--bs-body-color)" stroke-width="0" viewBox="0 0 16 16" height="28" width="28" xmlns="http://www.w3.org/2000/svg"><path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"></path><path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"></path></svg>
      <div class="text-end d-flex gap-3 align-items-center">
          <div class="dropdown">
    <a class="btn btn-success dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
      Login
    </a>
  
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="/placement_cell/login/admin_login.php">Admin Login</a></li>
      <li><a class="dropdown-item" href="/placement_cell/login/student_login.php">Student Login</a></li>
      <li><a class="dropdown-item" href="/placement_cell/login/company_login.php">Placement Cell</a></li>
    </ul>
  </div>
  <div class="dropdown">
            <a type="button" class="btn btn-warning dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Register</a>
            <ul class="dropdown-menu dropdown-menu-end">
      <li><a class="dropdown-item" href="/placement_cell/register/student_register.php">Student Register</a></li>
      <li><a class="dropdown-item" href="/placement_cell/register/company_register.php">Placement Cell</a></li>
    </ul>
  </div>
  <?php
      if(isset($_SESSION['user_id']) || isset($_SESSION['admin_id']) || isset($_SESSION['company_id'])){
        echo '<div id="user_control">
        <div class="dropdown">';
        echo '<img class="dropdown-toggle profile-image" role="button" data-bs-toggle="dropdown" id="menuProfileImage" aria-expanded="false" src="';
        if(isset($_SESSION['user_id']) && $user_details_fetch['profile_image_name']=='')
        {
          echo '/placement_cell/img/default_user_image_'.$_SESSION['theme'].'.svg';
        }
        else if(isset($_SESSION['company_id'])){
          echo $company_details_fetch['company_logo_url'];
        }
        elseif (isset($_SESSION['admin_id'])) {
          echo "/placement_cell/img/administrator.svg";
        }
        else{   
        echo 'data:image/'.$ext.';base64,'.$image_base64;
        }
        echo '" alt="">';
        echo '<ul class="dropdown-menu dropdown-menu-end">';
        if($_SERVER['REQUEST_URI']!=="/placement_cell/student/"){
          echo '<li><a class="dropdown-item" href="/placement_cell/'.$user_type.'/">Profile</a></li>';
        }
        if(isset($_SESSION['user_id'])){
        if($_SERVER['REQUEST_URI']!=="/placement_cell/apply/"){
          echo '<li><a class="dropdown-item" href="/placement_cell/apply/" >Apply for Placement</a></li>';
        }
        if($_SERVER['REQUEST_URI']!=="/placement_cell/student/offers.php"){
          echo '<li><a class="dropdown-item" href="/placement_cell/student/offers.php">Offers</a></li>';
        }
        if($_SERVER['REQUEST_URI']!=="/placement_cell/student/applied.php"){
          echo '<li><a class="dropdown-item" href="/placement_cell/student/applied.php">Applied In</a></li>';
        }
        echo '<li><a class="dropdown-item" href="/placement_cell/'.$user_type.'/settings.php">Settings</a></li>';
      }
      if(isset($_SESSION['company_id']) && $_SERVER['REQUEST_URI']!=="/placement_cell/applicants/"){
        echo '<li><a class="dropdown-item" href="/placement_cell/applicants/">Applicants</a></li>';
      }
      if(isset($_SESSION['company_id']) && $_SERVER['REQUEST_URI']!=="/placement_cell/approved/"){
      echo '<li><a class="dropdown-item" href="/placement_cell/approved/">Approved Students</a></li>';
      }
      echo '<li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logOutModal">Log Out</a></li>';
      echo'</ul>
        </div>
        </div>';
      }
    ?>
    </div>
  </div>
</nav>

  <div id="page_main_message" class="sticky-top" style="top:76px;"></div>
  <?php
  if(isset($_SESSION['user_id']) || isset($_SESSION['admin_id']) || isset($_SESSION['company_id'])){
    require "_logOutModal.php";
  }
  ?>
  <!-- Position it: -->
  <!-- - `.toast-container` for spacing between toasts -->
  <!-- - `top-0` & `end-0` to position the toasts in the upper right corner -->
  <!-- - `.p-3` to prevent the toasts from sticking to the edge of the container  -->
  <div class="toast-container top-0 end-0 p-3" id="notifications">
</div>