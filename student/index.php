<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="<?php if(isset($_SESSION['theme'])){
    echo $_SESSION['theme'];
}
else{
    echo "light";
} ?>">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
        <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>
        <script src="https://unpkg.com/cropperjs"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/mobile.css">
    <style>
        .cropper-view-box , .cropper-face{
          border-radius:50% !important;
        }
  
      .image_area {
        position: relative;
      }
  
      #imageCroppingModal img {
          display: block;
          max-width: 100%;
      }
  
      .preview {
          overflow: hidden;
          width: 160px !important; 
          height: 160px !important;
          margin: auto;
          border: 1px solid red;
          display:none !important;
      }
  
      .modal-lg{
          max-width: 1000px !important;
      }
  
      .overlay {
        position: absolute;
        bottom: 0px;
        left: 0;
        right: 0;
        background-color: rgba(255, 255, 255, 0.5);
        overflow: hidden;
        height: 0;
        transition: .5s ease;
        width: 100%;
        margin: auto;
      }
  
      .image_area:hover .overlay {
        height: 50%;
        cursor: pointer;
      }
      .photoHelpText {
        color: #333;
        font-size: 20px;
        position: absolute;
        top: 50%;
        left: 50%;
        width:100%;
        max-width:300px;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        text-align: center;
      }
      #sample_image{
        max-height: calc(100vh - 230px);
      }
    </style>
    <title>Document</title>
</head>
<body>
    <?php
    if(!isset($_SESSION['user_id'])){
        header("location:/placement_cell/login/student_login.php");
    }
    else{
      require "../partials/_nav.php";
    require "../partials/student_docs_details_modal.php";
        require "../partials/profileImageAlterChoiceModal.php";
    require "../partials/_image_cropping_modal.php";
    }
    ?>
    <main class="d-flex container-fluid">
        <section class="user-left-section">
                <?php
                    echo '<div class="image_area">
                    <form method="post">
                        <img oncontextmenu="return false;" src="';
                        if($user_details_fetch['profile_image_name']=='')
                        {
                          echo '/placement_cell/img/default_user_image_'.$_SESSION['theme'].'.svg';
                        }
                        else{   
                        echo 'data:image/'.$ext.';base64,'.$image_base64;
                        }
                        echo '" id="user_profile_photo" class="img-circle profile-image" data-bs-toggle="modal" data-bs-target="#profileImageAlterChoiceModal" />
                        <div class="overlay" data-bs-toggle="modal" data-bs-target="#profileImageAlterChoiceModal" style="max-width:300px;">
                          <div class="photoHelpText">Click to Change Profile Image</div>
                        </div>
                        <input type="file" name="image" class="image" id="upload_image" style="display:none !important" accept="image/*" />
                    </form>
                  </div>';
                ?>
        </section>
        <section class="user-right-section">
            <h1 id="username"><?php echo $user_details_fetch['user_name']; ?></h1>
            <h2 id="person_name"><?php echo $user_details_fetch['f_name']." ".$user_details_fetch['l_name']; ?></h2>
                <?php
                    echo '<p class="text-large"><i class="bi bi-mortarboard-fill"></i> Student of '.$user_details_fetch['course_name'].' at '.$user_details_fetch['graduation_institute'].'</p>
                    <p class="d-flex flex-column">
                    <span><i class="bi bi-geo-alt-fill text-danger"></i>'.$user_details_fetch['address'].'</span><span>'.$user_details_fetch['city'].", ".$user_details_fetch['district'].", ".$user_details_fetch['state']." - ".$user_details_fetch['pin_code'].'</span>
                    </p>';
                ?>
                <section class="contact-section d-flex gap-5">
                    <p><i class="bi bi-envelope-at"></i> <?php
                        echo $user_details_fetch['c_email']
                    ?></p>
                    <p><i class="bi bi-telephone"></i>
                    <?php
                        echo $user_details_fetch['ph_no']
                    ?></p>
                </section>
            <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#student_docs_details_modal" data-bs-type="doc_high_school">High School Marksheet</button>
            <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-type="doc_intermediate" data-bs-target="#student_docs_details_modal">Intermediate Marksheet</button>
            <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-type="doc_resume" data-bs-target="#student_docs_details_modal">Resume</button>
            <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-type="academic_performance" data-bs-target="#student_docs_details_modal">Academic Performance</button>
        </section>
    </main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="../js/script.js"></script>
<script src="../js/imageCropper.js"></script>
<script src="../js/manageProfilePhoto.js"></script>
<script src="https://documentservices.adobe.com/view-sdk/viewer.js"></script>
<script src="../js/fetch_student_data.js"></script>
</body>
</html>