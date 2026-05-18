<?php loadPartial('head'); ?>
<?php loadPartial('navbar'); ?>

<section class="auth-page">
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <div class="auth-icon">
                    <i class="fas fa-sign-in-alt"></i>
                </div>
                <h1>Welcome Back</h1>
                <p>Login to your account to continue</p>
            </div>
            
            <?php loadPartial('errors', ['errors' => $errors ?? []]); ?>
            
            <form method="POST" action="<?= url('/login') ?>" class="auth-form">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-with-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" name="email" class="auth-input" placeholder="john@example.com" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" class="auth-input" placeholder="Your password" required>
                    </div>
                </div>
                
                <button type="submit" class="btn-auth-submit">
                    <i class="fas fa-sign-in-alt"></i> Login
                </button>
            </form>
            
            <div class="auth-footer">
                <p>Don't have an account? <a href="<?= url('/register') ?>">Create Account</a></p>
            </div>
        </div>
    </div>
</section>

<?php loadPartial('footer'); ?>