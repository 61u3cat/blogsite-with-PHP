<?php
include 'administrator/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = isset($_POST['post_id']) ? (int)$_POST['post_id'] : 0;
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);

    if ($post_id && $name && $comment) {
        // Insert the comment with a default status of 'pending'
        $sql = "INSERT INTO blogcomments (post_id, name, comment, status) 
                VALUES ($post_id, '$name', '$comment', 'pending')";
        if (mysqli_query($conn, $sql)) {
            // Redirect with a SweetAlert success message
            echo "<script>
                window.onload = function() {
                    Swal.fire({
                        title: 'Comment Submitted!',
                        text: 'Your comment is pending approval.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = 'article.php?id=$post_id';
                    });
                }
            </script>";
        } else {
            // Redirect with a SweetAlert error message
            echo "<script>
                window.onload = function() {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Failed to submit your comment. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = 'article.php?id=$post_id';
                    });
                }
            </script>";
        }
    } else {
        echo "<script>
            window.onload = function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'All fields are required.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.history.back();
                });
            }
        </script>";
    }
}
?>
<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>