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
    <title>(@<?php echo $user_details_fetch['user_name'].') ';
    echo $user_details_fetch['person_name']; ?></title>
</head>
<body>
    <?php
    if(!(isset($_SESSION['company_id']) || isset($_SESSION['admin_id']))){
      header("location:/placement_cell/");
    }
    require "../partials/_nav.php";
    require "../partials/student_docs_details_modal.php";
    ?>
    <!--Time Select Modal -->
<div class="modal fade" id="interviewTimeModal" tabindex="-1" aria-labelledby="interviewTimeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="interviewTimeModalLabel">Confirm Approval</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check-circle-fill" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </symbol>
  <symbol id="info-fill" viewBox="0 0 16 16">
    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
  </symbol>
  <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
</svg>
      <div class="modal-body">
        <form action="">
        <div class="input-group mb-3" style="flex-wrap:nowrap;">
            <select name="currency" id="currency" class="form-select plh-none" style="min-width:100px; width:45%;">
                <?php
                    $data=json_decode(file_get_contents("../data/currencies.json"),true);
                    foreach ($data as $key => $value) {
                        echo '<option value="'.$value['code'].'">'.$value['code']." (".$value['name'].')</option>';
                    }
                ?>
            </select>
            <div class="input-group">
        <div class="myInputTag">Amount</div>
        <input type="number" name="amount" id="amount" class="form-control plh-none" placeholder="Amount" required>
                </div>
</div>
        </form>
<div class="alert alert-danger d-flex align-items-center" role="alert">
  <svg class="bi flex-shrink-0 me-2" width="1rem" height="1rem" fill="currentColor" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
  <div>
    <strong>Warning !</strong>
    <p>Once you confirm approval its not reversible</p>
  </div>
</div>
      </div>
      <div class="modal-footer">
        <h5>Are you sure you want to approve?</h5>
          <button type="button" id="candidateApproveButton" class="btn btn-success">Yes</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
    <main>
      <section id="base-info-section" class="d-flex container-fluid">
        <section class="user-left-section">
                <?php
                    echo '<div class="image_area">
                        <img oncontextmenu="return false;" src="';
                        if($user_details_fetch['profile_image_name']=='')
                        {
                          echo '/placement_cell/img/default_user_image_'.$_SESSION['theme'].'.svg';
                        }
                        else{   
                        echo 'data:image/'.$ext.';base64,'.$image_base64;
                        }
                        echo '" id="user_profile_photo" class="img-circle profile-image" />
                  </div>';
                ?>
        </section>
        <section class="user-right-section">
            <h1 id="username" class="d-flex align-items-center gap-3"><?php echo $user_details_fetch['user_name']; 
              echo '<span id="ban_badge" class="badge rounded-pill text-bg-danger fs-6" ';
              if($user_details_fetch['banned']){
                echo 'style="display:"';
              }
              else{
                echo 'style="display:none"';
              }
              echo '>Banned</span>';
            ?></h1>
            <h2 id="person_name"><?php if($user_details_fetch['f_name']!=""){ echo $user_details_fetch['f_name']." ".$user_details_fetch['l_name'];}?></h2>
                <?php
                if($user_details_fetch['f_name']!=""){
                    echo '<p class="text-large"><i class="bi bi-mortarboard-fill"></i> Student of '.$user_details_fetch['course_name'].' at '.$user_details_fetch['graduation_institute'].'</p>
                    <p class="d-flex flex-column">
                    <span><i class="bi bi-geo-alt-fill text-danger"></i>'.$user_details_fetch['address'].'</span><span>'.$user_details_fetch['city'].", ".$user_details_fetch['district'].", ".$user_details_fetch['state']." - ".$user_details_fetch['pin_code'].'</span>
                    </p>';
                }
                ?>
                <section class="contact-section d-flex gap-5" style="<?php if($user_details_fetch['f_name']==""){echo 'display:none;';} ?>">
                    <p><a href="mailto:<?php echo $user_details_fetch['c_email']; ?>"><i class="bi bi-envelope-at"></i> <?php
                        echo $user_details_fetch['c_email']
                    ?></a></p>
                    <p><a href="tel:+91<?php echo $user_details_fetch['ph_no']; ?>"><i class="bi bi-telephone"></i>
                    <?php
                        echo $user_details_fetch['ph_no']
                    ?></a></p>
                </section>
                <section>
            <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#student_docs_details_modal" data-bs-type="doc_high_school" style="<?php if($user_details_fetch['high_school_marksheet_name']==""){echo 'display:none;';} ?>">High School Marksheet</button>
            <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-type="doc_<?php echo $user_details_fetch['ten_plus_type']; ?>" data-bs-target="#student_docs_details_modal" style="<?php if($user_details_fetch['intermediate_marksheet_name']==""){echo 'display:none;';} ?>"><?php echo ucfirst($user_details_fetch['ten_plus_type']); ?> Marksheet</button>
            <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-type="doc_resume" data-bs-target="#student_docs_details_modal" style="<?php if($user_details_fetch['resume_doc_name']==""){echo 'display:none;';} ?>">Resume</button>
            <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-type="academic_performance" data-bs-target="#student_docs_details_modal" style="<?php if($user_details_fetch['high_school_performance']==="[]"){echo 'display:none;';} ?>">Academic Performance</button>
              </section>
            <?php
            $approved=false;
            if(isset($_SESSION['company_id'])){
            try {
              $amount=isset(json_decode($user_details_fetch['offers'],true)[(string)$_SESSION['company_id']])? json_decode($user_details_fetch['offers'],true)[(string)$_SESSION['company_id']]:null;
            } catch (\Throwable $th) {
              //throw $th;
            }
            $approved=isset($amount);
              if(isset($_SESSION['company_id'])){
                echo '<button type="button" class="w-100 btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#interviewTimeModal"';
                if($user_details_fetch['banned'] || $approved){
                  echo ' disabled';
                }
                echo '>';
                if($approved){
                  echo "Approved";
                }
                else{
                  echo "Approve";
                }
                echo' <i class="bi bi-check-circle-fill"></i></button>';
              }
            }
              elseif (isset($_SESSION['admin_id'])) {
                echo '';
                if($user_details_fetch['banned']){
                  echo '<button type="button" id="ban_unban_btn" class="w-100 btn btn-outline-success" onclick="unban_user()">Unban Student <i class="bi bi-arrow-clockwise"></i></button>';
                }else{
                  echo '<button type="button" id="ban_unban_btn" class="w-100 btn btn-outline-danger" onclick="ban_user()">Ban Student <i class="bi bi-slash-circle"></i></button>';
                }
              }
            ?>
        </section>
            </section>
        <section class="d-flex container flex-column">
        <?php
        if(isset($_SESSION['company_id']) && $approved){
          echo '<div class="card mb-3 mt-5">';
          if($user_details_fetch['accepted_offer']==$_SESSION['company_id']){
            echo '<span class="badge rounded-pill text-bg-success shadow-lg" style="font-size:1rem; width:fit-content; position:absolute; right:1rem; top:1rem;">Accepted</span>';
          }
          elseif ($user_details_fetch['accepted_offer']==0) {
            echo '<span class="badge rounded-pill text-bg-warning shadow-lg" style="font-size:1rem; width:fit-content; position:absolute; right:1rem; top:1rem;">Pending</span>';
          }
          else{
            echo '<span class="badge rounded-pill text-bg-danger shadow-lg" style="font-size:1rem; width:fit-content; position:absolute; right:1rem; top:1rem;">Dismissed</span>';
          }
          echo '<div class="row g-0">
                <div class="col-md-4 d-flex align-items-center justify-content-center">
                  <img src="'.$company_details_fetch['company_logo_url'].'" class="img-fluid" alt="...">
                </div>
                <div class="col-md-8">
                  <div class="card-body">
                    <h5 class="card-title">'.$company_details_fetch['company_name'].'</h5>
                    <div class="card-text d-flex align-items-center gap-2"><h6 style="display:inline;" class="m-0">Offer : </h6> '.$amount.'</div>
                    <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                  </div>
                </div>
              </div>
            </div>';
        }
        else if(isset($_SESSION['admin_id'])){
            echo '<h1 class="text-center">Offers</h1>';
            $offers=json_decode($user_details_fetch['offers'],true);
            if($user_details_fetch['accepted_offer']!=0){
            $accepted_offer_company=mysqli_fetch_assoc(mysqli_query($conn_stu,"SELECT * FROM `company` WHERE `company_id`='{$user_details_fetch['accepted_offer']}'"));
            echo '<div class="card mb-3">
            <span class="badge rounded-pill text-bg-success shadow-lg" style="font-size:1rem; width:fit-content; position:absolute; right:1rem; top:1rem;">Accepted</span>
                <div class="row g-0">
                  <div class="col-md-4 d-flex align-items-center justify-content-center">
                    <img src="'.$accepted_offer_company['company_logo_url'].'" class="img-fluid" alt="...">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title">'.$accepted_offer_company['company_name'].'</h5>
                      <div class="card-text d-flex align-items-center gap-2"><h6 style="display:inline;" class="m-0">Offer : </h6> '.$offers[(string)$user_details_fetch['accepted_offer']].'</div>
                      <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                    </div>
                  </div>
                </div>
              </div>';
            }
            foreach ($offers as $key => $value) {
                if(!($user_details_fetch['accepted_offer']!=0 && $key==$user_details_fetch['accepted_offer'])){
                $company_details=mysqli_fetch_assoc(mysqli_query($conn_stu,"SELECT * FROM `company` WHERE `company_id`='$key'"));
                echo '<div class="card mb-3">
                <div class="row g-0">
                  <div class="col-md-4 d-flex align-items-center justify-content-center">
                    <img src="'.$company_details['company_logo_url'].'" class="img-fluid" alt="...">
                  </div>
                  <div class="col-md-8">
                    <div class="card-body">
                      <h5 class="card-title">'.$company_details['company_name'].'</h5>
                      <div class="card-text d-flex align-items-center gap-2"><h6 style="display:inline;" class="m-0">Offer : </h6> '.$value.'</div>
                      <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
                    </div>
                  </div>
                </div>
              </div>';
                    }
            }
          }
        ?>
        </section>
    </main>
<?php require "../partials/_footer.php" ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://documentservices.adobe.com/view-sdk/viewer.js"></script>
<script src="../js/script.js"></script>
<?php
    $KEYS=parse_ini_file("../keys.env");
    echo '<script>AdobeDC_Key="'.$KEYS['AdobeDC_Key'].'"</script>';
?>
<script src="../js/fetch_student_data.js"></script>
<script>
  document.getElementById('candidateApproveButton').addEventListener('click',function () {
    const xhr2=new XMLHttpRequest();
  //Object the object
  // xhr.open('GET','rishi.txt',true);
  xhr2.open('POST','/placement_cell/partials/_approve_candidate.php',true);
  //What to do on progress(optional)
  xhr2.onprogress=function(){
  }
  //What to do when response is ready
  xhr2.setRequestHeader("Content-type", "application/json");
  xhr2.onload=function(){
    document.getElementById('interviewTimeModal').querySelector(".btn-close").click();
    if(this.responseText==="banned"){
      document.getElementById('page_main_message').innerHTML=`<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Sorry!</strong>This action cannot be performed. Student is currently banned.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>`;
    }
    else if(this.responseText==true){
      document.getElementById('page_main_message').innerHTML=`<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> @`+window.location.href.split('/')[5]+` has been offered placement worth `+document.getElementById('amount').value+" "+document.getElementById('currency').value+`.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>`;
      document.querySelector('main').querySelector('button[data-bs-target="#interviewTimeModal"]').innerHTML=`Approved <i class="bi bi-check-circle-fill"></i>`;
      document.querySelector('main').querySelector('button[data-bs-target="#interviewTimeModal"]').setAttribute("disabled","true");
    }
  }
      xhr2.send(`{"username":"`+document.location.href.split('/')[5]+`","amount":"`+document.getElementById('amount').value+" "+document.getElementById('currency').value+`"}`);
})
</script>
<?php
  if(isset($_SESSION['admin_id'])){
    echo '<script src="../js/ban_unban.js"></script>';
  }
?>
</body>
</html>