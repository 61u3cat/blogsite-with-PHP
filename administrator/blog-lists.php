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
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $sql = "SELECT * FROM blogposts LEFT JOIN blogcategories ON blogposts.category=blogcategories.category_id LEFT JOIN blogusers ON blogposts.author = blogusers.id
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
                        <td>
                          <a href='edit.php?post_id=<?= $row['post_id'] ?>' class='btn btn-primary'>Edit</a>
                          <a href='delete.php?post_id=<?= $row['post_id'] ?>' class='btn btn-danger' onclick='return confirm("are you sure?")'>Delete</a>
                        </td>
                    <?php
                    }
                  }
                    ?>

                      </tr>
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


<!-- Control Sidebar -->