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
    <?php
        $companies_query=mysqli_query($conn_stu,"SELECT * FROM `company`");
        $user_company_applied=json_decode($user_details_fetch['applied']);
        while ($company=mysqli_fetch_assoc($companies_query)) {
          if(!in_array($company['company_id'],$user_company_applied)){
            echo '<div class="card mb-3">
            <div class="row g-0">
              <div class="col-md-4 company_favicon_section">
                <img src="'.$company['company_logo_url'].'" class="img-fluid" alt="...">
              </div>
              <div class="col-md-8">
                <div class="card-body">
                  <h5 class="card-title">'.$company['company_name'].'</h5>
                  <p class="card-text">'.$company['company_description'].'</p>
                  <p class="card-text d-flex justify-content-between align-items-center"><small class="text-body-secondary">Last updated 3 mins ago</small>
                  <button type="button" onclick="apply_placement(this)" class="btn btn-success" data-bs-company-id="'.$company['company_id'].'" data-bs-company-name="'.$company['company_name'].'">Apply</button></p>
                </div>
              </div>
            </div>
          </div>';
          }
        }
    ?>
    </main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="../js/script.js"></script>
<script>
    function apply_placement(e){
      window.apply_button=e;
      company_name=e.getAttribute("data-bs-company-name");
    const xhr2=new XMLHttpRequest();
  //Object the object
  // xhr.open('GET','rishi.txt',true);
  xhr2.open('POST','/placement_cell/partials/_apply_placement.php',true);
  //What to do on progress(optional)
  xhr2.onprogress=function(){
  }
  //What to do when response is ready
  xhr2.setRequestHeader("Content-type", "application/json");
  xhr2.onload=function(){
    if(this.responseText==true){
      window.apply_button.innerText="Applied";
      window.apply_button.setAttribute("disabled","true");
      document.getElementById('page_main_message').innerHTML=`<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> You have successfully applied for placement in <strong>`+company_name+`</strong>.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>`;
    }
    else if(this.responseText==="banned"){
      window.location.href="/placement_cell/login/student_login.php";
    }
  }
      xhr2.send(`{"company_id":`+e.getAttribute('data-bs-company-id')+`}`);
}
</script>
</body>
</html>