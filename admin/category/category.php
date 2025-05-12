<?php
include '../../db_connect/connection.php';
include './../admin_layout/header.php';
include './../admin_layout/sidebar.php';
?>

<!-- SweetAlert Script -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Add Category</h1>
    </div>
    <div class="section-body">
      <div class="row mb-2">
        <div class="col-12 col-md-12 col-lg-12 text-right mb-2">
          <a href="list.php" class="btn btn-primary">List Category</a>
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-md-6 col-lg-6">
          <div class="card">
            <div class="card-header">
              <h4>Category</h4>
            </div>
            <div class="card-body">
              <form action="" id="form" method="post" class="needs-validation" novalidate>
                <div class="form-group">
                  <label>Category Name</label>
                  <input type="text" class="form-control" name="name" required>
                  <div class="invalid-feedback">
                    Please fill in category name.
                  </div>
                </div>

                <div class="form-group">
                  <label>Select Status</label>
                  <select class="form-control" id="status" name="status" required>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                  </select>
                </div>

                <button type="submit" class="btn btn-primary" name="submit" style="width: 150px; margin-left: 200px;">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<?php include './../admin_layout/footer.php'; ?>

<?php
if (isset($_POST['submit'])) {
  $name = mysqli_real_escape_string($con, $_POST['name']);
  $status = mysqli_real_escape_string($con, $_POST['status']);

  // Check if category name already exists
  $check = mysqli_query($con, "SELECT * FROM categories WHERE name = '$name'");
  if (mysqli_num_rows($check) > 0) {
    echo "<script>swal('Category already exists!', '', 'error');</script>";
    return;
  }

  // Insert into database without image
  $query = "INSERT INTO categories (name, status) VALUES ('$name', '$status')";
  if (mysqli_query($con, $query)) {
    echo "<script>swal('Category added successfully!', '', 'success');</script>";
  } else {
    echo "<script>swal('Database error!', '', 'error');</script>";
  }
}
?>
