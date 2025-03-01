<?php
session_start();
include "config.php";
if (!isset($_SESSION["auth"])) {
  header("Location: index.php");
}
$id = $_GET['id'];
$sql = "SELECT * FROM blogusers WHERE id=$id";
$result = mysqli_query($conn, $sql);
$value = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
  $name = mysqli_real_escape_string($conn, $_POST['fullname']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $re_password = mysqli_real_escape_string($conn, $_POST['re_password']);
  $role = mysqli_real_escape_string($conn, $_POST['role']);

  if ($password !== $re_password) {
    $_SESSION['error'] = 'Passwords should match';
  } else {
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $sql1 = "UPDATE blogusers SET name='{$name}', email='{$email}', password='{$hashed_password}', role='{$role}' WHERE id='{$id}'";
    $values = mysqli_query($conn, $sql1);
    if ($values) {
      header("Location: dashboard.php");
      exit;
    } else {
      $_SESSION['error'] = 'Update failed';
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Edit User</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/css/adminlte.min.css">
</head>

<body class="hold-transition register-page">
  <div class="register-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="index.php" class="h1"><b>Admin</b>LTE</a>
      </div>
      <div class="card-body">
        <p class="login-box-msg">Update user info</p>
        <?php
        if (!empty($_SESSION['error'])) { ?>
          <div class="alert alert-warning">
            <?php
            echo $_SESSION['error'];
            unset($_SESSION['error']);
            ?>
          </div>
        <?php
        }
        ?>

        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
          <div class="input-group mb-3">
            <input type="text" name="fullname" value="<?= $value['name'] ?>" class="form-control" placeholder="Full name" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" value="<?= $value['email'] ?>" placeholder="Email" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="re_password" class="form-control" placeholder="Retype password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="form-group mb-3">
            <select class="form-control" name="role" required>
              <option selected>Select User Role</option>
              <option value="0" <?= $value['role'] == 0 ? 'selected' : '' ?>>Normal User</option>
              <option value="1" <?= $value['role'] == 1 ? 'selected' : '' ?>>Admin</option>
            </select>
          </div>
          <div class="row">
            <div class="col-4">
              <button type="submit" name="submit" class="btn btn-primary btn-block">Update</button>
            </div>
          </div>
        </form>

        <a href="index.php" class="text-center">I already have a membership</a>
      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
  <!-- /.register-box -->

  <!-- jQuery -->
  <script src="assets/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="assets/js/adminlte.min.js"></script>
</body>

</html>