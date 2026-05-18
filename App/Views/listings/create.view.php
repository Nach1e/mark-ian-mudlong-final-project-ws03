<?php loadPartial('head'); ?>
<?php loadPartial('navbar'); ?>

<section class="create-page">
    <div class="create-wrap">
        <?php loadPartial('errors', ['errors' => $errors ?? []]); ?>
        
        <div class="form-shell">
            <div class="form-hero">
                <span class="form-badge">
                    <i class="fas fa-plus-circle"></i> New Opportunity
                </span>
                <h1>Create Job Listing</h1>
                <p>Fill out the form below to post a new job opportunity.</p>
            </div>
            
            <form method="POST" action="<?= url('/listings') ?>" class="job-form">
                <div class="form-section">
                    <h2><i class="fas fa-info-circle"></i> Job Information</h2>
                    <div class="form-grid">
                        <div class="full">
                            <label>Job Title <span style="color: var(--error);">*</span></label>
                            <input type="text" name="title" class="form-input" placeholder="e.g., Senior Software Engineer" value="<?= isset($listing) ? $listing->title ?? '' : '' ?>" required>
                        </div>
                        <div class="full">
                            <label>Job Description <span style="color: var(--error);">*</span></label>
                            <textarea name="description" class="form-input" rows="5" placeholder="Describe the role, responsibilities, and what makes this opportunity exciting..." required><?= isset($listing) ? $listing->description ?? '' : '' ?></textarea>
                        </div>
                        <div>
                            <label>Annual Salary <span style="color: var(--error);">*</span></label>
                            <input type="number" name="salary" class="form-input" placeholder="e.g., 90000" value="<?= isset($listing) ? $listing->salary ?? '' : '' ?>" required>
                        </div>
                        <div>
                            <label>Tags (comma separated)</label>
                            <input type="text" name="tags" class="form-input" placeholder="e.g., Full-time, Remote, Urgent" value="<?= isset($listing) ? $listing->tags ?? '' : '' ?>">
                        </div>
                        <div class="full">
                            <label>Requirements</label>
                            <textarea name="requirements" class="form-input" rows="4" placeholder="List the required skills, experience, and qualifications..."><?= isset($listing) ? $listing->requirements ?? '' : '' ?></textarea>
                        </div>
                        <div class="full">
                            <label>Benefits</label>
                            <textarea name="benefits" class="form-input" rows="4" placeholder="Highlight the benefits, perks, and culture..."><?= isset($listing) ? $listing->benefits ?? '' : '' ?></textarea>
                        </div>
                    </div>
                </div>
                
                <div class="form-section">
                    <h2><i class="fas fa-building"></i> Company Information</h2>
                    <div class="form-grid">
                        <div class="full">
                            <label>Company Name</label>
                            <input type="text" name="company" class="form-input" placeholder="Your company name" value="<?= isset($listing) ? $listing->company ?? '' : '' ?>">
                        </div>
                        <div class="full">
                            <label>Address</label>
                            <input type="text" name="address" class="form-input" placeholder="Street address" value="<?= isset($listing) ? $listing->address ?? '' : '' ?>">
                        </div>
                        <div>
                            <label>City <span style="color: var(--error);">*</span></label>
                            <input type="text" name="city" class="form-input" placeholder="e.g., Chicago" value="<?= isset($listing) ? $listing->city ?? '' : '' ?>" required>
                        </div>
                        <div>
                            <label>State <span style="color: var(--error);">*</span></label>
                            <input type="text" name="state" class="form-input" placeholder="e.g., IL" value="<?= isset($listing) ? $listing->state ?? '' : '' ?>" required>
                        </div>
                        <div>
                            <label>Phone</label>
                            <input type="tel" name="phone" class="form-input" placeholder="Contact phone number" value="<?= isset($listing) ? $listing->phone ?? '' : '' ?>">
                        </div>
                        <div>
                            <label>Email <span style="color: var(--error);">*</span></label>
                            <input type="email" name="email" class="form-input" placeholder="contact@company.com" value="<?= isset($listing) ? $listing->email ?? '' : '' ?>" required>
                        </div>
                    </div>
                </div>
                
                <div class="action-row">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Publish Listing
                    </button>
                    <a href="<?= url('/listings') ?>" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>

<?php loadPartial('footer'); ?>