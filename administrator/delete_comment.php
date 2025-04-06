<?php
include 'config.php';

if (isset($_GET['id'])) {
    $comment_id = (int)$_GET['id'];
    $sql = "DELETE FROM blogcomments WHERE id = $comment_id";
    if (mysqli_query($conn, $sql)) {
        // Redirect with a success message
        echo "<script>
            window.onload = function() {
                Swal.fire({
                    title: 'Deleted!',
                    text: 'Comment has been deleted.',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'blogcomments.php';
                });
            }
        </script>";
    } else {
        // Redirect with an error message
        echo "<script>
            window.onload = function() {
                Swal.fire({
                    title: 'Error!',
                    text: 'Failed to delete the comment.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                }).then(() => {
                    window.location.href = 'blogcomments.php';
                });
            }
        </script>";
    }
}
?>
<!-- Include SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>