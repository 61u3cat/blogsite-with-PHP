<?php
session_start();
include "config.php";

if (!isset($_SESSION["auth"])) {
    header("Location: index.php");
    exit;
}

if (isset($_POST['submit'])) {
    $post_id = $_POST['post_id'];
    $title = mysqli_real_escape_string($conn, $_POST['post_title']);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $date = date("d M,Y");
    $author = $_SESSION['auth']['id'];

    $thumbnail = '';
    if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] == 0) {
        $file_name = $_FILES['thumbnail']['name'];
        $file_tmp = $_FILES['thumbnail']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $extensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $extensions) === false) {
            $errors[] = "This extension is not allowed, please choose a jpg or png format";
        }

        if (empty($errors) == true) {
            move_uploaded_file($file_tmp, "upload/" . $file_name);
            $thumbnail = $file_name;
        } else {
            foreach ($errors as $error) {
                echo $error . "<br>";
            }
        }
    }

    if (!empty($thumbnail)) {
        $sql = "UPDATE blogposts SET title='{$title}', description='{$description}', category='{$category}', post_date='{$date}', author='{$author}', thumbnail='{$thumbnail}' WHERE post_id='{$post_id}'";
    } else {
        $sql = "UPDATE blogposts SET title='{$title}', description='{$description}', category='{$category}', post_date='{$date}', author='{$author}' WHERE post_id='{$post_id}'";
    }

    if (mysqli_query($conn, $sql)) {
        header("Location: blog-lists.php");
    } else {
        echo "<div class='alert alert-danger'>Query failed: " . mysqli_error($conn) . "</div>";
    }
}
?>