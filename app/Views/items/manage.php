<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-md-6">
        
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success shadow-sm"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-dark text-white">
                <h5 class="mb-0">Manage Your Post: <?= esc($item['title']) ?></h5>
            </div>
            <div class="card-body">
                <p class="text-muted">Use this page to update the status of your item. Save this page's URL if you need to return later.</p>
                
                <form action="<?= base_url('/items/update/' . $item['id']) ?>" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="edit_token" value="<?= esc($item['edit_token']) ?>">

                    <div class="mb-4">
                        <label class="form-label fw-bold">Current Status</label>
                        <select name="status" class="form-select form-select-lg">
                            <option value="open" <?= $item['status'] === 'open' ? 'selected' : '' ?>>Open (Still lost/unclaimed)</option>
                            <option value="claimed" <?= $item['status'] === 'claimed' ? 'selected' : '' ?>>Claimed / Found (Resolved)</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Update Status</button>
                    <a href="<?= base_url('/items') ?>" class="btn btn-link w-100 mt-2">Back to Board</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
