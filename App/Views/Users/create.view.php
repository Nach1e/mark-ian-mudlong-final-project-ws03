<?php loadPartial('head'); ?>
<?php loadPartial('navbar'); ?>

<section class="auth-page">
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <div class="auth-icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h1>Create Account</h1>
                <p>Join Prosple and start your career journey</p>
            </div>
            
            <?php loadPartial('errors', ['errors' => $errors ?? []]); ?>
            
            <form method="POST" action="<?= url('/register') ?>" class="auth-form">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <div class="input-with-icon">
                        <i class="fas fa-user"></i>
                        <input type="text" id="name" name="name" class="auth-input" placeholder="John Doe" value="<?= isset($user) ? $user['name'] ?? '' : '' ?>" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <div class="input-with-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" name="email" class="auth-input" placeholder="john@example.com" value="<?= isset($user) ? $user['email'] ?? '' : '' ?>" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group half">
                        <label for="city">City</label>
                        <div class="input-with-icon">
                            <i class="fas fa-city"></i>
                            <input type="text" id="city" name="city" class="auth-input" placeholder="Chicago" value="<?= isset($user) ? $user['city'] ?? '' : '' ?>">
                        </div>
                    </div>
                    
                    <div class="form-group half">
                        <label for="state">State</label>
                        <div class="input-with-icon">
                            <i class="fas fa-map-marker-alt"></i>
                            <input type="text" id="state" name="state" class="auth-input" placeholder="IL" value="<?= isset($user) ? $user['state'] ?? '' : '' ?>">
                        </div>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group half">
                        <label for="password">Password</label>
                        <div class="input-with-icon">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="password" name="password" class="auth-input" placeholder="Min. 6 characters" required>
                        </div>
                    </div>
                    
                    <div class="form-group half">
                        <label for="password_confirmation">Confirm Password</label>
                        <div class="input-with-icon">
                            <i class="fas fa-check-circle"></i>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="auth-input" placeholder="Confirm password" required>
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="btn-auth-submit">
                    <i class="fas fa-user-plus"></i> Register
                </button>
            </form>
            
            <div class="auth-footer">
                <p>Already have an account? <a href="<?= url('/login') ?>">Login</a></p>
            </div>
        </div>
    </div>
</section>

<?php loadPartial('footer'); ?>