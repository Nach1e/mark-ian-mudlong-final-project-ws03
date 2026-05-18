<?php
    use Framework\Session;

    $successMessage = Session::getFlashMessage('success_message');
    $errorMessage = Session::getFlashMessage('error_message');
?>

<?php if ($successMessage) : ?>
    <div class="message-success">
        <i class="fas fa-check-circle"></i> <?= $successMessage ?>
    </div>
<?php endif; ?>

<?php if ($errorMessage) : ?>
    <div class="message-error">
        <i class="fas fa-exclamation-circle"></i> <?= $errorMessage ?>
    </div>
<?php endif; ?>