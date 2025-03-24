<header class="navigation">
  <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light px-0">
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
          <li class="nav-item"> <a class="nav-link" href="about.php">About Me</a>
          </li>
          <li class="nav-item dropdown"> <a class="nav-link dropdown-toggle" href="#" role="button"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Articles
            </a>
            <div class="dropdown-menu">
              <?php
              include 'administrator/config.php';
              $sql = "SELECT blogcategories.category_name, blogcategories.category_id, COUNT(blogposts.post_id) AS post 
                      FROM blogcategories 
                      LEFT JOIN blogposts ON blogcategories.category_id = blogposts.category 
                      GROUP BY blogcategories.category_id, blogcategories.category_name";
              $result = mysqli_query($conn, $sql);
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) { ?>
                  <a class="dropdown-item" href="category.php?id=<?= $row['category_id'] ?>"><?= $row['category_name'] ?></a>
              <?php
                }
              }
              ?>
            </div>
          </li>
          <li class="nav-item"> <a class="nav-link" href="contact.php">Contact</a>
          </li>
        </ul>
        <!-- Search Form -->
        <form action="search.php" method="GET" class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" name="query" placeholder="Search by title" aria-label="Search" required>
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>
  </div>
</header>

<style>
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
</style>