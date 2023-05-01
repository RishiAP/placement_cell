<?php
$user_type="";
  if(isset($_SESSION['user_id'])){
    require "../partials/_db_student.php";
    $user_details_fetch=mysqli_fetch_assoc(mysqli_query($conn_stu,"SELECT * FROM `student` WHERE `user_id`='{$_SESSION['user_id']}'"));
    $user_type="student";
    require "_logOutModal.php";
    if($user_details_fetch['banned']){
      require "_logOut.php";
      header("location:/placement_cell/login/student_login.php");
      exit(0);
    }
}
if(!isset($_SESSION['theme'])){
  $_SESSION['theme']="light";
}
  if(isset($_SESSION['admin_id'])){
    require "../partials/_db_student.php";
    require "_logOutModal.php";
    $user_details_fetch=mysqli_fetch_assoc(mysqli_query($conn_stu,"SELECT * FROM `admin` WHERE `admin_id`='{$_SESSION['admin_id']}'"));
    $user_type="admin";
}
if((isset($_SESSION['user_id']) || isset($_SESSION['admin_id'])) && $user_details_fetch['profile_image_name']!=''){
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
<nav class="navbar bg-body-tertiary sticky-top" style="">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="/placement_cell/"><img style="max-width:50px;" src="/placement_cell/img/PC_icon.png" alt=""></a>
    <button class="btn btn-danger" id="resume_delete_button" type="button" style="margin-left:auto; display:none;"><i class="bi bi-trash3"></i></button>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Options</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body p-0">
      <div class="d-flex flex-column flex-shrink-0 h-100 p-3 bg-body-tertiary">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
      <span class="fs-4">Settings</span>
    </a>
    <hr>
    <ul class="nav nav-pills flex-column mb-auto">
      <li>
        <a class="nav-link active" data-option-type="biodata">
        <i class="bi bi-clipboard-data"></i>
          Biodata
        </a>
      </li>
      <li>
        <a class="nav-link link-body-emphasis" data-option-type="academics">
        <i class="bi bi-bar-chart-line"></i>
          Academics
        </a>
      </li>
      <li>
        <a class="nav-link link-body-emphasis" data-option-type="resume">
        <i class="bi bi-file-earmark-person"></i>
          Resume
        </a>
      </li>
    </ul>
    <svg stroke="var(--bs-body-color)" id="theme_change_btn" fill="var(--bs-body-color)" stroke-width="0" viewBox="0 0 16 16" height="28" width="28" xmlns="http://www.w3.org/2000/svg"><path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"></path><path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"></path></svg>
    <hr>
    <div class="dropdown">
      <a href="#" class="d-flex align-items-center link-body-emphasis text-decoration-none dropdown-toggle show" data-bs-toggle="dropdown" aria-expanded="true">
        <img src="<?php
          if($user_details_fetch['profile_image_name']=='')
          {
            echo '/placement_cell/img/default_user_image_'.$_SESSION['theme'].'.svg';
          }
          else{   
          echo 'data:image/'.$ext.';base64,'.$image_base64;
          }
        ?>" alt="" width="32" height="32" class="rounded-circle me-2 profile-image">
        <strong><?php
          echo $_SESSION['user_name'];
        ?></strong>
      </a>
      <ul class="dropdown-menu text-small shadow" data-popper-placement="top-start" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(0px, -34px);">
        <li><a class="dropdown-item" href="/placement_cell/student/">Profile</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logOutModal">Log out</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="/placement_cell/apply/">Apply for Placement</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="/placement_cell/student/offers.php">Offers</a></li>
      </ul>
    </div>
  </div>
      </div>
    </div>
  </div>
</nav>