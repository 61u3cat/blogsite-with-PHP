<?php
include 'config.php';

if (isset($_GET['id'])) {
    $comment_id = (int)$_GET['id'];
    $sql = "UPDATE blogcomments SET status = 'approved' WHERE id = $comment_id";
    if (mysqli_query($conn, $sql)) {
        // Redirect with a success message
        echo "<script>
            window.onload = function() {
                Swal.fire({
                    title: 'Success!',
                    text: 'Comment has been approved.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'blog-comments.php';
                });
            }
        </script>";
    } else {
        // Redirect with an error message
        echo "<script>
            window.onload = function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to approve the comment.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'blog-comments.php';
                });
            }
        </script>";
    }
}
?>
<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>