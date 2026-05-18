<?php
    loadPartial('head');
    loadPartial('navbar');
    loadPartial('showcase');
    loadPartial('topBanner');
?>

<!-- Job Listings -->
<section class="jobs-section">
  <div class="container mx-auto">
    <div class="text-center text-3xl mb-4 font-bold jobs-section-badge inline-block w-auto mx-auto mb-4">Recent Jobs</div>
    <div class="jobs-grid">

      <?php if (isset($listings) && !empty($listings)) : ?>
        <?php foreach ($listings as $listing) : ?>
        <div class="job-card">
          <div class="job-card-content">
            <h2 class="job-card-title"><?= $listing->title ?></h2>
            <p class="job-card-description">
              <?= $listing->description ?>
            </p>
            <div class="job-card-meta">
              <div class="job-meta-row">
                <span class="job-meta-label">Salary:</span>
                <span class="job-salary"><?= formatSalary($listing->salary) ?></span>
              </div>
              <div class="job-meta-row">
                <span class="job-meta-label">Location:</span>
                <span class="job-location"><?= $listing->city ?>, <?= $listing->state ?></span>
                <span class="job-badge" style="background: var(--primary); color: white; margin-left: 0.5rem;">Local</span>
              </div>
              <?php if (!empty($listing->tags)) : ?>
              <div class="job-meta-row job-tags-row">
                <span class="job-meta-label">Tags:</span>
                <div class="job-tags">
                  <?php foreach (explode(',', $listing->tags) as $tag) : ?>
                  <span class="job-tag"><?= trim($tag) ?></span>
                  <?php endforeach; ?>
                </div>
              </div>
              <?php endif; ?>
            </div>
            <a href="<?= url('/listings/' . $listing->id) ?>" class="job-details-btn">
              Details
            </a>
          </div>
        </div>
        <?php endforeach; ?>
      <?php else : ?>
        <p class="text-center col-span-full py-2xl">No job listings found.</p>
      <?php endif; ?>

    </div>
    <div class="jobs-footer-link-wrap">
      <a href="<?= url('/listings') ?>" class="jobs-footer-link">
        <span>Show All Jobs</span>
        <i class="fas fa-arrow-right"></i>
      </a>
    </div>
  </div>
</section>

<?php
    loadPartial('bottomBanner');
    loadPartial('footer');
?>