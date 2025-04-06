<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="#" class="brand-link">
    <img src="../administrator/assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Blog-Dash</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="../administrator/assets/img/user1-128x128.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <?php
        $fullName = $_SESSION['auth']['name'];
        $firstName = explode(' ', trim($fullName))[0];
        ?>
        <a href="#" class="d-block">Hello, <?php echo $firstName; ?></a>
        <a href="logout.php" class="btn btn-block btn-danger mt-2">
          <i class="fas fa-sign-out-alt mr-2"></i> Logout
        </a>
      </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Existing Create Section -->
        <li class="nav-item <?= $current == 'create-blog' ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-edit"></i>
            <p>
              Create
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="create-blog.php" class="nav-link <?= $current == 'create-blog' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Create Posts</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Existing Blog Lists Section -->
        <li class="nav-item <?= $current == 'blog-lists' || $current == 'dashboard' ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-table"></i>
            <p>
              Lists
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="blog-lists.php" class="nav-link <?= $current == 'blog-lists' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Blogs Lists</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="dashboard.php" class="nav-link <?= $current == 'dashboard' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>User List</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- New Blog Comments Section -->
        <li class="nav-item <?= $current == 'blog-comments' ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-comments"></i>
            <p>
              Comments
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="blog-comments.php" class="nav-link <?= $current == 'blog-comments' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage Comments</p>
              </a>
            </li>
          </ul>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>