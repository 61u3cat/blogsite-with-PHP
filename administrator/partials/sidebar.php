<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="../../index3.html" class="brand-link">
    <img src="../../assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">AdminLTE 3</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="../../assets/img/user1-128x128.png" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">Alexander Pierce</a>
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
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
        <li class="nav-item <?= $current == 'create-blog' ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link ">
            <i class="nav-icon fas fa-edit"></i>
            <p>
              Create
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <!-- Navigation Item for Creating Blog Posts -->
            <li class="nav-item">
              <!-- Link to Create Blog Page, sets class 'active' if $current is 'create-blog' -->
              <a href="create-blog.php" class="nav-link <?= $current == 'create-blog' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i> <!-- Icon for Create Blog -->
                <p>Create Posts</p> <!-- Text for Create Blog -->
              </a>
            </li>
          </ul> <!-- Closing tag for navigation treeview list -->
        </li> <!-- Closing tag for the navigation item -->

        <!-- Navigation Item for Blog Lists, adds class 'menu-open' if $current is 'blog-lists' -->
        <li class="nav-item <?= $current == 'blog-lists' ? 'menu-open' : '' ?>">
          <!-- Link to open sub-menu for Blog Lists -->
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-table"></i> <!-- Icon for Lists -->
            <p>
              Lists <!-- Text for Lists -->
              <i class="fas fa-angle-left right"></i> <!-- Icon for expanding sub-menu -->
            </p>
          </a>
          <ul class="nav nav-treeview"> <!-- Sub-menu for Blog Lists -->
            <!-- Navigation Item for Blog Lists -->
            <li class="nav-item">
              <!-- Link to Blog Lists Page, sets class 'active' if $current is 'blog-lists' -->
              <a href="blog-lists.php" class="nav-link <?= $current == 'blog-lists' ? 'active' : '' ?>">
                <i class="far fa-circle nav-icon"></i> <!-- Icon for Blog Lists -->
                <p>Blogs Lists</p> <!-- Text for Blog Lists -->
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