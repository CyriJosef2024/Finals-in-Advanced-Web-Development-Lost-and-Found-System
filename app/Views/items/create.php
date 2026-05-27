<?= $this->extend('layouts/app') ?>

<?= $this->section('content') ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Report an Item</h4>
            </div>
            <div class="card-body">
                
                <?php if (session()->has('errors')): ?>
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            <?php foreach (session('errors') as $error): ?>
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('/items/store') ?>" method="POST" enctype="multipart/form-data">
                    
                    <?= csrf_field() ?>

                    <div class="mb-3">
                        <label class="form-label">Report Type</label>
                        <select name="type" class="form-select" required>
                            <option value="lost">I lost something</option>
                            <option value="found">I found something</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Item Title</label>
                        <input type="text" name="title" class="form-control" placeholder="e.g. Blue Hydroflask" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Description (Optional)</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Describe the item in detail..."></textarea>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Location</label>
                        <input type="text" name="location" class="form-control" placeholder="Where was it lost/found?" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contact Name</label>
                        <input type="text" name="contact_name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contact Email</label>
                        <input type="email" name="contact_email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Contact Phone (Optional)</label>
                        <input type="text" name="contact_phone" class="form-control" placeholder="Optional phone number">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Photo (Optional)</label>
                        <input type="file" name="photo" class="form-control" accept="image/png, image/jpeg">
                        <div class="form-text">Upload a clear photo of the item (PNG or JPEG only).</div>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Submit Report</button>
                </form>

            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>