<!-- Modal -->
<div class="modal fade" id="logOutModal" tabindex="-1" aria-labelledby="logOutModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="logOutModalLabel">Are you sure you want to log out?</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <button type="button" class="btn btn-success w-100 btn-lg mb-3" data-bs-dismiss="modal">Cancel</button>
        <form action="/placement_cell/login/student_login.php" method="post">
            <button type="submit" name="logOut" class="btn btn-danger w-100 btn-lg">Log Out</button>
        </form>
      </div>
    </div>
  </div>
</div>