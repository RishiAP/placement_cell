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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>
<body>
    <?php
    if(!isset($_SESSION['company_id'])){
        header("location:/placement_cell/login/company_login.php");
    }
        require "../partials/_nav.php";
    ?>
    <main>
        <section class="container">
            <h1 class="text-center">Approved Applicants</h1>
        <?php
        $applicants=implode(',',json_decode(mysqli_fetch_assoc(mysqli_query($conn_stu,"SELECT * FROM `company` WHERE `company_id`='{$_SESSION['company_id']}'"))['approved_applicants']));
        $students=mysqli_query($conn_stu,"SELECT * FROM `student` WHERE `user_id` IN({$applicants});");
        while ($student=mysqli_fetch_assoc($students)) {
            echo '<div class="card mb-3">
            <div class="row g-0">
              <div class="w-auto company_favicon_section applicants-list-img-section">
                <img src="';
                $image_src="";
                if($student['profile_image_name']==""){
                    $image_src="../img/default_user_image_".$_SESSION['theme'].".svg";
                }
                else{
                    $data = array(
                        "image_name"=>$student['profile_image_name'],
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
                $ext = pathinfo($student['profile_image_name'], PATHINFO_EXTENSION);
                $image_src='data:image/'.$ext.';base64,'.$image_base64;
                }
                echo $image_src.'" class="applicants-list-img img-fluid rounded-start" alt="..." style="max-height:220px;">
              </div>
              <div class="w-auto">
                <div class="card-body">
                  <a href="/placement_cell/student_profile/'.$student['user_name'].'"><h5 class="card-title stretched-link">@'.$student['user_name'].'</h5></a>
                  <h3 class="card-title">'.$student['f_name']." ".$student['l_name'].'</h3>
                  <p class="card-title text-large"><i class="bi bi-mortarboard-fill"></i> Student of '.$student['course_name'].' at '.$student['graduation_institute'].'</p>
                  <p class="card-text d-flex flex-column">
                  <span><i class="bi bi-geo-alt-fill text-danger"></i>'.$student['address'].'</span><span>'.$student['city'].", ".$student['district'].", ".$student['state']." - ".$student['pin_code'].'</span>
                  </p>
                </div>
              </div>
            </div>
          </div>';
        }
    ?>
        </section>
    </main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="../js/script.js"></script>
</body>
</html>