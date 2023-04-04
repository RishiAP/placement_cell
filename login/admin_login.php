<?php
    session_start();
    if(isset($_POST['logOut'])){
        require "../partials/_logOut.php";
    }
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>Document</title>
</head>
<body>
    <?php
        require "../partials/_nav.php";
    ?>
    <h1 class="text-center">Admin Log In</h1>
    <form action="" onkeydown="return event.key != 'Enter'" method="post" id="login_form" class="container">
    <div class="input-group">
        <div class="myInputTag">Email or Username</div>
        <input type="text" name="username" id="username" class="form-control plh-none mb-3" placeholder="Email or Username">
</div>
    <div class="input-group">
        <div class="myInputTag">Password</div>
        <input type="password" name="password" id="password" class="form-control plh-none mb-3" placeholder="Password">
        <span class="eye">
        <i class="bi bi-eye"></i>
        </span>
</div>
<div class="mb-3" style="position:relative; min-height:1.5rem;">
    <a href="#" onclick="return false;" id="forget_pass_btn">Forget Password?</a>
</div>
<div class="w-100" id="login-btn-div">
<button type="button" id="login-btn" class="btn btn-lg btn-info">Log In</button></div>
<button type="submit" style="display:none;"></button>
    </form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="../js/script.js"></script>
<script src="../js/admin_login.js"></script>
</body>
</html>