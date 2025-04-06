<?php session_start(); ?>
<?php include 'partials/header.php'; ?>
<?php include 'partials/sidebar.php'; ?>
<?php include 'config.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>DataTables</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">DataTables</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <!-- /.card-header -->
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">DataTable with default features</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>POST-ID</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Post-Date</th>
                    <th>Author</th>
                    <th>Thumbnail</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = "SELECT * FROM blogposts 
                          LEFT JOIN blogcategories ON blogposts.category = blogcategories.category_id 
                          LEFT JOIN blogusers ON blogposts.author = blogusers.id
                          ORDER BY post_id DESC";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                  ?>
                      <tr>
                        <td><?= $row['post_id'] ?></td>
                        <td><?= $row['title'] ?></td>
                        <td><?= $row['category_name'] ?></td>
                        <td><?= $row['post_date'] ?></td>
                        <td><?= $row['name'] ?></td>
                        <td><a href="../article.php?id=<?= $row['post_id'] ?>"><img src="upload/<?= $row['thumbnail'] ?>" alt="Thumbnail" class="img-fluid"></a></td>
                        <td>
                          <button class='btn btn-primary' onclick='showPasswordModal("edit", <?= $row['post_id'] ?>)'>Edit</button>
                          <button class='btn btn-danger' onclick='showPasswordModal("delete", <?= $row['post_id'] ?>)'>Delete</button>
                        </td>
                      </tr>
                  <?php
                    }
                  }
                  ?>
                </tbody>
                <tfoot>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
  <?php include 'partials/footer.php'; ?>
</div>
<!-- /.content-wrapper -->

<!-- Password Modal -->
<div class="modal fade" id="passwordModal" tabindex="-1" role="dialog" aria-labelledby="passwordModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="passwordModalLabel">Enter Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="passwordForm">
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <input type="hidden" id="actionType" name="actionType">
          <input type="hidden" id="postId" name="postId">
          <button type="submit" class="btn btn-primary">Submit</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  function showPasswordModal(action, postId) {
    document.getElementById('actionType').value = action;
    document.getElementById('postId').value = postId;
    $('#passwordModal').modal('show');
  }

  document.getElementById('passwordForm').addEventListener('submit', function(event) {
    event.preventDefault();
    var actionType = document.getElementById('actionType').value;
    var postId = document.getElementById('postId').value;
    var password = document.getElementById('password').value;

    // Perform AJAX request to verify password
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'verify_password.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        if (xhr.responseText === 'success') {
          if (actionType === 'edit') {
            window.location.href = 'edit.php?post_id=' + postId;
          } else if (actionType === 'delete') {
            window.location.href = 'delete-blog.php?post_id=' + postId;
          }
        } else {
          alert('Incorrect password. Please try again.');
        }
      }
    };
    xhr.send('password=' + encodeURIComponent(password) + '&post_id=' + postId);
  });
</script>