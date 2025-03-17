<div class="col-lg-4">
  <div class="widget-blocks">
    <div class="row">
      <div class="col-lg-12">
        <div class="widget">
          <div class="widget-body">
            <img loading="lazy" decoding="async" src="images/author.jpg" alt="About Me" class="w-100 author-thumb-sm d-block">
            <h2 class="widget-title my-3">Hootan Safiyari</h2>
            <p class="mb-3 pb-2">Hello, I’m Hootan Safiyari. A Content writer, Developer and Story teller. Working as a Content writer at CoolTech Agency. Quam nihil …</p> 
            <a href="about.php" class="btn btn-sm btn-outline-primary">Know More</a>
          </div>
        </div>
      </div>
      <div class="col-lg-12 col-md-6">
        <div class="widget">
          <h2 class="section-title mb-3">Recommended</h2>
          <div class="widget-body">
            <div class="widget-list">
              <article class="card mb-4">
                <div class="card-image">
                  <div class="post-info"> <span class="text-uppercase">1 minutes read</span>
                  </div>
                  <img loading="lazy" decoding="async" src="images/post/post-9.jpg" alt="Post Thumbnail" class="w-100">
                </div>
                <div class="card-body px-0 pb-1">
                  <h3><a class="post-title post-title-sm" href="article.html">Portugal and France Now Allow Unvaccinated Tourists</a></h3>
                  <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor …</p>
                  <div class="content"> <a class="read-more-btn" href="article.html">Read Full Article</a>
                  </div>
                </div>
              </article>
              <a class="media align-items-center" href="article.html">
                <img loading="lazy" decoding="async" src="images/post/post-2.jpg" alt="Post Thumbnail" class="w-100">
                <div class="media-body ml-3">
                  <h3 style="margin-top:-5px">These Are Making It Easier To Visit</h3>
                  <p class="mb-0 small">Heading Here is example of headings. You can use …</p>
                </div>
              </a>
              <a class="media align-items-center" href="article.html"> 
                <span class="image-fallback image-fallback-xs">No Image Specified</span>
                <div class="media-body ml-3">
                  <h3 style="margin-top:-5px">No Image specified</h3>
                  <p class="mb-0 small">Lorem ipsum dolor sit amet, consectetur adipiscing …</p>
                </div>
              </a>
              <a class="media align-items-center" href="article.html">
                <img loading="lazy" decoding="async" src="images/post/post-5.jpg" alt="Post Thumbnail" class="w-100">
                <div class="media-body ml-3">
                  <h3 style="margin-top:-5px">Perfect For Fashion</h3>
                  <p class="mb-0 small">Lorem ipsum dolor sit amet, consectetur adipiscing …</p>
                </div>
              </a>
              <a class="media align-items-center" href="article.html">
                <img loading="lazy" decoding="async" src="images/post/post-9.jpg" alt="Post Thumbnail" class="w-100">
                <div class="media-body ml-3">
                  <h3 style="margin-top:-5px">Record Ultra Smooth Video</h3>
                  <p class="mb-0 small">Lorem ipsum dolor sit amet, consectetur adipiscing …</p>
                </div>
              </a>
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
              include 'administrator/config.php';
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