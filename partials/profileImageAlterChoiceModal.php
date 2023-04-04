<div class="modal fade" id="profileImageAlterChoiceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body d-grid gap-2">
        <button type="button" style="<?php if($user_details_fetch['profile_image_name']==''){echo 'display:none !important;';} ?>" id="askRemoveProfilePhotoBtn" data-bs-toggle="modal" data-bs-target="#removePhotoConfirmModal" class="btn btn-outline-danger btn-lg w-100">Remove Photo</button>
        <button type="button" id="changeProfilePhotoBtn" class="btn btn-outline-success btn-lg w-100"><?php if($user_details_fetch['profile_image_name']==''){echo 'Set Profile Photo';}else{echo 'Change Photo';} ?></button>
        <button type="button" id="profileImageAlterChoiceModalCloseBtn" class="btn btn-outline-secondary btn-lg w-100" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="removePhotoConfirmModal" tabindex="-1" aria-labelledby="removePhotoConfirmModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header"><h1 class="modal-title fs-5" id="exampleModalToggleLabel">Are you sure you want to remove photo?</h1></div>
      <div class="modal-body d-grid gap-2">
      <button type="button" style="<?php if($user_details_fetch['profile_image_name']==''){echo 'display:none !important;';} ?>" id="removeProfilePhotoBtn" class="btn btn-outline-danger btn-lg">Yes</button>
        <button type="button" data-bs-toggle="modal" id="profileImageRemoveChoiceModalCloseBtn" data-bs-target="#profileImageAlterChoiceModal" class="btn btn-outline-dark btn-lg" data-bs-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>