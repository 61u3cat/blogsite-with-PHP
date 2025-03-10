<?php 
session_start();
if (!isset($_SESSION["auth"])) {
  header("Location: index.php");
  exit;
}
include 'partials/header.php';
include 'partials/sidebar.php';
include "config.php";
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Write a blog</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Create Blogs</a></li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <form action="save-post.php" method="post" enctype="multipart/form-data">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Create a new blog post</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" id="title" name="post_title" class="form-control" placeholder="Enter title" required>
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <textarea id="summernote" name="description" class="form-control" placeholder="Write your blog description here" required></textarea>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Category</label>
          <select name="category" class="form-control">
            <option disabled>Select Category</option>
            <?php
            include "config.php";
            $sql = "SELECT * FROM blogcategories";

            $result = mysqli_query($conn, $sql) or die('query failed');

            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {

                echo "<option value='{$row['category_id']}'>{$row['category_name']}</option>";
              }
            }
            echo $row;
            ?>
          </select>
        </div>
        
      </div>
      <!-- /.card-body -->
      <div class="card-footer">
        <button type="submit" name="submit" class="btn btn-primary">Post</button>
      </div>
    </div>
    <!-- /.card -->
  </form>
</div>
<!-- /.content-wrapper -->
<?php include 'partials/footer.php'; ?>