<?php
session_start();
include "config.php";
if (!isset($_SESSION["auth"])) {
    header("Location: index.php");
    exit;
}
if (isset($_FILES['thumbnail'])) {
    $errors = array();

    $file_name = $_FILES['thumbnail']['name'];
    $file_size = $_FILES['thumbnail']['size'];
    $file_tmp = $_FILES['thumbnail']['tmp_name'];
    $file_type = $_FILES['thumbnail']['type'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $extensions = array("jpeg", "jpg", "png");


    if (in_array($file_ext, $extensions) === false) {
        $errors[] = "This extension is not allowed,please choose a jpg or png format";
    }

    // if ($file_size > 2097152) {
    //     $errors[] = "file size must be 2mb or lower";
    // }

    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "upload/" . $file_name);
    } else {
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    }

    //print_r($_POST);
    if (isset($_POST['submit'])) {

        $title = mysqli_escape_string($conn, $_POST['post_title']);
        $description = mysqli_real_escape_string($conn, $_POST["description"]);
        $category = mysqli_escape_string($conn, $_POST['category']);
        $date = date("d M,Y");
        $author = $_SESSION['auth']['id'];

        $sql = "INSERT INTO blogposts(title,description,category,post_date,author,thumbnail) VALUES('{$title}','{$description}', '{$category}','{$date}','{$author}','{$file_name}');";
        // $sql .= "UPDATE category SET post = post+1 WHERE category_id= {$category}";

        if (mysqli_query($conn, $sql)) {
            header("location:blog-lists.php");
        } else {
            echo "<div class = 'alert alert-danger'>Query failed </div>";
        }
    }
}
