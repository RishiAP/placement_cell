<!-- Modal -->
<div class="modal fade" id="student_docs_details_modal" tabindex="-1" aria-labelledby="student_docs_details_modalLabel" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="student_docs_details_modalLabel"></h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        <div id="docs_show_modal_message"></div>
        <div id="doc_high_school"></div>
        <div id="doc_intermediate"></div>
        <div id="doc_resume"></div>
        <div id="academic_performance">
          <h1 class="text-center">High School Performance</h1>
          <section class="container">
            <h6 style="display:inline;"><strong>Intermediate Board : </strong></h6>
            <p style="display:inline;" id="high_school_board"><?php echo $user_details_fetch['high_school_board']; ?></p>
          </section>
          <section class="container">
            <h6 style="display:inline;"><strong>Intermediate Institute : </strong></h6>
            <p style="display:inline;" id="high_school_name"><?php echo $user_details_fetch['high_school_name']; ?></p>
          </section>
        <table class="container table table-bordered">
  <thead>
    <tr>
      <th scope="col">S. No.</th>
      <th scope="col">Subject/Course</th>
      <th scope="col">Marks Obtained</th>
      <th scope="col">Maximum Marks</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $high_school_performance=json_decode($user_details_fetch['high_school_performance']);
      $counter=1;
      $total_marks_obtained=0;
      $total_max_marks=0;
      foreach ($high_school_performance as $key => $value) {
        echo '<tr>
        <th scope="row">'.$counter.'</th>
        <td>'.$value->name.'</td>
        <td>'.$value->obt.'</td>
        <td>'.$value->max.'</td>
      </tr>';
      $total_max_marks+=$value->max;
      $total_marks_obtained+=$value->obt;
      $counter++;
      }
      echo '<tr>
        <th scope="row">></th>
        <th>Total</th>
        <td>'.$total_marks_obtained.'</td>
        <td>'.$total_max_marks.'</td>
      </tr>';
    ?>
  </tbody>
</table>
<section class="container">
  <h6 style="display:inline;"><strong>Percentage : </strong></h6>
  <p style="display:inline;" id="high_school_percentage"><?php if($total_max_marks!=0){echo $total_marks_obtained/$total_max_marks*100;
  echo " %";} ?></p>
</section>
<h1 class="text-center">Intermediate/Diploma Performance</h1>
<section class="container" <?php if($user_details_fetch['ten_plus_type']==="diploma"){echo 'style="display:none;"';} ?>>
  <h6 style="display:inline;"><strong>Intermediate Board : </strong></h6>
  <p style="display:inline;" id="intermediate_board"><?php echo $user_details_fetch['intermediate_board']; ?></p>
</section>
<section class="container">
  <h6 style="display:inline;"><strong><?php echo ucfirst($user_details_fetch['ten_plus_type']); ?> Institute : </strong></h6>
  <p style="display:inline;" id="ten_plus_institute"><?php echo $user_details_fetch['ten_plus_institute']; ?></p>
</section>
<table class="container table table-bordered">
  <thead>
    <tr>
      <th scope="col">S. No.</th>
      <th scope="col">Subject/Course</th>
      <th scope="col">Marks Obtained</th>
      <th scope="col">Maximum Marks</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $intermediate_performance=json_decode($user_details_fetch['intermediate_performance']);
      $counter=1;
      $total_marks_obtained=0;
      $total_max_marks=0;
      foreach ($intermediate_performance as $key => $value) {
        echo '<tr>
        <th scope="row">'.$counter.'</th>
        <td>'.$value->name.'</td>
        <td>'.$value->obt.'</td>
        <td>'.$value->max.'</td>
      </tr>';
      $total_max_marks+=$value->max;
      $total_marks_obtained+=$value->obt;
      $counter++;
      }
      echo '<tr>
        <th scope="row">></th>
        <th>Total</th>
        <td>'.$total_marks_obtained.'</td>
        <td>'.$total_max_marks.'</td>
      </tr>';
    ?>
  </tbody>
</table>
<section class="container">
  <h6 style="display:inline;"><strong>Percentage : </strong></h6>
  <p style="display:inline;" id="intermediate_percentage"><?php if($total_max_marks!=0){echo $total_marks_obtained/$total_max_marks*100;
  echo " %";} ?></p>
</section>
        </div>
      </div>
    </div>
  </div>
</div>