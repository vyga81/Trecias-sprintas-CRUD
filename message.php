<?php
if (isset($_SESSION['message'])) :
?>

    <!-- "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
    <strong>Hello</strong> This is message.
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>" -->
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong><?= $_SESSION['message'] ?></strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

<?php
    unset($_SESSION['message']);
endif;
?>