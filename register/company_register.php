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
    <title>Comapany Register | Placement Cell</title>
</head>
<body>
    <?php
        require "../partials/_nav.php";
    ?>
    <h1 class="text-center">Register</h1>
    <form action="" method="post" onkeydown="return event.key != 'Enter'" id="stu_register_form" class="container">
        
        <div class="input-group mb-3">
        <select name="register_as" id="register_as" class="form-select" disabled>
            <option value="student">Register as Company</option>
        </select>
</div>
<div class="input-group">
        <div class="myInputTag">Company Name</div>
        <input type="text" name="username" id="username" class="form-control plh-none mb-3" placeholder="Company Name" required>
</div>
<div class="input-group mb-3">
        <div class="myInputTag">Email Address</div>
        <input type="email" name="email" id="email" class="form-control plh-none" placeholder="Email Address" required>
    </div>
    <div class="input-group mb-3 align-items-center">
        <div class="myInputTag">Company website URL</div>
        <input type="url" name="c_url" id="c_url" class="form-control plh-none" placeholder="Company website URL" required>
        <div class="d-flex align-items-center" style="
    position: absolute;
    right: 0.375rem;
    z-index: 1;
"><img src="" alt="" id="company_favicon" style="z-index: 1;
    max-height: 36px;
    top: 1px;"></div>
    </div>
<div class="input-group">
        <div class="myInputTag">Company Logo URL</div>
        <input type="url" name="logo_url" id="logo_url" class="form-control plh-none mb-3" placeholder="Company Logo URL" required>
</div>
<div class="container mb-3 d-flex justify-content-center align-items-center"><div class="d-flex justify-content-center align-items-center" style="border:1px solid black; width:200px; height:200px; padding:1rem; box-shadow: 0 0 0 1px black"><img src="" alt="" id="c_logo" style="max-width:100%; max-height:100%;"></div></div>
<div class="input-group">
        <div class="myInputTag">Create Password</div>
        <input type="password" name="password" id="password" class="form-control plh-none mb-3" placeholder="Create Password" required>
</div>
<div class="input-group">
        <div class="myInputTag">Confirm Password</div>
        <input type="password" name="cnf_password" id="cnf_password" class="form-control plh-none mb-3" placeholder="Confirm Password" required>
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
<script src="../js/register_company.js"></script>
</body>
</html>