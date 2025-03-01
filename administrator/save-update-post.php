<?php
session_start();
if (!isset($_SESSION["auth"])) {
    header("Location: index.php");
    exit;
}
include "config.php";
// if (isset($_FILES['fileToUpload'])) {
//     $errors = array();

//     $file_name = $_FILES['fileToUpload']['name'];
//     $file_size = $_FILES['fileToUpload']['size'];
//     $file_tmp = $_FILES['fileToUpload']['tmp_name'];
//     $file_type = $_FILES['fileToUpload']['type'];
//     $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
//     $extensions = array("jpeg", "jpg", "png");


//     if (in_array($file_ext, $extensions) === false) {
//         $errors[] = "This extension is not allowed,please choose a jpg or png format";
//     }

//     if ($file_size > 2097152) {
//         $errors[] = "file size must be 2mb or lower";
//     }

//     if (empty($errors) == true) {
//         move_uploaded_file($file_tmp, "upload/" . $file_name);
//     } else {
//         foreach ($errors as $error) {
//             echo $error . "<br>";
//         }
//     }
// }
// print_r($_POST);


//print_r($value);

if (isset($_POST['submit'])) {
    $title = mysqli_escape_string($conn, $_POST['post_title']);
    $description = mysqli_real_escape_string($conn, $_POST["description"]);
    $category = mysqli_escape_string($conn, $_POST['category']);
    $date = date("d M,Y");
    $post_id = $_POST['post_id'];


    $sql1 = "UPDATE blogposts SET title='{$title}', description='{$description}', category='{$category}' WHERE post_id='{$post_id}'";
    $values = mysqli_query($conn, $sql1);
    if ($values) {
        header("Location: blog-lists.php");
        exit;
    } else {
        $_SESSION['error'] = 'Update failed';
    }
}
