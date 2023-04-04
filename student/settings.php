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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/sidebars.css">
    <title>Document</title>
</head>
<body>
    <?php
      require "../partials/_nav_sidebar.php";
    if(!isset($_SESSION['user_id'])){
        header("location:/placement_cell/login/student_login.php");
    }
    
    ?>
    <main class="d-flex flex-column">
        <div id="page_message"></div>
        <div id="biodata" class="container">
            <form action="">
                <h1 class="text-center">Update Biodata</h1>
                <div class="d-flex gap-3">
            <div class="input-group">
        <div class="myInputTag">First Name</div>
        <input type="text" name="first_name" id="first_name" class="form-control plh-none mb-3" placeholder="First Name" required>
</div>
            <div class="input-group">
        <div class="myInputTag">Last Name</div>
        <input type="text" name="last_name" id="last_name" class="form-control plh-none mb-3" placeholder="Last Name" required>
</div>
</div>
<div class="d-flex gap-3" id="email-phone">
            <div class="input-group">
        <div class="myInputTag">Contact Email</div>
        <input type="email" name="contact_email" id="contact_email" class="form-control plh-none mb-3" placeholder="Contact Email" required>
</div>
            <div class="input-group">
        <div class="myInputTag">Phone No.</div>
        <input type="number" name="phone_no" id="phone_no" class="form-control plh-none mb-3" placeholder="Phone No." required>
</div>
</div>
<div class="d-flex gap-3 mb-3" id="dob-gender">
<div class="input-group" style="min-width:250px;">
<label for="DOB" class="input-group-text">Bate of Birth</label>
        <input type="date" name="DOB" id="DOB" class="form-control plh-none" style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important;" required>
</div>
<div class="input-group">
<label for="gender" class="input-group-text">Gender</label>
<select name="gender" id="gender" class="form-select plh-none" required>
    <option value="">Select Gender</option>
    <option value="male">Male</option>
    <option value="female">Female</option>
    <option value="others">Others</option>
    <option value="no_say">Prefer not to say</option>
</select>
</div>
</div>
<div class="input-group">
        <div class="myInputTag">Address</div>
        <input type="text" name="address" id="address" class="form-control plh-none mb-3" placeholder="Address" required>
</div>
<div class="d-flex gap-3 flex-wrap" id="defined-address">
<div class="d-flex mb-3 gap-3" id="state_and_district">
    <div class="input-group">
<label for="state" class="input-group-text">State</label>
    <select name="state" id="state" class="form-select plh-none" required>
        <option value="">Select State</option>
        <?php
            $states=json_decode(file_get_contents("../data/IndianStates.json"));
            foreach ($states as $key => $value) {
                echo '<option value="'.$value.'">'.$value.'</option>';
            }
        ?>
    </select>
        </div>
        <div class="input-group">
<label for="district" class="input-group-text">District</label>
    <select name="district" id="district" class="form-select plh-none" disabled required>
            <option value="">Select District</option>
    </select>
        </div>
        </div>
        <div class="d-flex mb-3 gap-2">
    <div class="input-group">
        <div class="myInputTag">City</div>
        <input type="text" name="city" id="city" class="form-control plh-none" placeholder="City" required>
</div>
    <div class="input-group">
        <div class="myInputTag">PIN Code</div>
        <input type="number" list="pinCodes" name="PIN_Code" id="PIN_Code" class="form-control plh-none" placeholder="PIN Code" required disabled>
    </div>
    <datalist id="pinCodes">
<option value="110">sun</option>
<option value="New York">
<option value="Seattle">
<option value="Los Angeles">
<option value="Chicago">
</datalist>
        </div>
</div>
<div class="input-group">
        <div class="myInputTag">Aadhar Number</div>
        <input type="number" name="aadhar_nno" id="aadhar_no" class="form-control plh-none mb-3" placeholder="Aadhar Number" required>
</div>
<button type="button" class="mt-3 btn btn-info btn-lg" id="biodata-update-btn">Update</button>
            </form>
        </div>
        <div id="resume" style="display:none;">
        <div class="input-group">
        <label for="resume_doc" class="input-group-text">Resume</label>
  <input type="file" accept=".pdf" class="form-control" id="resume_doc" aria-describedby="resume_doc_btn" aria-label="Upload">
  <button class="btn btn-outline-secondary" type="button" id="resume_doc_btn">Upload</button>
</div>
<div id="pdf_viewer" style="display:none;"></div>
</div>
<div id="academics" style="display:none;">
    <h1 class="text-center">High School Board Examination Performance</h1>
    <div class="container" id="high-school-performance">
    <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Subject/Course</th>
      <th scope="col">Marks Obtained</th>
      <th scope="col">Maximum Marks</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td contenteditable="true"></td>
      <td contenteditable="true"></td>
      <td contenteditable="true"></td>
      <td style="border:none;"><i class="bi bi-plus-circle-fill" id="add_high_school_subject_btn" onclick="add_high_school_row()"></i></td>
    </tr>
  </tbody>
  <tr id="high-school-total">
      <th scope="col">></th>
      <th scope="col">Total</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
</table>
<div class="input-group mb-3">
<label for="percentage-high-school" class="input-group-text">Percentage</label>
    <input type="number" name="percentage-high-school" id="percentage-high-school" class="form-control" disabled>
        </div>
        <div class="input-group mb-3">
            <label for="high-school-marksheet" class="input-group-text">High School Marksheet</label>
  <input type="file" accept=".pdf" class="form-control" id="high-school-marksheet" aria-describedby="high-school-marksheet-btn" aria-label="Upload">
</div>
<div id="high-school-marksheet-preview"></div>
    </div>
    <h1 class="text-center">Intermediate Examination Performance</h1>
    <div class="container" id="intermediate-performance">
    <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Subject/Course</th>
      <th scope="col">Marks Obtained</th>
      <th scope="col">Maximum Marks</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td contenteditable="true"></td>
      <td contenteditable="true"></td>
      <td contenteditable="true"></td>
      <td style="border:none;"><i class="bi bi-plus-circle-fill" id="add_intermediate_subject_btn" onclick="add_intermediate_row()"></i></td>
    </tr>
  </tbody>
  <tr id="intermediate-total">
      <th scope="col">></th>
      <th scope="col">Total</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
</table>
<div class="input-group mb-3">
<label for="percentage-intermediate" class="input-group-text">Percentage</label>
    <input type="number" name="percentage-intermediate" id="percentage-intermediate" class="form-control" disabled>
        </div>
        <div class="input-group">
        <label for="intermediate-marksheet" class="input-group-text">Intermediate Marksheet</label>
  <input type="file" accept=".pdf" class="form-control" id="intermediate-marksheet" aria-describedby="intermediate-marksheet-btn" aria-label="Upload">
</div>
<div id="intermediate-marksheet-preview"></div>
    </div>
    <button type="button" id="academics-upload-btn" class="btn btn-info btn-lg d-block m-auto" style="width:fit-content;">Submit</button>
</div>
    </main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://documentservices.adobe.com/view-sdk/viewer.js"></script>
<script src="../js/script.js"></script>
<script src="../js/sidebars.js"></script>
<script src="../js/biodata.js"></script>
</body>
</html>