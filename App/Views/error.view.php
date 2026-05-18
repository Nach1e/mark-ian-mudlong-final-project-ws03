<?php loadPartial('head'); ?>
<?php loadPartial('navbar'); ?>

<section class="error-page">
    <div class="error-wrap">
        <div class="error-card">
            <div class="error-icon-wrap">
                <div class="error-icon-spin">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
            </div>
            
            <span class="error-badge">Error <?= $status ?? '404' ?></span>
            <h1 class="error-title"><?= ($status ?? '404') === '404' ? 'Page Not Found' : 'Access Denied' ?></h1>
            <p class="error-text"><?= $message ?? 'The page you are looking for could not be found.' ?></p>
            
            <div class="error-actions">
                <a href="/WS03/Public/" class="btn error-btn-primary">
                    <i class="fas fa-home"></i> Back to Home
                </a>
                <a href="/WS03/Public/listings" class="btn error-btn-secondary">
                    <i class="fas fa-briefcase"></i> Browse Jobs
                </a>
            </div>
        </div>
    </div>
</section>

<?php loadPartial('footer'); ?>