<?php if (!empty($errors)) : ?>
    <?php foreach ($errors as $error) : ?>
        <div class="message-error">
            <i class="fas fa-exclamation-triangle"></i> <?= $error ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>