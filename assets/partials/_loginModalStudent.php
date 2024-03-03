<!-- Modal -->
<div class="modal fade" id="loginModalStudent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="loginModalLabel">Login As Student</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modalStudent" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="assets/partials/_handleLoginStudent.php" method="POST">
          <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username">
          </div>
          <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password">
              <div class="form-text">We'll never share your password with anyone else.</div>
              <div ></div>
          </div>
          <button type="submit" class="btn btn-success" name="submit">Login</button>
        <!-- Add anything here in the future -->
      </div>
    </div>
  </div>
</div>
