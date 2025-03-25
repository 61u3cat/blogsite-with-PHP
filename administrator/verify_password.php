<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $password = $_POST['password'];
  $post_id = $_POST['post_id'];

  // Fetch the author's password for the given post ID
  $sql = "SELECT blogusers.password FROM blogposts 
          LEFT JOIN blogusers ON blogposts.author = blogusers.id
          WHERE blogposts.post_id = $post_id";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  if (password_verify($password, $row['password'])) {
    echo 'success';
  } else {
    echo 'failure';
  }
}
?>