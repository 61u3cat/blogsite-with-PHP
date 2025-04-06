<?php
//session_start();
$user_id = isset($_SESSION['auth']['id']) ? $_SESSION['auth']['id'] : 0;
?>
<header class="navigation">
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light px-0" style="background-color: #f8f9fa;">
      <a class="navbar-brand order-1 py-0" href="index.php">
        <img loading="preload" decoding="async" class="img-fluid logo-img" src="images/logo2.png" alt="Reporter Hugo">
      </a>
      <div class="navbar-actions order-3 ml-0 ml-md-4">
        <button aria-label="navbar toggler" class="navbar-toggler border-0" type="button" data-toggle="collapse"
          data-target="#navigation"> <span class="navbar-toggler-icon"></span>
        </button>
      </div>

      <div class="collapse navbar-collapse text-center order-lg-2 order-4" id="navigation">
        <ul class="navbar-nav mx-auto mt-3 mt-lg-0">
          <li class="nav-item"> <a class="nav-link" href="about.php?id=<?=$user_id?>" style="color: #6c757d;">About Me</a>
          </li>
          <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" role="button"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: #6c757d;">
              Articles
            </a>
            <div class="dropdown-menu" style="background-color: #f8f9fa;">
              <?php
              include 'administrator/config.php';
              $sql = "SELECT blogcategories.category_name, blogcategories.category_id, COUNT(blogposts.post_id) AS post 
                      FROM blogcategories 
                      LEFT JOIN blogposts ON blogcategories.category_id = blogposts.category 
                      GROUP BY blogcategories.category_id, blogcategories.category_name";
              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) { ?>
                  <a class="dropdown-item" href="category.php?id=<?= $row['category_id'] ?>" style="color: #6c757d;"><?= $row['category_name'] ?></a>
              <?php
                }
              }
              ?>
            </div>
          </li>
          <li class="nav-item"> <a class="nav-link" href="administrator/index.php" style="color: #6c757d;">Create Blog</a>
          </li>
        </ul>
        <!-- Search Form -->
        <form action="search.php" method="GET" class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" name="query" placeholder="Search by title" aria-label="Search" required style="background-color: #e9ecef; border-color: #ced4da; color: #495057;">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit" style="background-color: #e9ecef; border-color: #ced4da; color: #495057;">Search</button>
        </form>
      </div>
    </nav>
  </div>
</header>
<!-- Link to external CSS -->
<style>
  /*CSS for navbar*/
.logo-img {
  max-height: 100px; /* Adjust the height as needed */
  width: auto;
}

.navbar-nav {
  align-items: center;
}

.form-inline {
  display: flex;
  align-items: center;
}

.navbar-light .navbar-nav .nav-link {
  color: #6c757d; /* Pastel color for nav links */
}

.navbar-light .navbar-nav .nav-link:hover {
  color: #495057; /* Darker pastel color for hover state */
}

.dropdown-menu {
  background-color: #f8f9fa; /* Pastel background color for dropdown */
}

.dropdown-item {
  color:rgb(150, 223, 72); /* Pastel color for dropdown items */
}

.dropdown-item:hover {
  color:rgb(152, 225, 88); /* Darker pastel color for hover state */
  background-color: #e9ecef; /* Light pastel background color for hover state */
}

.btn-outline-success {
  color:rgb(16, 16, 17); /* Pastel color for button text */
  border-color: #ced4da; /* Pastel border color for button */
}

.btn-outline-success:hover {
  color: #fff; /* White color for button text on hover */
  background-color:rgb(21, 22, 23); /* Darker pastel background color for button on hover */
  border-color:rgb(151, 190, 229); /* Darker pastel border color for button on hover */
}

.form-control {
  background-color: #e9ecef; /* Pastel background color for input */
  border-color: #ced4da; /* Pastel border color for input */
  color: #495057; /* Pastel text color for input */
}

.form-control:focus {
  background-color: #e9ecef; /* Pastel background color for input on focus */
  border-color: #495057; /* Darker pastel border color for input on focus */
  color: #495057; /* Pastel text color for input on focus */
}
</style>
