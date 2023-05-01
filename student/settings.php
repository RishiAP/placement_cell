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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
<link rel="stylesheet" href="../css/style.css">
<link rel="stylesheet" href="../css/mobile.css">
<link rel="stylesheet" href="../css/sidebars.css">
    <title>Document</title>
</head>
<body class="pt-0" style="overflow-y:hidden;">
    <?php
    if(!isset($_SESSION['user_id'])){
        header("location:/placement_cell/login/student_login.php");
    }
    require "../partials/_nav_sidebar.php";
    $style_fname="";
    $style_aca="";
    if($user_details_fetch['f_name']!=""){
        $style_fname='style="display: block; color: var(--bs-body-color);"';
    }
    if($user_details_fetch['high_school_marksheet_name']!=""){
        $style_aca='style="display: block; color: var(--bs-body-color);"';
    }
    ?>
    <main class="d-flex flex-column">
        <div id="page_message"></div>
        <div id="biodata" class="container">
            <div id="biodata_message" class="sticky-top"></div>
            <form action="">
                <h1 class="text-center">Update Biodata</h1>
                <div class="d-flex gap-3">
            <div class="input-group">
        <div class="myInputTag" <?php echo $style_fname; ?>>First Name</div>
        <input type="text" name="first_name" id="first_name" class="form-control plh-none mb-3" placeholder="First Name" value="<?php echo $user_details_fetch['f_name']; ?>" required>
</div>
            <div class="input-group">
        <div class="myInputTag" <?php echo $style_fname; ?>>Last Name</div>
        <input type="text" name="last_name" id="last_name" class="form-control plh-none mb-3" placeholder="Last Name" value="<?php echo $user_details_fetch['l_name']; ?>" required>
</div>
</div>
<div class="d-flex gap-3" id="email-phone">
            <div class="input-group">
        <div class="myInputTag" <?php echo $style_fname; ?>>Contact Email</div>
        <input type="email" name="contact_email" id="contact_email" class="form-control plh-none mb-3" placeholder="Contact Email" value="<?php echo $user_details_fetch['c_email']; ?>" required>
</div>
            <div class="input-group">
        <div class="myInputTag" <?php echo $style_fname; ?>>Phone No.</div>
        <input type="number" name="phone_no" id="phone_no" class="form-control plh-none mb-3" placeholder="Phone No." value="<?php echo $user_details_fetch['ph_no']; ?>" required>
</div>
</div>
<div class="d-flex gap-3 mb-3" id="dob-gender">
<div class="input-group" style="min-width:250px;">
<label for="DOB" class="input-group-text">Bate of Birth</label>
        <input type="date" name="DOB" id="DOB" class="form-control plh-none" style="border-top-left-radius: 0 !important; border-bottom-left-radius: 0 !important;" value="<?php echo $user_details_fetch['DOB']; ?>" max="<?php $time = strtotime("-18 year", time()); echo date("Y-m-d", $time);?>" required>
</div>
<div class="input-group">
<label for="gender" class="input-group-text">Gender</label>
<select name="gender" id="gender" class="form-select plh-none" required>
    <option value="">Select Gender</option>
    <option value="male" <?php if($user_details_fetch["gender"]==="MALE"){echo "selected";} ?>>Male</option>
    <option value="female" <?php if($user_details_fetch["gender"]==="FEMALE"){echo "selected";} ?>>Female</option>
    <option value="others" <?php if($user_details_fetch["gender"]==="OTHERS"){echo "selected";} ?>>Others</option>
    <option value="no_say" <?php if($user_details_fetch["gender"]==="PREFER NOT TO SAY"){echo "selected";} ?>>Prefer not to say</option>
</select>
</div>
</div>
<div class="input-group flex-nowrap mb-3 college-section">
        <div class="input-group"><div class="myInputTag" <?php echo $style_fname; ?>>University/College</div>
        <input type="text" name="graduation_institute" id="graduation_institute" class="form-control plh-none" placeholder="University/College" value="<?php echo $user_details_fetch['graduation_institute']; ?>" required></div>
        <div class="input-group"><div class="myInputTag" <?php echo $style_fname; ?>>Course</div>
        <input type="text" name="course_name" id="course_name" class="form-control plh-none" placeholder="Course" value="<?php echo $user_details_fetch['course_name']; ?>" required></div>
        <select name="graduation_status" id="graduation_status" class="form-select plh-none" required style="max-width:200px;">
            <option value="">Graduation Status</option>
            <option value="passed" <?php if($user_details_fetch["graduation_status"]==="PASSED"){echo "selected";} ?>>Passed</option>
            <option value="1year" <?php if($user_details_fetch["graduation_status"]==="YEAR1"){echo "selected";} ?>>1st Year</option>
            <option value="2year" <?php if($user_details_fetch["graduation_status"]==="YEAR2"){echo "selected";} ?>>2nd Year</option>
            <option value="3year" <?php if($user_details_fetch["graduation_status"]==="YEAR3"){echo "selected";} ?>>3rd Year</option>
            <option value="final_year" <?php if($user_details_fetch["graduation_status"]==="FINAL_YEAR"){echo "selected";} ?>>Final Year</option>
        </select>
</div>
<div class="input-group">
        <div class="myInputTag" <?php echo $style_fname; ?>>Address</div>
        <input type="text" name="address" id="address" class="form-control plh-none mb-3" placeholder="Address" <?php echo 'value="'.$user_details_fetch['address'].'"';?> required>
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
                echo '<option value="'.$value.'" ';
                if($value===$user_details_fetch['state']){
                    echo "selected";
                }
                echo '>'.$value.'</option>';
            }
        ?>
    </select>
        </div>
        <div class="input-group">
<label for="district" class="input-group-text">District</label>
    <select name="district" id="district" class="form-select plh-none" <?php if($style_fname==""){
        echo "disabled";
    } ?> required>
            <option value="">Select District</option>
            <?php
                if($style_fname!=""){
                    $districts=json_decode(file_get_contents("../data/statesAndDistrictsOfIndia(Updated).json"),true)[$user_details_fetch['state']];
                    foreach ($districts as $key => $value) {
                        echo '<option value="'.$value.'" ';
                        if($value===$user_details_fetch['district']){
                            echo "selected";
                        }
                        echo '>'.$value.'</option>';
                    }
                }
            ?>
    </select>
        </div>
        </div>
        <div class="d-flex mb-3 gap-2">
    <div class="input-group">
        <div class="myInputTag" <?php echo $style_fname; ?>>City</div>
        <input type="text" name="city" id="city" class="form-control plh-none" placeholder="City" value="<?php echo $user_details_fetch['city']; ?>" required>
</div>
    <div class="input-group">
        <div class="myInputTag" <?php echo $style_fname; ?>>PIN Code</div>
        <input type="number" list="pinCodes" name="PIN_Code" id="PIN_Code" class="form-control plh-none" placeholder="PIN Code" value="<?php echo $user_details_fetch['pin_code']; ?>" required <?php if($style_fname==""){echo "disabled";} ?>>
    </div>
    <datalist id="pinCodes">
<?php
    if($style_fname!=""){
        $all_pins=json_decode(file_get_contents("../data/pincodeModified.json"),true)[$user_details_fetch['state']][$user_details_fetch['district']];
        foreach ($all_pins as $key => $value) {
            echo '<option value="'.$value.'" ';
                echo '>'.$key.'</option>';
        }
    }
?>
</datalist>
        </div>
</div>
<div class="input-group">
        <div class="myInputTag" <?php echo $style_fname; ?>>Aadhar Number</div>
        <input type="number" name="aadhar_nno" id="aadhar_no" class="form-control plh-none mb-3" placeholder="Aadhar Number" value="<?php echo $user_details_fetch['aadhar_no']; ?>" required>
</div>
<button type="button" class="mt-3 btn btn-info btn-lg" id="biodata-update-btn">Update</button>
            </form>
        </div>
        <div id="resume" style="display:none;">
        <div id="resume_message"></div>
        <div class="input-group">
        <label for="resume_doc" class="input-group-text">Resume</label>
  <input type="file" accept=".pdf" class="form-control" id="resume_doc" aria-describedby="resume_doc_btn" aria-label="Upload">
  <button class="btn btn-outline-secondary" type="button" id="resume_doc_btn">Upload</button>
</div>
<div id="pdf_viewer" style="display:none;"></div>
</div>
<div id="academics" style="display:none;">
<div id="academics_message" class="sticky-top"></div>
    <h1 class="text-center">High School Board Examination Performance</h1>
    <div class="container" id="high-school-performance">
    <div class="input-group mb-3">
<label for="high_school_board" class="input-group-text">High School Board</label>
    <select name="high_school_board" id="high_school_board" class="form-select plh-none" required>
        <option value="">Select High School Board</option>
        <?php
            $boards=json_decode(file_get_contents("../data/IndianSchoolBoards.json"),true);
            $high_school_boards=$boards["10th"];
            foreach ($high_school_boards as $key => $value) {
                echo '<option value="'.$value.'"';
                if($value===$user_details_fetch['high_school_board']){echo "selected";}
                echo '>'.$value.'</option>';
            }
        ?>
    </select>
        </div>
        <div class="input-group mb-3">
<label for="high_school_name" class="myInputTag" <?php echo $style_aca; ?>>School/Institute Name</label>
    <input type="text" name="high_school_name" id="high_school_name" class="form-control nir plh-none" value="<?php echo $user_details_fetch['high_school_name']; ?>" placeholder="School/Institute Name" required>
        </div>
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
    <?php
        if($user_details_fetch['high_school_performance']!=""){
            $high_school_subs=json_decode($user_details_fetch['high_school_performance']);
            $counter=1;
            $total_marks_obt=0;
            $total_max_marks=0;
            $len=count($high_school_subs);
            if($len==0){
                echo '<tr>
                <th scope="row"></th>
                <td contenteditable="true"></td>
                <td contenteditable="true"></td>
                <td contenteditable="true"></td>
                <td style="border:none;"><i class="bi bi-plus-circle-fill" id="add_high_school_subject_btn" onclick="add_high_school_row()"></i></td>
              </tr>';
            }
            foreach ($high_school_subs as $key => $value) {
                echo '<tr>
                <th scope="row">'.$counter.'</th>
                <td contenteditable="true">'.$value->name.'</td>
                <td contenteditable="true">'.$value->obt.'</td>
                <td contenteditable="true">'.$value->max.'</td>
                <td style="border:none;">';
                if($counter==$len){
                    echo '<i class="bi bi-plus-circle-fill" id="add_high_school_subject_btn" onclick="add_high_school_row()"></i>';
                }
                else{
                    echo '<i class="bi bi-x-circle-fill remove_high_school_subject_btn" onclick="remove_high_school_row(this)"></i>';
                }
                echo '</td>
              </tr>';
              $counter++;
              $total_marks_obt+=$value->obt;
              $total_max_marks+=$value->max;
            }
        }
        else{
            echo '<tr>
            <th scope="row">1</th>
            <td contenteditable="true"></td>
            <td contenteditable="true"></td>
            <td contenteditable="true"></td>
            <td style="border:none;"><i class="bi bi-plus-circle-fill" id="add_high_school_subject_btn" onclick="add_high_school_row()"></i></td>
          </tr>';
        }
    ?>
  </tbody>
  <tr id="high-school-total">
      <th scope="col">></th>
      <th scope="col">Total</th>
      <th scope="col"><?php if($total_max_marks!=0){echo $total_marks_obt;} ?></th>
      <th scope="col"><?php if($total_max_marks!=0){echo $total_max_marks;} ?></th>
    </tr>
</table>
<div class="input-group mb-3">
<label for="percentage-high-school" class="input-group-text">Percentage</label>
    <input type="number" name="percentage-high-school" id="percentage-high-school" value="<?php if($total_max_marks!=0){echo $total_marks_obt/$total_max_marks*100;} ?>" class="form-control" disabled>
        </div>
        <div class="input-group mb-3">
            <label for="high-school-marksheet" class="input-group-text">High School Marksheet</label>
  <input type="file" accept=".pdf" class="form-control" id="high-school-marksheet" aria-describedby="high-school-marksheet-btn" aria-label="Upload" required>
</div>
<div id="high-school-marksheet-preview"></div>
    </div>
    <h1 class="text-center">Intermediate/Dimploma Examination Performance</h1>
    <div class="container" id="intermediate-performance">
        <div class="select-10plus-type d-flex gap-5 mb-3 align-items-center flex-wrap">
            <h4>10 + Type : </h4>
    <div class="form-check">
  <input class="form-check-input" type="radio" name="type_of_10plus" id="ten_2" checked>
  <label class="form-check-label" for="ten_2">
    Intermediate(10+2)
  </label>
</div>
<div class="form-check">
  <input class="form-check-input" type="radio" name="type_of_10plus" id="ten_3">
  <label class="form-check-label" for="ten_3">
    Diploma(10+3)
  </label>
</div>
    </div>
    <div class="input-group mb-3">
<label for="intermediate_board" class="input-group-text">Intermediate Board</label>
    <select name="intermediate_board" id="intermediate_board" class="form-select plh-none" required>
        <option value="">Select Intermediate Board</option>
        <?php
            $intermediate_boards=$boards["12th"];
            foreach ($intermediate_boards as $key => $value) {
                echo '<option value="'.$value.'"';
                if($value===$user_details_fetch['intermediate_board']){echo "selected";}
                echo '>'.$value.'</option>';
            }
        ?>
    </select>
        </div>
        <section class="input-group mb-3" id="study_field_section">
        <label for="ten_plus_institute" class="myInputTag">Field of Study</label>
        <input type="text" name="study_field" id="study_field" class="form-control plh-none nir" placeholder="Field of Study" required>
        </section>
        <div class="input-group mb-3">
<label for="ten_plus_institute" class="myInputTag" <?php echo $style_aca; ?>>School/Institute Name</label>
    <input type="text" name="ten_plus_institute" id="ten_plus_institute" class="nir form-control plh-none" value="<?php echo $user_details_fetch['ten_plus_institute']; ?>" placeholder="School/Institute Name" required>
        </div>
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
  <?php
        if($user_details_fetch['high_school_performance']!=""){
            $intermediate_subs=json_decode($user_details_fetch['intermediate_performance']);
            $counter=1;
            $total_marks_obt=0;
            $total_max_marks=0;
            $len=count($intermediate_subs);
            if($len==0){
                echo '<tr>
                <th scope="row"></th>
                <td contenteditable="true"></td>
                <td contenteditable="true"></td>
                <td contenteditable="true"></td>
                <td style="border:none;"><i class="bi bi-plus-circle-fill" id="add_intermediate_subject_btn" onclick="add_intermediate_row()"></i></td>
              </tr>';
            }
            foreach ($intermediate_subs as $key => $value) {
                echo '<tr>
                <th scope="row">'.$counter.'</th>
                <td contenteditable="true">'.$value->name.'</td>
                <td contenteditable="true">'.$value->obt.'</td>
                <td contenteditable="true">'.$value->max.'</td>
                <td style="border:none;">';
                if($counter==$len){
                    echo '<i class="bi bi-plus-circle-fill" id="add_high_school_subject_btn" onclick="add_intermediate_row()"></i>';
                }
                else{
                    echo '<i class="bi bi-x-circle-fill remove_high_school_subject_btn" onclick="remove_intermediate_row(this)"></i>';
                }
                echo '</td>
              </tr>';
              $counter++;
              $total_marks_obt+=$value->obt;
              $total_max_marks+=$value->max;
            }
        }
        else{
            echo '<tr>
            <th scope="row">1</th>
            <td contenteditable="true"></td>
            <td contenteditable="true"></td>
            <td contenteditable="true"></td>
            <td style="border:none;"><i class="bi bi-plus-circle-fill" id="add_high_school_subject_btn" onclick="add_intermediate_row()"></i></td>
          </tr>';
        }
    ?>
  </tbody>
  <tr id="intermediate-total">
      <th scope="col">></th>
      <th scope="col">Total</th>
      <th scope="col"><?php if($total_max_marks!=0){echo $total_marks_obt;} ?></th>
      <th scope="col"><?php if($total_max_marks!=0){echo $total_max_marks;} ?></th>
    </tr>
</table>
<div class="input-group mb-3">
<label for="percentage-intermediate" class="input-group-text">Percentage</label>
    <input type="number" name="percentage-intermediate" id="percentage-intermediate" class="form-control" value="<?php if($total_max_marks!=0){echo $total_marks_obt/$total_max_marks*100;} ?>" disabled>
        </div>
        <div class="input-group">
        <label for="intermediate-marksheet" class="input-group-text">Intermediate Marksheet</label>
  <input type="file" accept=".pdf" class="form-control" id="intermediate-marksheet" aria-describedby="intermediate-marksheet-btn" aria-label="Upload" required>
</div>
<div id="intermediate-marksheet-preview"></div>
    </div>
    <button type="button" id="academics-upload-btn" class="btn btn-info btn-lg d-block m-auto" style="width:fit-content;">Submit</button>
</div>
<?php require "../partials/_footer.php" ?>
    </main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<script src="https://documentservices.adobe.com/view-sdk/viewer.js"></script>
<script src="../js/script.js"></script>
<script src="../js/sidebars.js"></script>
<script src="../js/biodata.js"></script>
</body>
</html>