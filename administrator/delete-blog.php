<?php
session_start();
include 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['auth'])) {
    header('Location: login.php');
    exit();
}

// Check if the post ID is provided
if (isset($_GET['post_id'])) {
    $post_id = (int)$_GET['post_id'];

    // Fetch the post to get the thumbnail file name
    $sql = "SELECT thumbnail FROM blogposts WHERE post_id = $post_id";
    $result = mysqli_query($conn, $sql);
    $post = mysqli_fetch_assoc($result);

    if ($post) {
        // Delete the post from the database
        $delete_sql = "DELETE FROM blogposts WHERE post_id = $post_id";
        if (mysqli_query($conn, $delete_sql)) {
            // Delete the thumbnail file if it exists
            if (!empty($post['thumbnail']) && file_exists('upload/' . $post['thumbnail'])) {
                unlink('upload/' . $post['thumbnail']);
            }
            $_SESSION['message'] = "Blog post deleted successfully.";
        } else {
            $_SESSION['message'] = "Error deleting blog post.";
        }
    } else {
        $_SESSION['message'] = "Blog post not found.";
    }
} else {
    $_SESSION['message'] = "Invalid request.";
}

header('Location: blog-lists.php');
exit();
?>