<?php loadPartial('head'); ?>
<?php loadPartial('navbar'); ?>

<section class="top-banner">
    <div class="container mx-auto">
        <span class="jobs-section-badge">🔍 Search Results</span>
        <h2>
            <?php if (isset($keywords) && $keywords !== '') : ?>
                Results for: "<?= htmlspecialchars($keywords) ?>"
            <?php else : ?>
                All Job Listings
            <?php endif; ?>
        </h2>
        <p>Discover your next career opportunity from our curated job listings.</p>
    </div>
</section>

<section class="jobs-section">
    <div class="container mx-auto">
        <?php loadPartial('message'); ?>
        
        <?php if (empty($listings)) : ?>
        <div class="text-center py-2xl">
            <i class="fas fa-search text-3xl text-tertiary mb-md"></i>
            <h3 class="mb-sm">No listings found</h3>
            <p class="text-secondary">Try adjusting your search or browse all jobs.</p>
            <a href="<?= url('/listings') ?>" class="btn btn-primary mt-lg inline-block">
                View all jobs
            </a>
        </div>
        <?php else : ?>
        <div class="jobs-grid">
            <?php foreach ($listings as $listing) : ?>
            <div class="job-card">
                <div class="job-card-content">
                    <div class="job-card-top">
                        <span class="job-card-category">
                            <i class="fas fa-building"></i> <?= ucfirst($listing->tags ?? 'Full-time') ?>
                        </span>
                        <span class="job-badge">
                            <i class="fas fa-map-marker-alt"></i> <?= $listing->city ?? 'Remote' ?>
                        </span>
                    </div>
                    
                    <h3 class="job-card-title"><?= htmlspecialchars($listing->title) ?></h3>
                    <p class="job-card-description"><?= substr(htmlspecialchars($listing->description), 0, 100) ?>...</p>
                    
                    <div class="job-card-meta">
                        <div class="job-meta-row">
                            <span class="job-meta-label">
                                <i class="fas fa-dollar-sign"></i> Salary:
                            </span>
                            <span class="job-salary"><?= formatSalary($listing->salary) ?></span>
                        </div>
                        <div class="job-meta-row">
                            <span class="job-meta-label">
                                <i class="fas fa-map-pin"></i> Location:
                            </span>
                            <span class="job-location"><?= htmlspecialchars($listing->city) ?>, <?= htmlspecialchars($listing->state) ?></span>
                        </div>
                    </div>
                    
                    <a href="<?= url('/listings/' . $listing->id) ?>" class="job-details-btn">
                        View Details <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php loadPartial('footer'); ?>