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
        require "partials/_nav.php";
    ?>
  <main class="container mb-5 d-flex flex-column align-items-center">
    <img src="img/interview.svg" alt="">
    <h1 class="text-center">Welcome to <span>Placement Cell</span></h1>
    <h5 class="text-center">We Will Support You In Your Entire Placement Journey</h5>
    <a href="" class="mt-3 btn btn-info btn-lg">Get Started</a>
  </main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="js/script.js"></script>
</body>
</html>