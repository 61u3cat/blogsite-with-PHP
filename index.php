<?php include 'partials/header.php';
include 'administrator/config.php';

// Define the number of posts per page
$posts_per_page = 5;

// Get the current page number from the URL, default to 1 if not set
$current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;

// Calculate the offset for the SQL query
$offset = ($current_page - 1) * $posts_per_page;

// Get the total number of posts
$total_posts_sql = "SELECT COUNT(*) AS total FROM blogposts";
$total_posts_result = mysqli_query($conn, $total_posts_sql);
$total_posts_row = mysqli_fetch_assoc($total_posts_result);
$total_posts = $total_posts_row['total'];

// Calculate the total number of pages
$total_pages = ceil($total_posts / $posts_per_page);

?>

<main>
  <section class="section">
    <div class="container">
      <div class="row no-gutters-lg">
        <div class="col-12">
          <h2 class="section-title">Latest Articles</h2>
        </div>
        <div class="col-lg-8 mb-5 mb-lg-0">
          <div class="row">
            <?php
            // Fetch the latest post
            $sql = "SELECT * FROM blogposts 
                    LEFT JOIN blogcategories ON blogposts.category = blogcategories.category_id 
                    LEFT JOIN blogusers ON blogposts.author = blogusers.id
                    ORDER BY post_id DESC LIMIT 1";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="col-12 mb-4">
                  <article class="card article-card">
                    <a href="article.php?id=<?= $row['post_id'] ?>">
                      <div class="card-image">
                        <?php if (!empty($row['thumbnail'])): ?>
                          <img src="administrator/upload/<?= $row['thumbnail']?>" alt="Post Thumbnail" class="img-fluid">
                        <?php endif; ?>
                        <div class="post-info"> <span class="text-uppercase"><?= $row['post_date'] ?></span>
                        </div>
                        <h2 class="h1"><a class="post-title" href="article.php?id=<?= $row['post_id'] ?>"><?= $row['title'] ?></a></h2>
                      </div>
                    </a>
                    <div class="card-body px-0 pb-1">
                      <ul class="post-meta mb-2">
                        <li> <a href="category.php?id=<?= $row['category_id'] ?>"><?= $row['category_name'] ?></a>
                        </li>
                      </ul>
                      <p class="card-text"><?= substr(strip_tags($row['description']), 0, 250) . "..." ?></p>
                      <div class="content"> <a class="read-more-btn" href="article.php?id=<?= $row['post_id'] ?>">Read Full Article</a>
                      </div>
                    </div>
                  </article>
                </div>
            <?php
              }
            }
            ?>

            <?php
            // Fetch the remaining posts excluding the latest one
            $sql = "SELECT * FROM blogposts 
                    LEFT JOIN blogcategories ON blogposts.category = blogcategories.category_id 
                    LEFT JOIN blogusers ON blogposts.author = blogusers.id
                    ORDER BY post_id DESC LIMIT $posts_per_page OFFSET $offset";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="col-md-6 mb-4">
                  <article class="card article-card article-card-sm h-100">
                    <a href="article.php?id=<?= $row['post_id'] ?>">
                      <div class="card-image">
                        <div class="post-info"> <span class="text-uppercase"><?= $row['post_date'] ?></span>
                          <span class="text-uppercase">2 minutes read</span>
                        </div>
                        <img loading="lazy" decoding="async" src="administrator/upload/<?= $row['thumbnail'] ?>" alt="Post Thumbnail" class="w-100">
                      </div>
                    </a>
                    <div class="card-body px-0 pb-0">
                      <ul class="post-meta mb-2">
                        <li> <a href="category.php?id=<?= $row['category_id'] ?>"><?= $row['category_name'] ?></a>
                        </li>
                      </ul>
                      <h2><a class="post-title" href="article.php?id=<?= $row['post_id'] ?>"><?= $row['title'] ?></a></h2>
                      <p class="card-text"><?= substr(strip_tags($row['description']), 0, 250) . "..." ?></p>
                      <div class="content"> <a class="read-more-btn" href="article.php?id=<?= $row['post_id'] ?>">Read Full Article</a>
                      </div>
                    </div>
                  </article>
                </div>
            <?php
              }
            }
            ?>

            <div class="col-12">
              <div class="row">
                <div class="col-12">
                  <nav class="mt-4">
                    <!-- pagination -->
                    <nav class="mb-md-50">
                      <ul class="pagination justify-content-center">
                        <?php if ($current_page > 1): ?>
                          <li class="page-item">
                            <a class="page-link" href="?page=<?= $current_page - 1 ?>" aria-label="Previous">
                              <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
                              </svg>
                            </a>
                          </li>
                        <?php endif; ?>

                        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                          <li class="page-item <?= $i == $current_page ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                          </li>
                        <?php endfor; ?>

                        <?php if ($current_page < $total_pages): ?>
                          <li class="page-item">
                            <a class="page-link" href="?page=<?= $current_page + 1 ?>" aria-label="Next">
                              <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
                              </svg>
                            </a>
                          </li>
                        <?php endif; ?>
                      </ul>
                    </nav>
                  </nav>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php include "partials/sidebar.php"; ?>
      </div>
    </div>
  </section>
</main>

<?php include "partials/footer.php"; ?>