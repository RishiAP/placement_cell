<?php
$user_type="";
  if(isset($_SESSION['user_id'])){
    require "../partials/_db_student.php";
    $user_details_fetch=mysqli_fetch_assoc(mysqli_query($conn_stu,"SELECT * FROM `student` WHERE `user_id`='{$_SESSION['user_id']}'"));
    $user_type="student";
    require "_logOutModal.php";
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
    <a class="navbar-brand" href="#">Offcanvas navbar</a>
    <button class="btn btn-danger" id="resume_delete_button" type="button" style="margin-left:auto; display:none;"><i class="bi bi-trash3"></i></button>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Offcanvas</h5>
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
        ?>" alt="" width="32" height="32" class="rounded-circle me-2">
        <strong><?php
          echo $_SESSION['user_name'];
        ?></strong>
      </a>
      <ul class="dropdown-menu text-small shadow" data-popper-placement="top-start" style="position: absolute; inset: auto auto 0px 0px; margin: 0px; transform: translate(0px, -34px);">
        <li><a class="dropdown-item" href="/placement_cell/student/">Profile</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#logOutModal">Log out</a></li>
      </ul>
    </div>
  </div>
      </div>
    </div>
  </div>
</nav>