<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<?php if (session()->has('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<div class="row mb-4">
    <div class="col">
        <h2 class="fw-bold">Recent Reports</h2>
        <p class="text-muted">Help your fellow campus members find their belongings.</p>
    </div>
</div>

<div class="card shadow-sm border-0 mb-4 bg-white">
    <div class="card-body">
        <form action="<?= base_url('/items') ?>" method="GET" class="row g-3 align-items-center">
            <div class="col-md-6">
                <input type="text" name="keyword" class="form-control form-control-lg"
                    placeholder="Search by item, description, or location..."
                    value="<?= esc($keyword ?? '', 'attr') ?>">
            </div>
            <div class="col-md-4">
                <select name="type" class="form-select form-select-lg">
                    <option value="">All Types (Lost &amp; Found)</option>
                    <option value="lost" <?= ($type === 'lost') ? 'selected' : '' ?>>Lost Items Only</option>
                    <option value="found" <?= ($type === 'found') ? 'selected' : '' ?>>Found Items Only</option>
                </select>
            </div>
            <div class="col-md-2 text-end">
                <button type="submit" class="btn btn-primary btn-lg w-100">Search</button>
            </div>
        </form>
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

                        <p class="mb-2">
                                                        <?php if ($item['status'] == 'open'): ?>
                                <span class="badge bg-warning text-dark">OPEN</span>
                                                        <?php elseif ($item['status'] == 'claimed'): ?>
                                <span class="badge bg-success">CLAIMED</span>
                                                        <?php elseif ($item['status'] == 'resolved'): ?>
                                <span class="badge bg-primary">RESOLVED</span>
                                                        <?php endif; ?>
                        </p>

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

                        <?php if (!empty($item['photo'])): ?>
                            <div class="mb-3">
                                <img src="<?= base_url('image/' . esc($item['photo'], 'url')) ?>" alt="Item Photo"
                                    class="img-fluid rounded shadow-sm" style="height: 200px; width: 100%; object-fit: cover;">
                            </div>
                        <?php endif; ?>
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

<div class="row mt-4">
    <div class="col d-flex justify-content-center">
        <?= $pager->links() ?>
    </div>
</div>

<?= $this->endSection() ?>