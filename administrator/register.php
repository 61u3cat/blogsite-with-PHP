<?php
include "config.php";
session_start();

?>
<?php
if (isset($_POST['submit'])) {
  $name = mysqli_real_escape_string($conn, $_POST['fullname']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = $_POST['password']; //123124
  $re_password = $_POST['re_password'];
  $role = mysqli_real_escape_string($conn, $_POST['role']);

  if ($password !== $re_password) {
    $_SESSION['error'] = 'password should be matched';
  } else {
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    $checkmail = "SELECT * FROM blogusers WHERE email = '$email'";
    $mail_check_result = mysqli_query($conn, $checkmail);
    if (mysqli_num_rows($mail_check_result) > 0) {
      $_SESSION['error'] = 'email already exists';
      exit;
    } else {
      $sql = "INSERT INTO blogusers (`name`,`email`,`password`,`role`) VALUES('$name','$email','$hashed_password','$role')";
      $values = mysqli_query($conn, $sql);
      if ($values) {
        header("Location: index.php");
      } else {
        $_SESSION['error'] = 'Registration failed';
      }
    }
  }
}





// print_r($sql);
// //print_r($values);          
// header("Location: index.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Registration Page (v2)</title>

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
        <p class="login-box-msg">Register a new membership</p>
        <?php
        if (!empty($_SESSION['error'])) { ?>
        <div class="alert-warning">
        <?php     
        echo $_SESSION['error'];
        unset($_SESSION['error']);               
        ?>
        </div>
          <?php
        }

        ?>
        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
          <div class="input-group mb-3">
            <input type="text" name="fullname" class="form-control" placeholder="Full name" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" required>
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
          <div class="form-group mb-3 ">
            <!-- <label>User Role</label> -->
            <select class="form-control" name="role" required>
              <option selected>Select User Role</option>
              <option value="0">Normal</option>
              <option value="1">Admin</option>
            </select>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
                <label for="agreeTerms">
                  I agree to the <a href="#">terms</a>
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" name="submit" class="btn btn-primary btn-block">Register</button>
            </div>
            <!-- /.col -->
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