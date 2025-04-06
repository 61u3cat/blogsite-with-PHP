<?php
include 'partials/header.php';
include 'config.php';

// Fetch all pending blog comments
$sql = "SELECT blogcomments.*, blogposts.title AS post_title 
        FROM blogcomments 
        LEFT JOIN blogposts ON blogcomments.post_id = blogposts.post_id 
        WHERE blogcomments.status = 'pending' 
        ORDER BY blogcomments.created_at DESC";
$result = mysqli_query($conn, $sql);
?>

<div class="content-wrapper">
  <!-- Page Header -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Manage Blog Comments</h1>
        </div>
      </div>
    </div>
  </section>

  <!-- Main Content -->
  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Pending Comments</h3>
        </div>
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>ID</th>
                <th>Post</th>
                <th>Name</th>
                <th>Comment</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                  <td><?= $row['id'] ?></td>
                  <td><?= htmlspecialchars($row['post_title']) ?></td>
                  <td><?= htmlspecialchars($row['name']) ?></td>
                  <td><?= htmlspecialchars($row['comment']) ?></td>
                  <td>
                    <a href="approve_comment.php?id=<?= $row['id'] ?>" class="btn btn-success btn-sm">Approve</a>
                    <a href="delete_comment.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                  </td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>

<?php include 'partials/footer.php'; ?>