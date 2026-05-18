<?php
    use Framework\Session;
?>

<header class="site-header">
    <div class="header-inner">
        <div class="brand-wrapper">
            <div class="brand">
                <a href="<?= url('/') ?>">
                    <span class="brand-mark">P</span>
                    <span class="brand-text">Prosple</span>
                </a>
            </div>
            <?php if (Session::has('user')) : ?>
                <span class="nav-welcome-badge">Welcome, <?= Session::get('user')['name'] ?></span>
            <?php endif; ?>
        </div>
        
        <nav class="main-nav">
            <a href="<?= url('/listings') ?>" class="nav-link">Browse Jobs</a>
            
            <?php if (Session::has('user')) : ?>
                <a href="<?= url('/listings/create') ?>" class="btn nav-cta">Post a Job</a>
                <form method="POST" action="<?= url('/logout') ?>" class="inline-form">
                    <button type="submit" class="nav-link">Logout</button>
                </form>
            <?php else : ?>
                <a href="<?= url('/login') ?>" class="nav-link">Login</a>
                <a href="<?= url('/register') ?>" class="btn nav-cta">Register</a>
            <?php endif; ?>
        </nav>
    </div>
</header>
<main class="main-content">