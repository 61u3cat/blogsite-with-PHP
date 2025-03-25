<?php include "partials/header.php";
include 'administrator/config.php';

// Get the post ID from the URL
$post_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch the post with the given post ID
$sql = "SELECT blogposts.*, blogcategories.category_name, blogusers.name AS author_name, blogusers.role AS author_role, blogusers.id AS author_id 
        FROM blogposts 
        LEFT JOIN blogcategories ON blogposts.category = blogcategories.category_id 
        LEFT JOIN blogusers ON blogposts.author = blogusers.id
        WHERE blogposts.post_id = $post_id";
$result = mysqli_query($conn, $sql);
?>

<main>
  <?php
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
  ?>
      <section class="section">
        <div class="container">
          <div class="row">
            <div class="col-lg-8 mb-5 mb-lg-0">
              <article>
                <img src="administrator/upload/<?= $row['thumbnail'] ?>" alt="Post Thumbnail" class="img-fluid">
                <ul class="post-meta mb-2 mt-4">
                  <li>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style="margin-right:5px;margin-top:-4px" class="text-dark" viewBox="0 0 16 16">
                      <path d="M5.5 10.5A.5.5 0 0 1 6 10h4a.5.5 0 0 1 0 1H6a.5.5 0 0 1-.5-.5z" />
                      <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H2z" />
                      <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5V4z" />
                    </svg> <span>
                      <div class="post-info"> <span class="text-uppercase"><?= $row['post_date'] ?></span>
                    </span>
                  </li>
                </ul>
                <h1 class="my-3"><?= htmlspecialchars($row['title']) ?></h1>
                <ul class="post-meta mb-4">
                  <li><?= htmlspecialchars($row['category_name']) ?></li>
                  <li>By <?= htmlspecialchars($row['author_name']) ?>, <?= htmlspecialchars($row['author_role']) ?></li>
                </ul>

                <div class="content text-left">
                  <h2 id="description">Description</h2>
                  <p class="card-text"><?= $row['description'] ?></p>
                </div>
              </article>
            </div>
            <div class="col-lg-4">
              <div class="widget-blocks">
                <div class="row">
                  <div class="col-lg-12">
                    <div class="widget">
                      <div class="widget-body">
                        <h2 class="widget-title my-3"><?= htmlspecialchars($row['author_name']) ?></h2>
                        <p class="mb-3 pb-2">Hello, <?= htmlspecialchars($row['author_name']) ?>. A Content writer, Developer and Story teller. Working as a Content writer at CoolTech Agency. Quam nihil …</p>
                        <a href="about.php?id=<?= $row['author_id'] ?>" class="btn btn-sm btn-outline-primary">Know More</a>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12 col-md-6">
                    <div class="widget">
                      <h2 class="section-title mb-3">Recent Articles From Author</h2>
                      <div class="widget-body">
                        <div class="widget-list">
                          <?php
                          // Fetch the recent articles written by the same author
                          $articles_sql = "SELECT * FROM blogposts WHERE author = {$row['author']} ORDER BY post_id DESC LIMIT 5";
                          $articles_result = mysqli_query($conn, $articles_sql);
                          if (mysqli_num_rows($articles_result) > 0) {
                            while ($article = mysqli_fetch_assoc($articles_result)) {
                          ?>
                              <article class="card mb-4">
                                <div class="card-image">
                                  <div class="post-info"> <span class="text-uppercase"><?= $article['post_date'] ?></span>
                                  </div>
                                  <img loading="lazy" decoding="async" src="administrator/upload/<?= $article['thumbnail'] ?>" alt="Post Thumbnail" class="w-100">
                                </div>
                                <div class="card-body px-0 pb-1">
                                  <h3><a class="post-title post-title-sm" href="article.php?id=<?= $article['post_id'] ?>"><?= htmlspecialchars($article['title']) ?></a></h3>
                                  <p class="card-text"><?= substr(strip_tags($article['description']), 0, 100) . "..." ?></p>
                                  <div class="content"> <a class="read-more-btn" href="article.php?id=<?= $article['post_id'] ?>">Read Full Article</a>
                                  </div>
                                </div>
                              </article>
                          <?php
                            }
                          } else {
                            echo "<p>No recent articles found.</p>";
                          }
                          ?>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-12 col-md-6">
                    <div class="widget">
                      <h2 class="section-title mb-3">Categories</h2>
                      <div class="widget-body">
                        <ul class="widget-list">
                          <?php
                          $sql = "SELECT blogcategories.category_name, blogcategories.category_id, COUNT(blogposts.post_id) AS post 
                      FROM blogcategories 
                      LEFT JOIN blogposts ON blogcategories.category_id = blogposts.category 
                      GROUP BY blogcategories.category_id, blogcategories.category_name";
                          $result = mysqli_query($conn, $sql);
                          if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                              echo "<li><a href='category.php?id={$row['category_id']}'>{$row['category_name']}<span class='ml-auto'>({$row['post']})</span></a></li>";
                            }
                          }
                          ?>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="mt-5">
              <div id="disqus_thread"></div>
              <script type="application/javascript">
                var disqus_config = function() {};
                (function() {
                  if (["localhost", "127.0.0.1"].indexOf(window.location.hostname) != -1) {
                    document.getElementById('disqus_thread').innerHTML = 'Disqus comments not available by default when the website is previewed locally.';
                    return;
                  }
                  var d = document,
                    s = d.createElement('script');
                  s.async = true;
                  s.src = '//' + "themefisher-template" + '.disqus.com/embed.js';
                  s.setAttribute('data-timestamp', +new Date());
                  (d.head || d.body).appendChild(s);
                })();
              </script>
              <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
              <a href="https://disqus.com" class="dsq-brlink">comments powered by <span class="logo-disqus">Disqus</span></a>
            </div>
          </div>
        </div>
      </section>
  <?php
    }
  } else {
    echo "<div class='container'><p>No post found.</p></div>";
  }
  ?>
</main>

<?php include "partials/footer.php"; ?>