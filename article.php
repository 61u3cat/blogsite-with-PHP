<?php include "partials/header.php";
include 'administrator/config.php';
?>

<main>
	<?php
	$sql = "SELECT * FROM blogposts LEFT JOIN blogcategories ON blogposts.category=blogcategories.category_id LEFT JOIN blogusers ON blogposts.author = blogusers.id
                ORDER BY post_id DESC LIMIT 1";
	$result = mysqli_query($conn, $sql);
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
								<h1 class="my-3"></h1>
								<ul class="post-meta mb-4">
									<li><?= $row['category_name'] ?></a>
									</li>
								</ul>

								<div class="content text-left">
									<h1 id="heading">
										<h2 class="h1"><a class="post-title"><?= $row['title'] ?></a></h2>
									</h1>
									<h2 id="description">Description</h2>
									<p class="card-text"><?= $row['description'] ?></p>
							<?php
						}
					}

							?>
							<!-- table of content -->








								</div>
							</article>
						</div>
						<?php include "partials/sidebar.php"; ?>
					</div>
				</div>

			</section>
</main>

<?php include "partials/footer.php"; ?>