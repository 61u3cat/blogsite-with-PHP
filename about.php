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
    <section class="section" style="background-color: #f8f9fa; padding: 40px 0;">
        <div class="container">
            <div class="row">
                <!-- Breadcrumbs -->
                <div class="col-lg-8 mx-auto">
                    <div class="breadcrumbs mb-4" style="font-size: 14px; color: #6c757d;">
                        <a href="index.php" style="color: #007bff; text-decoration: none;">Home</a>
                        <span class="mx-1">/</span>
                        <a href="about.php" style="color: #6c757d; text-decoration: none;">About</a>
                    </div>
                </div>

                <!-- User Information -->
                <div class="col-lg-8 mx-auto mb-5">
                    <div class="user-info" style="background-color: #ffffff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                        <h1 class="mb-4" style="color: #343a40; font-size: 32px; font-weight: bold;"><?= htmlspecialchars($user['name']) ?></h1>
                        <p class="mb-3" style="color: #495057; font-size: 16px; line-height: 1.6;">
                            Hello, <?= htmlspecialchars($user['name']) ?>. A Content writer, Developer, and Storyteller. Working as a Content writer at CoolTech Agency. Quam nihil …
                        </p>
                        <p class="card-text" style="color: #6c757d; font-size: 14px;">Email: <?= htmlspecialchars($user['email']) ?></p>
                    </div>
                </div>

                <!-- User's Posts -->
                <div class="col-lg-8 mx-auto">
                    <h2 class="section-title mb-4" style="color: #343a40; font-size: 24px; font-weight: bold;">Posts by <?= htmlspecialchars($user['name']) ?></h2>
                    <?php
                    if (mysqli_num_rows($posts_result) > 0) {
                        while ($post = mysqli_fetch_assoc($posts_result)) {
                    ?>
                            <article class="card mb-4" style="border: none; background-color: #ffffff; border-radius: 8px; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                                <div class="card-body" style="padding: 20px;">
                                    <h3 style="font-size: 20px; font-weight: bold; color: #007bff;">
                                        <a class="post-title" href="article.php?id=<?= $post['post_id'] ?>" style="text-decoration: none;"><?= htmlspecialchars($post['title']) ?></a>
                                    </h3>
                                    <p class="card-text" style="color: #6c757d; font-size: 14px; line-height: 1.6;">
                                        <?= substr(strip_tags($post['description']), 0, 150) . "..." ?>
                                    </p>
                                    <a class="read-more-btn" href="article.php?id=<?= $post['post_id'] ?>" style="color: #007bff; text-decoration: none; font-size: 14px;">Read Full Article</a>
                                </div>
                            </article>
                    <?php
                        }
                    } else {
                        echo "<p style='color: #6c757d;'>No posts found.</p>";
                    }
                    ?>
                </div>
                <?php include "partials/sidebar.php" ?>
            </div>
        </div>
    </section>
</main>
<?php include "partials/footer.php"; ?>