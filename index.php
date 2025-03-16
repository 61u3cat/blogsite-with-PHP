<?php include 'partials/header.php';

include 'administrator/config.php';

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
            $sql = "SELECT * FROM blogposts LEFT JOIN blogcategories ON blogposts.category=blogcategories.category_id LEFT JOIN blogusers ON blogposts.author = blogusers.id
                ORDER BY post_id DESC LIMIT 1";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <div class="col-12 mb-4">
                  <article class="card article-card">
                    <a href="article.php">
                      <div class="card-image">
                        <div class="post-info"> <span class="text-uppercase"><?= $row['post_date'] ?></span>
                        </div>
                        <h2 class="h1"><a class="post-title" href="article.php"><?= $row['title'] ?></a></h2>
                      </div>
                    </a>
                    <div class="card-body px-0 pb-1">
                      <ul class="post-meta mb-2">
                        <li> <a href="travel.php"><?= $row['category_name'] ?></a>
                        </li>
                      </ul>

                      <img src="administrator/upload/<?= $row['thumbnail'] ?>" alt="Post Thumbnail" class="img-fluid">
                      <p class="card-text"><?= substr($row['description'], 0, 250) . "......" ?></p>
                      <div class="content"> <a class="read-more-btn" href="article.php">Read Full Article</a>
                      </div>
                    </div>
                  </article>
                </div>
            <?php
              }
            }

            ?>
            <?php
            $sql = "SELECT * FROM blogposts LEFT JOIN blogcategories ON blogposts.category=blogcategories.category_id LEFT JOIN blogusers ON blogposts.author = blogusers.id
                WHERE post_id >= 2
                ORDER BY post_id DESC";
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
                        <li class="page-item">
                          <a class="page-link" href="#!" aria-label="Pagination Arrow">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" viewBox="0 0 16 16">
                              <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
                            </svg>
                          </a>
                        </li>
                        <li class="page-item active "> <a href="index.php" class="page-link">
                            1
                          </a>
                        </li>
                        <li class="page-item"> <a href="#!" class="page-link">
                            2
                          </a>
                        </li>
                        <li class="page-item">
                          <a class="page-link" href="#!" aria-label="Pagination Arrow">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" viewBox="0 0 16 16">
                              <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z" />
                            </svg>
                          </a>
                        </li>
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