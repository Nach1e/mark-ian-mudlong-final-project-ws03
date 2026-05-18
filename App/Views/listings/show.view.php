<?php
    use Framework\Authorization;
    
    loadPartial('head');
    loadPartial('navbar');
?>

<section class="create-page">
    <div class="create-wrap">
        <?php loadPartial('message'); ?>
        
        <?php if (isset($listing) && $listing) : ?>
        <div class="form-shell">
            <div class="form-hero">
                <span class="form-badge">
                    <i class="fas fa-briefcase"></i> Job Details
                </span>
                <h1><?= htmlspecialchars($listing->title) ?></h1>
                <p><?= htmlspecialchars($listing->company ?? 'Company Name') ?></p>
            </div>
            
            <div class="job-form">
                <div class="form-section">
                    <h2><i class="fas fa-info-circle"></i> Job Information</h2>
                    <div class="form-grid">
                        <div>
                            <label><i class="fas fa-dollar-sign"></i> Salary</label>
                            <div class="form-input bg-card"><?= formatSalary($listing->salary) ?></div>
                        </div>
                        <div>
                            <label><i class="fas fa-map-pin"></i> Location</label>
                            <div class="form-input bg-card"><?= htmlspecialchars($listing->city) ?>, <?= htmlspecialchars($listing->state) ?></div>
                        </div>
                    </div>
                    
                    <div class="form-group full mt-md">
                        <label><i class="fas fa-align-left"></i> Description</label>
                        <div class="form-input bg-card min-h-auto white-space-pre-wrap"><?= nl2br(htmlspecialchars(html_entity_decode($listing->description, ENT_QUOTES, 'UTF-8'))) ?></div>
                    </div>
                    
                    <?php if (!empty($listing->requirements)) : ?>
                    <div class="form-group full mt-md">
                        <label><i class="fas fa-check-circle"></i> Requirements</label>
                        <div class="form-input bg-card min-h-auto white-space-pre-wrap"><?= nl2br(htmlspecialchars(html_entity_decode($listing->requirements, ENT_QUOTES, 'UTF-8'))) ?></div>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($listing->benefits)) : ?>
                    <div class="form-group full mt-md">
                        <label><i class="fas fa-gift"></i> Benefits</label>
                        <div class="form-input bg-card min-h-auto white-space-pre-wrap"><?= nl2br(htmlspecialchars(html_entity_decode($listing->benefits, ENT_QUOTES, 'UTF-8'))) ?></div>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($listing->tags)) : ?>
                    <div class="form-group full mt-md">
                        <label><i class="fas fa-tags"></i> Tags</label>
                        <div class="job-tags py-sm">
                            <?php foreach (explode(',', $listing->tags) as $tag) : ?>
                            <span class="job-tag"><?= htmlspecialchars(trim($tag)) ?></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                
                <div class="form-section">
                    <h2><i class="fas fa-building"></i> Company Information</h2>
                    <div class="form-grid">
                        <div>
                            <label><i class="fas fa-building"></i> Company</label>
                            <div class="form-input bg-card"><?= htmlspecialchars($listing->company ?? 'Not specified') ?></div>
                        </div>
                        <div>
                            <label><i class="fas fa-map-marker-alt"></i> Address</label>
                            <div class="form-input bg-card"><?= htmlspecialchars($listing->address ?? 'Not specified') ?></div>
                        </div>
                        <div>
                            <label><i class="fas fa-envelope"></i> Email</label>
                            <div class="form-input bg-card">
                                <a href="mailto:<?= htmlspecialchars($listing->email) ?>" class="text-primary"><?= htmlspecialchars($listing->email) ?></a>
                            </div>
                        </div>
                        <div>
                            <label><i class="fas fa-phone"></i> Phone</label>
                            <div class="form-input bg-card"><?= htmlspecialchars($listing->phone ?? 'Not specified') ?></div>
                        </div>
                    </div>
                </div>
                
                <div class="action-row">
                    <a href="<?= url('/listings') ?>" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Listings
                    </a>
                    
                    <?php if (Authorization::isOwner($listing->user_id)) : ?>
                    <a href="<?= url('/listings/edit/' . $listing->id) ?>" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit Listing
                    </a>
                    
                    <form method="POST" action="<?= url('/listings/' . $listing->id) ?>" class="inline-form">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this listing?')">
                            <i class="fas fa-trash"></i> Delete Listing
                        </button>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php else : ?>
            <div class="text-center py-3xl">
                <p>Listing not found.</p>
                <a href="<?= url('/listings') ?>" class="btn btn-primary">Back to Listings</a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php loadPartial('footer'); ?>