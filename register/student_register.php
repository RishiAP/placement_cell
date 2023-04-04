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
    <title>Document</title>
</head>
<body>
    <?php
        require "../partials/_nav.php";
    ?>
    <h1 class="text-center">Register</h1>
    <form action="" method="post" onkeydown="return event.key != 'Enter'" id="stu_register_form" class="container">
        
        <div class="input-group mb-3">
        <select name="register_as" id="register_as" class="form-select" disabled>
            <option value="student">Register as Student</option>
        </select>
</div>
        <div class="input-group">
        <div class="myInputTag">Name</div>
        <input type="text" name="person_name" id="person_name" class="form-control plh-none mb-3" placeholder="Name">
</div>
<div class="input-group">
        <div class="myInputTag">Email Address</div>
        <input type="email" name="email" id="email" class="form-control plh-none mb-3" placeholder="Email Address">
</div>
<div class="input-group">
        <div class="myInputTag">Choose Username</div>
        <input type="text" name="username" id="username" class="form-control plh-none mb-3" placeholder="Choose Username">
</div>
<div class="input-group">
        <div class="myInputTag">Create Password</div>
        <input type="password" name="password" id="password" class="form-control plh-none mb-3" placeholder="Create Password">
</div>
<div class="input-group">
        <div class="myInputTag">Confirm Password</div>
        <input type="password" name="cnf_password" id="cnf_password" class="form-control plh-none mb-3" placeholder="Confirm Password">
</div>
<div class="pass_message">
<div class="alert alert-success" style="display:none;" role="alert">
  
</div>
</div>
<div class="input-text">
<input type="checkbox" name="show_password" id="show_password"> <label for="show_password">Show Password</label>
</div>
<div class="w-100" id="register-btn-div">
<button type="button" id="register-btn" class="btn btn-lg btn-info">Register</button></div>
<button type="submit" style="display:none;"></button>
    </form>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="../js/script.js"></script>
<script src="../js/register_student.js"></script>
</body>
</html>