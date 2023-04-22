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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/mobile.css">
    <title>Document</title>
</head>
<body>
    <?php
    if(!isset($_SESSION['admin_id'])){
        header("location:/placement_cell/login/admin_login.php");
    }
        require "../partials/_nav.php";
        $no_of_companies=mysqli_num_rows(mysqli_query($conn_stu,"SELECT * FROM `company`"));
        $all_students=mysqli_query($conn_stu,"SELECT * FROM `student`");
        $total_no_of_students=mysqli_num_rows($all_students);
        $total_no_of_students_applied=mysqli_num_rows(mysqli_query($conn_stu,"SELECT * FROM `student` WHERE `applied`!='[]'"));
        $total_no_of_students_offered=mysqli_num_rows(mysqli_query($conn_stu,"SELECT * FROM `student` WHERE `offers`!='{}'"));
        $total_no_of_offers=0;
        while ($student=mysqli_fetch_assoc($all_students)) {
            $total_no_of_offers+=count(json_decode($student["offers"],true));
        }
        $total_no_of_students_accepted=mysqli_num_rows(mysqli_query($conn_stu,"SELECT * FROM `student` WHERE `accepted_offer`!=0"));
    ?>
    <main>
        <div class="d-flex container-fluid" id="base-info-section">
        <section class="user-left-section">
        <img id="user_profile_photo" class="img-circle profile-image" src="/placement_cell/img/administrator.svg" alt="" style="max-width:100%;">
        </section>
        <section class="user-right-section">
            <h1 id="username"><?php echo $_SESSION['admin_username'] ?></h1>
            <h2 id="person_name"><?php echo $_SESSION['person_name'] ?></h2>
        </section>
        </div>
        <section id="placement_cell_statistics" class="container d-flex flex-wrap justify-content-between">
        <div class="card text-bg-primary mb-3" style="max-width: 18rem;">
  <div class="card-header text-center">Number of Companies</div>
  <div class="card-body">
    <h5 class="card-title text-center"><?php echo $no_of_companies; ?></h5>
  </div>
</div>
        <div class="card text-bg-secondary mb-3" style="max-width: 18rem;">
  <div class="card-header text-center">Total Number of students</div>
  <div class="card-body">
    <h5 class="card-title text-center"><?php echo $total_no_of_students; ?></h5>
  </div>
</div>
        <div class="card text-bg-dark mb-3" style="max-width: 18rem;">
  <div class="card-header text-center">Number of students applied</div>
  <div class="card-body">
    <h5 class="card-title text-center"><?php echo $total_no_of_students_applied; ?></h5>
  </div>
</div>
        <div class="card text-bg-light mb-3" style="max-width: 18rem;">
  <div class="card-header text-center">Number of students offered</div>
  <div class="card-body">
    <h5 class="card-title text-center"><?php echo $total_no_of_students_offered; ?></h5>
  </div>
</div>
        <div class="card text-bg-warning mb-3" style="max-width: 18rem;">
  <div class="card-header text-center">Number of offers</div>
  <div class="card-body">
    <h5 class="card-title text-center"><?php echo $total_no_of_offers; ?></h5>
  </div>
</div>
        <div class="card text-bg-success mb-3" style="max-width: 18rem;">
  <div class="card-header text-center">Offers Accepted</div>
  <div class="card-body">
    <h5 class="card-title text-center"><?php echo $total_no_of_students_accepted; ?></h5>
  </div>
</div>
        </section>
    </main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="../js/script.js"></script>
</body>
</html>