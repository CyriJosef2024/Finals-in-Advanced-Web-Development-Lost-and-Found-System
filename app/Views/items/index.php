<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<div class="row mb-4">
    <div class="col">
        <h2 class="fw-bold">Recent Reports</h2>
        <p class="text-muted">Help your fellow campus members find their belongings.</p>
    </div>
</div>

<div class="row">
    <?php if (empty($items)): ?>
        <div class="col-12 text-center py-5">
            <h5 class="text-muted">No items reported yet.</h5>
        </div>
    <?php else: ?>
        <?php foreach ($items as $item): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body">
                        
                        <span class="badge <?= $item['type'] === 'lost' ? 'bg-danger' : 'bg-success' ?> mb-2">
                            <?= esc(strtoupper($item['type'])) ?>
                        </span>
                        
                        <h5 class="card-title fw-bold">
                            <?= esc($item['title'], 'html') ?>
                        </h5>
                        
                        <p class="card-text text-muted small mb-2">
                            📍 <?= esc($item['location'], 'html') ?><br>
                            👤 <?= esc($item['contact_name'], 'html') ?>
                        </p>
                        
                        <p class="card-text">
                            <?= esc(word_limiter($item['description'] ?? 'No description provided.', 15), 'html') ?>
                        </p>
                        
                    </div>
                    <div class="card-footer bg-white border-0 text-end pb-3">
                        <small class="text-muted d-block mb-2">
                            Posted: <?= date('M d, Y', strtotime($item['created_at'])) ?>
                        </small>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<?= $this->endSection() ?>