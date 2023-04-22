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
    <style>
        .cropper-view-box , .cropper-face{
          border-radius:50% !important;
        }
  
      .image_area {
        position: relative;
      }
  
      #imageCroppingModal img {
          display: block;
          max-width: 100%;
      }
  
      .preview {
          overflow: hidden;
          width: 160px !important; 
          height: 160px !important;
          margin: auto;
          border: 1px solid red;
          display:none !important;
      }
  
      .modal-lg{
          max-width: 1000px !important;
      }
  
      .overlay {
        position: absolute;
        bottom: 0px;
        left: 0;
        right: 0;
        background-color: rgba(255, 255, 255, 0.5);
        overflow: hidden;
        height: 0;
        transition: .5s ease;
        width: 100%;
        margin: auto;
      }
  
      .image_area:hover .overlay {
        height: 50%;
        cursor: pointer;
      }
      .photoHelpText {
        color: #333;
        font-size: 20px;
        position: absolute;
        top: 50%;
        left: 50%;
        width:100%;
        max-width:300px;
        -webkit-transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        text-align: center;
      }
      #sample_image{
        max-height: calc(100vh - 230px);
      }
    </style>
    <title>Document</title>
</head>
<body>
    <?php
    if(!isset($_SESSION['user_id'])){
        header("location:/placement_cell/login/student_login.php");
    }
    else{
        require "../partials/profileImageAlterChoiceModal.php";
        require "../partials/_image_cropping_modal.php";
    }
    require "../partials/_nav.php";
    require_once "../vendor/autoload.php";
    $approved=json_decode($user_details_fetch['approved']);
    use \Ds\Set;
    $seen_set=new Set(array_merge($approved->unseen,$approved->seen));
    $saving_data=json_encode(array(
        "seen"=>$seen_set->toArray(),
        "unseen"=>array()
    ));
    mysqli_query($conn_stu,"UPDATE `student` SET `approved`='$saving_data' WHERE `user_id`='{$_SESSION['user_id']}'")
    ?>
    <main class="d-flex container flex-column">
        <?php
            echo '<h1 class="text-center">Your Offers</h1>';
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
                      <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small><button class="btn btn-success" style="position:absolute; bottom:1rem; right:1rem;" ';
                      if($user_details_fetch['accepted_offer']==0){
                        echo 'data-company-id="'.$key.'" onclick="accept_offer(this)" data-company-name="'.$company_details['company_name'].'" data-placement-amount="'.$value.'"';
                      }
                      else{
                        echo 'disabled';
                      }
                      echo '>Accept Offer</button></p>
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
    function accept_offer(e) {
        window.accept_btn=e;
        const xhr2=new XMLHttpRequest();
  //Object the object
  // xhr.open('GET','rishi.txt',true);
  xhr2.open('POST','/placement_cell/partials/_accept_offer.php',true);
  //What to do on progress(optional)
  xhr2.onprogress=function(){
  }
  //What to do when response is ready
  xhr2.setRequestHeader("Content-type", "application/json");
  xhr2.onload=function(){
    if(this.responseText==="banned"){
        window.location.href="/placement_cell/login/student_login.php";
    }
    else if(this.responseText==true){
        document.getElementById('page_main_message').innerHTML=`<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong>You accepted the offer of <strong>`+window.accept_btn.getAttribute("data-placement-amount")+`</strong> from <strong>`+window.accept_btn.getAttribute("data-company-name")+`</strong>.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>`;
    }
  }
      xhr2.send(`{"company_id":`+e.getAttribute("data-company-id")+`}`);
    }
</script>
</body>
</html>