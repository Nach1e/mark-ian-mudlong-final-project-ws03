<!-- Showcase / Hero Section -->
<section class="hero-section">
    <div class="hero-content">
        <span class="hero-badge">Find Your Next Opportunity</span>
        <h2>Discover Your Dream Job Today</h2>
        <p>Join thousands of professionals who found their perfect career match through Prosple.</p>
        
        <form method="GET" action="<?= url('/listings/search') ?>" class="hero-search-form">
            <div class="input-group">
                <i class="fas fa-briefcase"></i>
                <input type="text" name="keywords" placeholder="Job title, keywords, or company">
            </div>
            <div class="input-group">
                <i class="fas fa-map-marker-alt"></i>
                <input type="text" name="location" placeholder="City or state">
            </div>
            <button type="submit" class="btn btn-primary search-btn">
                <i class="fas fa-search"></i> Search Jobs
            </button>
        </form>
        
    </div>
</section>