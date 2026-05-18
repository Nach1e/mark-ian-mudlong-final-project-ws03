<?php loadPartial('head'); ?>
<?php loadPartial('navbar'); ?>

<section class="create-page">
    <div class="create-wrap">
        <?php loadPartial('errors', ['errors' => $errors ?? []]); ?>
        
        <?php if (isset($listing) && $listing) : ?>
        <div class="form-shell">
            <div class="form-hero">
                <span class="form-badge">
                    <i class="fas fa-edit"></i> Update Opportunity
                </span>
                <h1>Edit Job Listing</h1>
                <p>Update the job details below.</p>
            </div>
            
            <form method="POST" action="/WS03/listings/<?= $listing->id ?>" class="job-form">
                <input type="hidden" name="_method" value="PUT">
                
                <div class="form-section">
                    <h2><i class="fas fa-info-circle"></i> Job Information</h2>
                    <div class="form-grid">
                        <div class="full">
                            <label>Job Title <span style="color: var(--error);">*</span></label>
                            <input type="text" name="title" class="form-input" value="<?= htmlspecialchars($listing->title ?? '') ?>" required>
                        </div>
                        <div class="full">
                            <label>Job Description <span style="color: var(--error);">*</span></label>
                            <textarea name="description" class="form-input" rows="5" required><?= htmlspecialchars($listing->description ?? '') ?></textarea>
                        </div>
                        <div>
                            <label>Annual Salary <span style="color: var(--error);">*</span></label>
                            <input type="number" name="salary" class="form-input" value="<?= htmlspecialchars($listing->salary ?? '') ?>" required>
                        </div>
                        <div>
                            <label>Tags (comma separated)</label>
                            <input type="text" name="tags" class="form-input" value="<?= htmlspecialchars($listing->tags ?? '') ?>">
                        </div>
                        <div class="full">
                            <label>Requirements</label>
                            <textarea name="requirements" class="form-input" rows="4"><?= htmlspecialchars($listing->requirements ?? '') ?></textarea>
                        </div>
                        <div class="full">
                            <label>Benefits</label>
                            <textarea name="benefits" class="form-input" rows="4"><?= htmlspecialchars($listing->benefits ?? '') ?></textarea>
                        </div>
                    </div>
                </div>
                
                <div class="form-section">
                    <h2><i class="fas fa-building"></i> Company Information</h2>
                    <div class="form-grid">
                        <div class="full">
                            <label>Company Name</label>
                            <input type="text" name="company" class="form-input" value="<?= htmlspecialchars($listing->company ?? '') ?>">
                        </div>
                        <div class="full">
                            <label>Address</label>
                            <input type="text" name="address" class="form-input" value="<?= htmlspecialchars($listing->address ?? '') ?>">
                        </div>
                        <div>
                            <label>City <span style="color: var(--error);">*</span></label>
                            <input type="text" name="city" class="form-input" value="<?= htmlspecialchars($listing->city ?? '') ?>" required>
                        </div>
                        <div>
                            <label>State <span style="color: var(--error);">*</span></label>
                            <input type="text" name="state" class="form-input" value="<?= htmlspecialchars($listing->state ?? '') ?>" required>
                        </div>
                        <div>
                            <label>Phone</label>
                            <input type="tel" name="phone" class="form-input" value="<?= htmlspecialchars($listing->phone ?? '') ?>">
                        </div>
                        <div>
                            <label>Email <span style="color: var(--error);">*</span></label>
                            <input type="email" name="email" class="form-input" value="<?= htmlspecialchars($listing->email ?? '') ?>" required>
                        </div>
                    </div>
                </div>
                
                <div class="action-row">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Changes
                    </button>
                    <a href="/WS03/listings/<?= $listing->id ?>" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
        <?php else : ?>
            <div class="text-center" style="padding: 3rem;">
                <p>Listing not found.</p>
                <a href="/WS03/listings" class="btn btn-primary">Back to Listings</a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php loadPartial('footer'); ?>