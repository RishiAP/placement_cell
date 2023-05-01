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
<?php require "../partials/_header.php"; ?>
    <title>Document</title>
</head>
<body>
    <?php
    if(!isset($_SESSION['user_id'])){
        header("location:/placement_cell/login/student_login.php");
    }
        require "../partials/_nav.php";
    ?>
    <main class="d-flex container flex-column gap-4">
        <h1 class="text-center">Companies You Applied For</h1>
    <?php
    $companies_applied_ids=implode(",",json_decode($user_details_fetch['applied']));
        $companies_query=mysqli_query($conn_stu,"SELECT * FROM `company` WHERE `company_id` IN({$companies_applied_ids});");;
        while ($company=mysqli_fetch_assoc($companies_query)) {
            echo '<div class="card mb-3">
            <div class="row g-0">
              <div class="col-md-4 company_favicon_section">
                <img src="'.$company['company_logo_url'].'" class="img-fluid" alt="...">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">'.$company['company_name'].'</h5>
                  <p class="card-text">'.$company['company_description'].'</p>
                  <p class="card-text d-flex justify-content-between align-items-center"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                </div>
              </div>
            </div>
          </div>';
        }
    ?>
    </main>
<?php require "../partials/_footer.php" ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="../js/script.js"></script>
</body>
</html>