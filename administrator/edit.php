<?php
session_start();
include 'partials/header.php';
include 'partials/sidebar.php';
include 'config.php';

$post_id = $_GET['post_id'];
$sql = "SELECT * FROM blogposts WHERE post_id=$post_id";
$result = mysqli_query($conn, $sql);
$value = mysqli_fetch_assoc($result);
?>
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

  <form action="save-update-post.php" method="post" enctype="multipart/form-data">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Create a new blog post</h3>
      </div>

      <input type="hidden" value="<?= $post_id; ?>" name="post_id">
      <!-- /.card-header -->
      <div class="card-body">
        <div class="form-group">
          <label for="title">Title</label>
          <input type="text" id="title" name="post_title" value="<?= $value['title'] ?>" class="form-control" placeholder="Enter title" required>
        </div>
        <div class="form-group">
          <label for="description">Description</label>
          <textarea id="summernote" name="description" class="form-control" placeholder="Write your blog description here" required>
          <?= $value['description'] ?>
          </textarea>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Category</label>
          <select name="category" value="<?= $value['category'] ?>" class="form-control">
            <option disabled>Select Category</option>
            <?php
            include "config.php";
            $sql = "SELECT * FROM blogcategories";

            $result = mysqli_query($conn, $sql) or die('query failed');

            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {

                $selected = $row['category_id'] == $value['category'] ? 'selected' : '';
                echo "<option value='{$row['category_id']}' {$selected}>{$row['category_name']}</option>";
              }
            }
            echo $row;
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="inputGroupFile02">Upload Thumbnail</label>
          <div class="input-group">
            <div class="custom-file">
              <input type="file" name="thumbnail" class="custom-file-input" id="inputGroupFile02" required>
              <label class="custom-file-label" for="inputGroupFile02">Choose file</label>
            </div>
          </div>
          <?php
          if (!empty($value['thumbnail'])) {
            echo '<img src="upload/' . htmlspecialchars($value['thumbnail']) . '" alt="Current Thumbnail" class="img-thumbnail mt-2" style="max-width: 200px;">';
          }
          else{
            echo '<img src="upload/' . htmlspecialchars() . '" alt="Current Thumbnail" class="img-thumbnail mt-2" style="max-width: 200px;">';

          }
          ?>

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