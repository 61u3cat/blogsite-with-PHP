<?php include "partials/header.php"; 
include 'administrator/config.php';

// Fetch the user's information
$user_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$user_sql = "SELECT * FROM blogusers WHERE id = $user_id";
$user_result = mysqli_query($conn, $user_sql);
$user = mysqli_fetch_assoc($user_result);

// Fetch the user's posts
$posts_sql = "SELECT * FROM blogposts WHERE author = $user_id ORDER BY post_id DESC";
$posts_result = mysqli_query($conn, $posts_sql);
?>
<main>
    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 ">
                    <div class="breadcrumbs mb-4"> <a href="index.php">Home</a>
                        <span class="mx-1">/</span> <a href="about.php">About</a>
                    </div>
                </div>
                <div class="col-lg-8 mx-auto mb-5 mb-lg-0">
                    <h1 class="mb-4"><?= htmlspecialchars($user['name']) ?></h1>
                    <p class="mb-3 pb-2">Hello, <?= htmlspecialchars($user['name']) ?>. A Content writer, Developer and Story teller. Working as a Content writer at CoolTech Agency. Quam nihil …</p>
                    <div class="content">
                        <p class="card-text"><?= htmlspecialchars($user['email']) ?></p>
                    </div>
                </div>
                <div class="col-lg-8 mx-auto mb-5 mb-lg-0">
                    <h2 class="section-title mb-4">Posts by <?= htmlspecialchars($user['name']) ?></h2>
                    <?php
                    if (mysqli_num_rows($posts_result) > 0) {
                        while ($post = mysqli_fetch_assoc($posts_result)) {
                    ?>
                            <article class="card mb-4">
                                <div class="card-body">
                                    <h3><a class="post-title" href="article.php?id=<?= $post['post_id'] ?>"><?= htmlspecialchars($post['title']) ?></a></h3>
                                    <p class="card-text"><?= substr(strip_tags($post['description']), 0, 150) . "..." ?></p>
                                    <a class="read-more-btn" href="article.php?id=<?= $post['post_id'] ?>">Read Full Article</a>
                                </div>
                            </article>
                    <?php
                        }
                    } else {
                        echo "<p>No posts found.</p>";
                    }
                    ?>
                </div>
                <?php include "partials/sidebar.php" ?>
            </div>
        </div>
    </section>
</main>
<?php include "partials/footer.php"; ?>