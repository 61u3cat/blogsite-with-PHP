<?php include "partials/header.php";
include 'administrator/config.php';

// Get the search query from the URL
$search_query = isset($_GET['query']) ? mysqli_real_escape_string($conn, $_GET['query']) : '';

?>

<main>
  <section class="section">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <div class="breadcrumbs mb-4">
            <a href="index.php">Home</a>
            <span class="mx-1">/</span>
            <a href="#!">Search Results</a>
          </div>
          <h1 class="mb-4 border-bottom border-primary d-inline-block">Search Results for "<?= htmlspecialchars($search_query) ?>"</h1>
        </div>
      </div>
      <div class="row">
        <?php
        // Fetch posts that match the search query
        $sql = "SELECT * FROM blogposts 
                LEFT JOIN blogcategories ON blogposts.category = blogcategories.category_id 
                LEFT JOIN blogusers ON blogposts.author = blogusers.id
                WHERE blogposts.title LIKE '%$search_query%'
                ORDER BY post_id DESC";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
        ?>
            <div class="col-md-6 mb-4">
              <article class="card article-card article-card-sm h-100">
                <a href="article.php?id=<?= $row['post_id'] ?>">
                  <div class="card-image">
                    <div class="post-info">
                      <span class="text-uppercase"><?= $row['post_date'] ?></span>
                      <span class="text-uppercase">3 minutes read</span>
                    </div>
                    <img loading="lazy" decoding="async" src="administrator/upload/<?= $row['thumbnail'] ?>" alt="Post Thumbnail" class="w-100" width="420" height="280">
                  </div>
                </a>
                <div class="card-body px-0 pb-0">
                  <ul class="post-meta mb-2">
                    <li>
                      <a href="category.php?id=<?= $row['category_id'] ?>"><?= $row['category_name'] ?></a>
                    </li>
                  </ul>
                  <h2><a class="post-title" href="article.php?id=<?= $row['post_id'] ?>"><?= $row['title'] ?></a></h2>
                  <p class="card-text"><?= substr(strip_tags($row['description']), 0, 250) . "..." ?></p>
                  <div class="content">
                    <a class="read-more-btn" href="article.php?id=<?= $row['post_id'] ?>">Read Full Article</a>
                  </div>
                </div>
              </article>
            </div>
        <?php
          }
        } else {
          echo "<div class='col-12'><p>No posts found matching your query.</p></div>";
        }
        ?>
      </div>
    </div>
  </section>
</main>

<?php include "partials/footer.php"; ?>