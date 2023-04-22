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
    if(!isset($_SESSION['company_id'])){
        header("location:/placement_cell/login/company_login.php");
    }
        require "../partials/_nav.php";
        $total_no_of_applicants=count(json_decode($company_details_fetch['applicants_id']));
        $total_no_of_offers=count(json_decode($company_details_fetch['approved_applicants']));
        $no_of_offers_accepted=mysqli_num_rows(mysqli_query($conn_stu,"SELECT * FROM `student` WHERE `accepted_offer`='{$company_details_fetch['company_id']}'"))
    ?>
    <main>
        <section class="d-flex container-fluid" id="base-info-section">
        <section class="user-left-section">
        <img src="<?php echo $company_details_fetch
        ['company_logo_url']; ?>" alt="">
        </section>
        <section class="user-right-section">
            <h1 id="username"><?php echo $company_details_fetch['company_name'] ?></h1>
            <h2 id="person_name"><?php echo $company_details_fetch['company_email'] ?></h2>
        </section>
</section>
<h1 class="text-center">Statistics</h1>
<section id="company_performance" class="mt-4 d-flex flex-wrap container justify-content-evenly">
<div class="card text-bg-primary mb-3" style="max-width: 18rem;">
  <div class="card-header text-center">Number of applicants</div>
  <div class="card-body">
    <h5 class="card-title text-center"><?php echo $total_no_of_applicants; ?></h5>
  </div>
</div>
<div class="card text-bg-light mb-3" style="max-width: 18rem;">
  <div class="card-header text-center">Offers Given</div>
  <div class="card-body">
    <h5 class="card-title text-center"><?php echo $total_no_of_offers; ?></h5>
  </div>
</div>
<div class="card text-bg-success mb-3" style="max-width: 18rem;">
  <div class="card-header text-center">Offers Accepted</div>
  <div class="card-body">
    <h5 class="card-title text-center"><?php echo $no_of_offers_accepted; ?></h5>
  </div>
</div>
</section>
    </main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="../js/script.js"></script>
</body>
</html>