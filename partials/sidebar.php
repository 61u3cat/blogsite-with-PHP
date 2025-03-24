<?php
include 'administrator/config.php';


// Check if the user is logged in
// if (!isset($_SESSION['auth'])) {
//     echo "<p>User not logged in.</p>";
//     exit;
// }

// Fetch the logged-in user's information
$user_id = $_SESSION['auth']['id'];
$sql = "SELECT * FROM blogusers WHERE id = $user_id";
$result = mysqli_query($conn, $sql);
$user = mysqli_fetch_assoc($result);

// Fetch the recent articles written by the logged-in user
$articles_sql = "SELECT * FROM blogposts WHERE author = $user_id ORDER BY post_id DESC LIMIT 5";
$articles_result = mysqli_query($conn, $articles_sql);
?>

<div class="col-lg-4">
  <div class="widget-blocks">
    <div class="row">
    <div class="col-lg-12">       
      </div>
      <div class="col-lg-12 col-md-6">
        <div class="widget">
          <h2 class="section-title mb-3">Recent Articles</h2>
          <div class="widget-body">
            <div class="widget-list">
              <?php
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