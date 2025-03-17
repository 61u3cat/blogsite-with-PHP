<?php include "partials/header.php"; ?>
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
					<img loading="lazy" decoding="async" src="images/author.jpg" class="img-fluid w-100 mb-4" alt="Author Image">
					<h1 class="mb-4">Hootan Safiyari</h1>
					<div class="content">
						<p class="card-text"><?= $row['description'] ?></p>
					</div>
				</div>
				<?php include "partials/sidebar.php" ?>
			</div>
		</div>
	</section>
</main>
<?php include "partials/footer.php"; ?>